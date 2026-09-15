<?php
require_once 'db.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    if ($method == 'GET' && $action == 'getAll') {
        $stmt = $pdo->query("SELECT * FROM leases WHERE archived = 0 ORDER BY created_at DESC");
        $leases = $stmt->fetchAll();
        foreach($leases as &$lease) {
            $lease['files'] = json_decode($lease['files_json'], true) ?: [];
        }
        echo json_encode($leases);
    }
    elseif ($method == 'GET' && $action == 'getArchived') {
        $stmt = $pdo->query("SELECT * FROM leases WHERE archived = 1 ORDER BY created_at DESC");
        $leases = $stmt->fetchAll();
        foreach($leases as &$lease) {
            $lease['files'] = json_decode($lease['files_json'], true) ?: [];
        }
        echo json_encode($leases);
    }
    elseif ($method == 'POST' && $action == 'add') {
        $data = json_decode(file_get_contents("php://input"), true);

        $stmt = $pdo->prepare("INSERT INTO leases (prop, floor, unit, tenant, phone, amount, start_date, end_date, files_json, archived) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
        $stmt->execute([
            $data['prop'] ?? '',
            $data['floor'] ?? '',
            $data['unit'] ?? '',
            $data['tenant'] ?? '',
            $data['phone'] ?? '',
            $data['amount'] ?? 0,
            $data['start_date'] ?? date('Y-m-d'),
            $data['end_date'] ?? date('Y-m-d'),
            json_encode($data['files'] ?? [])
        ]);

        echo json_encode(["status" => "success", "id" => $pdo->lastInsertId()]);
    }
    elseif ($method == 'POST' && $action == 'update') {
        $data = json_decode(file_get_contents("php://input"), true);

        $stmt = $pdo->prepare("UPDATE leases SET prop = ?, floor = ?, unit = ?, tenant = ?, phone = ?, amount = ?, start_date = ?, end_date = ?, files_json = ? WHERE id = ?");
        $stmt->execute([
            $data['prop'] ?? '',
            $data['floor'] ?? '',
            $data['unit'] ?? '',
            $data['tenant'] ?? '',
            $data['phone'] ?? '',
            $data['amount'] ?? 0,
            $data['start_date'] ?? date('Y-m-d'),
            $data['end_date'] ?? date('Y-m-d'),
            json_encode($data['files'] ?? []),
            $data['id']
        ]);

        echo json_encode(["status" => "success"]);
    }
    elseif ($method == 'POST' && $action == 'archive') {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("UPDATE leases SET archived = 1 WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(["status" => "success"]);
    }
    elseif ($method == 'POST' && $action == 'restore') {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("UPDATE leases SET archived = 0 WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(["status" => "success"]);
    }
    elseif ($method == 'POST' && $action == 'renew') {
        $data = json_decode(file_get_contents("php://input"), true);

        $pdo->beginTransaction();
        try {
            $archiveStmt = $pdo->prepare("UPDATE leases SET archived = 1 WHERE id = ?");
            $archiveStmt->execute([$data['id']]);

            $insertStmt = $pdo->prepare("INSERT INTO leases (prop, floor, unit, tenant, phone, amount, start_date, end_date, files_json, archived) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
            $insertStmt->execute([
                $data['prop'] ?? '',
                $data['floor'] ?? '',
                $data['unit'] ?? '',
                $data['tenant'] ?? '',
                $data['phone'] ?? '',
                $data['amount'] ?? 0,
                $data['start_date'] ?? date('Y-m-d'),
                $data['end_date'] ?? date('Y-m-d'),
                json_encode($data['files'] ?? [])
            ]);
            $newId = $pdo->lastInsertId();

            $pdo->commit();
            echo json_encode(["status" => "success", "id" => $newId]);
        } catch (Exception $inner) {
            $pdo->rollBack();
            throw $inner;
        }
    }
    elseif ($method == 'POST' && $action == 'delete') {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("DELETE FROM leases WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(["status" => "success"]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
