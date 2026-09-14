<?php
$host = 'localhost';
$db   = 'u792704625_Waqf';
$user = 'u792704625_Waqf';
$pass = 'M92103620@n';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>
