<?php
require_once 'db.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    if ($method == 'GET' && $action == 'getAll') {
        // جلب جميع العقارات
        $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
        $properties = $stmt->fetchAll();
        
        // جلب جميع العقود النشطة دفعة واحدة لتجنب أي مشاكل في المطابقة
        $leasesStmt = $pdo->query("SELECT prop, amount FROM leases");
        $leases = $leasesStmt->fetchAll();

        // حساب الدخل لكل عقار برمجياً
        foreach($properties as &$prop) {
            $prop['floats'] = json_decode($prop['floats_json'], true) ?: [];
            $total_income = 0;
            
            foreach($leases as $lease) {
                if(trim($lease['prop']) === trim($prop['name'])) {
                    $total_income += floatval($lease['amount']);
                }
            }
            $prop['total_income'] = $total_income;
        }
        echo json_encode($properties);
    }
    elseif ($method == 'POST' && $action == 'add') {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO properties (name, location, floats_json) VALUES (?, ?, ?)");
        $stmt->execute([$data['name'], $data['location'], json_encode($data['floats'] ?? [])]);
        echo json_encode(["status" => "success", "id" => $pdo->lastInsertId()]);
    }
    elseif ($method == 'POST' && $action == 'update') {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("UPDATE properties SET name = ?, location = ?, floats_json = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['location'], json_encode($data['floats'] ?? []), $data['id']]);
        echo json_encode(["status" => "success"]);
    }
    elseif ($method == 'POST' && $action == 'delete') {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("DELETE FROM properties WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(["status" => "success"]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
