<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'db.php';

echo "<h2>تشخيص نظام الوقف (Waqf Debug)</h2>";

try {
    // 1. فحص الاتصال وقاعدة البيانات
    $stmt = $pdo->query("SELECT DATABASE()");
    $dbName = $stmt->fetchColumn();
    echo "<p style='color:green;'>✅ الاتصال بقاعدة البيانات ناجح (قاعدة البيانات الحالية: <b>$dbName</b>)</p>";

    // 2. فحص هيكل جدول leases
    $stmt = $pdo->query("DESCRIBE leases");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<p>📋 أعمدة جدول <b>leases</b> الحالية:</p>";
    echo "<ul>";
    foreach($columns as $col) {
        echo "<li>$col</li>";
    }
    echo "</ul>";

    // 3. فحص عدد العقود الموجودة حالياً
    $stmt = $pdo->query("SELECT COUNT(*) FROM leases");
    $count = $stmt->fetchColumn();
    echo "<p>📊 عدد العقود المخزنة حالياً في قاعدة البيانات: <b>$count</b></p>";

} catch (Exception $e) {
    echo "<p style='color:red; font-weight:bold;'>❌ خطأ في قاعدة البيانات: " . $e->getMessage() . "</p>";
}
?>
