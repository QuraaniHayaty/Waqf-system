<?php
require_once 'db.php';
try {
    // إنشاء جدول العقارات
    $pdo->exec("CREATE TABLE IF NOT EXISTS properties (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        location VARCHAR(255),
        floats_json TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // إنشاء جدول العقود بالأعمدة المتكاملة تماماً مع الـ API الواجهة
    $pdo->exec("CREATE TABLE IF NOT EXISTS leases (
        id INT AUTO_INCREMENT PRIMARY KEY,
        prop VARCHAR(255),
        floor VARCHAR(100),
        unit VARCHAR(100),
        tenant VARCHAR(255),
        phone VARCHAR(50),
        amount DECIMAL(10,2),
        start_date DATE,
        end_date DATE,
        files_json TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    echo json_encode(["status" => "success", "message" => "Database tables installed successfully!"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
