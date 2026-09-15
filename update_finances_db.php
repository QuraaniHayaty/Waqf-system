<?php
require_once 'public/db.php';
try {
    $pdo->exec("ALTER TABLE finances ADD COLUMN IF NOT EXISTS transaction_date DATE DEFAULT (CURRENT_DATE)");
    echo json_encode(["status" => "success", "message" => "Finances table updated with transaction_date!"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
