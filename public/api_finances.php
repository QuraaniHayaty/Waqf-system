<?php
require_once 'db.php';
header('Content-Type: application/json');

$method_req = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

try {
    if ($method_req == 'GET' && $action == 'getAll') {
        $stmt = $pdo->query("SELECT *, transaction_date as t_date FROM finances ORDER BY transaction_date DESC, id DESC");
        echo json_encode($stmt->fetchAll());
    }
    elseif ($method_req == 'POST' && $action == 'add') {
        $title = $_POST['title'] ?? 'فاعل خير';
        $type = $_POST['type'] ?? 'donation';
        $category = $_POST['category'] ?? '';
        $amount = $_POST['amount'] ?? 0;
        $transaction_date = $_POST['transaction_date'] ?? date('Y-m-d');
        $phone = $_POST['phone'] ?? '';
        $pay_method = $_POST['method'] ?? '';
        $notes = $_POST['notes'] ?? '';
        
        $fileName = '';
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $originalName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $_FILES['file']['name']);
            $fileName = time() . '_' . $originalName;
            if(!move_uploaded_file($fileTmpPath, $uploadDir . $fileName)) {
                $fileName = '';
            }
        } else {
            $input = json_decode(file_get_contents("php://input"), true);
            if($input) {
                $type = $input['type'] ?? $type;
                $title = $input['title'] ?? $title;
                $category = $input['category'] ?? $category;
                $amount = $input['amount'] ?? $amount;
                $transaction_date = $input['transaction_date'] ?? $transaction_date;
                $phone = $input['phone'] ?? $phone;
                $pay_method = $input['method'] ?? $pay_method;
                $notes = $input['notes'] ?? $notes;
                $fileName = $input['file_name'] ?? '';
            }
        }

        $stmt = $pdo->prepare("INSERT INTO finances (type, title, category, amount, transaction_date, phone, method, notes, file_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$type, $title, $category, $amount, $transaction_date, $phone, $pay_method, $notes, $fileName]);
        
        echo json_encode(["status" => "success", "id" => $pdo->lastInsertId()]);
    }
    elseif ($method_req == 'POST' && $action == 'update') {
        $input = json_decode(file_get_contents("php://input"), true);
        
        $stmt = $pdo->prepare("UPDATE finances SET type = ?, title = ?, category = ?, amount = ?, transaction_date = ?, phone = ?, method = ?, notes = ?, file_name = ? WHERE id = ?");
        $stmt->execute([
            $input['type'] ?? 'donation',
            $input['title'] ?? 'فاعل خير',
            $input['category'] ?? '',
            $input['amount'] ?? 0,
            $input['transaction_date'] ?? date('Y-m-d'),
            $input['phone'] ?? '',
            $input['method'] ?? '',
            $input['notes'] ?? '',
            $input['file_name'] ?? '',
            $input['id'] ?? 0
        ]);
        echo json_encode(["status" => "success"]);
    }
    elseif ($method_req == 'POST' && $action == 'delete') {
        $input = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("DELETE FROM finances WHERE id = ?");
        $stmt->execute([$input['id'] ?? 0]);
        echo json_encode(["status" => "success"]);
    }
} catch (Exception $e) {
    http_response_code(200);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
