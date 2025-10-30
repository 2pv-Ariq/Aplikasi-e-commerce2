<?php
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = ''; 
$DB_NAME = 'ecommerce_db';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Koneksi DB gagal: ' . $e->getMessage());
}
?>
