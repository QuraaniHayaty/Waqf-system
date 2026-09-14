<?php
require_once 'db.php';

try {
    // جدول العقارات
    $pdo->exec("CREATE TABLE IF NOT EXISTS properties (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        floats_json TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // جدول عقود الإيجار النشطة
    $pdo->exec("CREATE TABLE IF NOT EXISTS leases (
        id INT AUTO_INCREMENT PRIMARY KEY,
        prop VARCHAR(255) NOT NULL,
        floor VARCHAR(100) NOT NULL,
        unit VARCHAR(100) NOT NULL,
        tenant VARCHAR(255) NOT NULL,
        phone VARCHAR(50),
        amount DECIMAL(10,2) NOT NULL,
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        files_json TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // جدول الأرشيف
    $pdo->exec("CREATE TABLE IF NOT EXISTS archives (
        id INT AUTO_INCREMENT PRIMARY KEY,
        prop VARCHAR(255) NOT NULL,
        floor VARCHAR(100) NOT NULL,
        unit VARCHAR(100) NOT NULL,
        tenant VARCHAR(255) NOT NULL,
        phone VARCHAR(50),
        amount DECIMAL(10,2) NOT NULL,
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        files_json TEXT,
        archived_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    echo "تم إنشاء جميع جداول قاعدة البيانات بنجاح تام!\n";
} catch (PDOException $e) {
    echo "خطأ أثناء إنشاء الجداول: " . $e->getMessage() . "\n";
}
?>
