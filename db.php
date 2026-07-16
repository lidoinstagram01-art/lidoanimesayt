<?php
// Aiven MySQL ma'lumotlaringizni shu yerga yozing
$host = 'lido11342-lido1134.e.aivencloud.com';
$db   = 'defaultdb';
$user = 'avnadmin';
$pass = 'AVNS_W9JkWM4A6d_ko3CIbuY'; // Aiven parolingizni yozing
$port = '25708'; // Odatda Aiven porti shunday bo'ladi

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);
    // Xatoliklarni ko'rsatish rejimini yoqish
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bazaga ulanishda xatolik yuz berdi: " . $e->getMessage());
}
?>