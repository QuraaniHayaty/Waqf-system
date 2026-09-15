<?php
require_once 'auth.php';
require_once 'db.php';
try {
    // إنشاء جدول العقارات
    $pdo->exec("CREATE TABLE IF NOT EXISTS properties (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        location VARCHAR(255),
        floats_json LONGTEXT,
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
        files_json LONGTEXT,
        archived TINYINT(1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // ترقية الجداول الموجودة مسبقاً (إن كانت أُنشئت قبل إضافة هذه الأعمدة)
    $upgrades = [
        "ALTER TABLE leases ADD COLUMN archived TINYINT(1) NOT NULL DEFAULT 0",
        "ALTER TABLE leases MODIFY COLUMN files_json LONGTEXT",
        "ALTER TABLE properties MODIFY COLUMN floats_json LONGTEXT",
    ];
    foreach ($upgrades as $sql) {
        try { $pdo->exec($sql); } catch (Exception $ignored) {}
    }

    echo json_encode(["status" => "success", "message" => "Database tables installed successfully!"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
