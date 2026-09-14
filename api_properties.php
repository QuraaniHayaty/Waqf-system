<?php
require_once 'db.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    // جلب جميع العقارات
    if ($method == 'GET' && $action == 'getAll') {
        $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
        $properties = $stmt->fetchAll();
        foreach($properties as &$prop) {
            $prop['floats'] = json_decode($prop['floats_json'], true) ?: [];
        }
        echo json_encode($properties);
    }
    
    // إضافة عقار جديد
    elseif ($method == 'POST' && $action == 'add') {
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $location = $data['location'];
        $floats_json = json_encode($data['floats'] ?? []);
        
        $stmt = $pdo->prepare("INSERT INTO properties (name, location, floats_json) VALUES (?, ?, ?)");
        $stmt->execute([$name, $location, $floats_json]);
        
        echo json_encode(["status" => "success", "id" => $pdo->lastInsertId()]);
    }
    
    // حذف عقار
    elseif ($method == 'POST' && $action == 'delete') {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        
        $stmt = $pdo->prepare("DELETE FROM properties WHERE id = ?");
        $stmt->execute([$id]);
        
        echo json_encode(["status" => "success"]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
