<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'db.php';

$action = $_GET['action'] ?? '';

if ($action === 'getAll') {
    try {
        $stmt = $pdo->query("SELECT * FROM leases ORDER BY id DESC");
        $leases = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($leases as &$l) {
            $l['files'] = json_decode($l['files'] ?? '[]', true);
        }
        echo json_encode($leases, JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode([], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

if ($action === 'add') {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $stmt = $pdo->prepare("INSERT INTO leases (prop, floor, unit, tenant, phone, amount, start_date, end_date, files, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['prop'] ?? '',
            $data['floor'] ?? '',
            $data['unit'] ?? '',
            $data['tenant'] ?? '',
            $data['phone'] ?? '',
            $data['amount'] ?? 0,
            $data['start'] ?? null,
            $data['end'] ?? null,
            json_encode($data['files'] ?? []),
            $data['status'] ?? 'active'
        ]);
        echo json_encode(['status' => 'success', 'id' => $pdo->lastInsertId()], JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

if ($action === 'delete') {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $stmt = $pdo->prepare("DELETE FROM leases WHERE id = ?");
        $stmt->execute([$data['id'] ?? 0]);
        echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

if ($action === 'archive') {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $stmt = $pdo->prepare("UPDATE leases SET status = 'archived' WHERE id = ?");
        $stmt->execute([$data['id'] ?? 0]);
        echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

if ($action === 'restore') {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $stmt = $pdo->prepare("UPDATE leases SET status = 'active' WHERE id = ?");
        $stmt->execute([$data['id'] ?? 0]);
        echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

if ($action === 'update') {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $stmt = $pdo->prepare("UPDATE leases SET prop = ?, floor = ?, unit = ?, tenant = ?, phone = ?, amount = ?, start_date = ?, end_date = ?, files = ? WHERE id = ?");
        $stmt->execute([
            $data['prop'] ?? '',
            $data['floor'] ?? '',
            $data['unit'] ?? '',
            $data['tenant'] ?? '',
            $data['phone'] ?? '',
            $data['amount'] ?? 0,
            $data['start'] ?? null,
            $data['end'] ?? null,
            json_encode($data['files'] ?? []),
            $data['id'] ?? 0
        ]);
        echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}
