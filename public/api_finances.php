<?php
require_once 'db.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    if ($method == 'GET' && $action == 'getAll') {
        $stmt = $pdo->query("SELECT * FROM finances ORDER BY created_at DESC");
        echo json_encode($stmt->fetchAll());
    }
    elseif ($method == 'POST' && $action == 'add') {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO finances (type, title, amount, month_year, notes) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['type'] ?? 'donation',
            $data['title'] ?? '',
            $data['amount'] ?? 0,
            $data['month_year'] ?? date('Y-m'),
            $data['notes'] ?? ''
        ]);
        echo json_encode(["status" => "success", "id" => $pdo->lastInsertId()]);
    }
    elseif ($method == 'POST' && $action == 'delete') {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("DELETE FROM finances WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(["status" => "success"]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
