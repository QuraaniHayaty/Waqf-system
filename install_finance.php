<?php
require_once 'public/db.php';
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS finances (
        id INT AUTO_INCREMENT PRIMARY KEY,
        type VARCHAR(50), -- lease_income, donation, expense
        title VARCHAR(255),
        amount DECIMAL(10,3),
        month_year VARCHAR(20),
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo json_encode(["status" => "success", "message" => "Finances table created successfully!"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
