<?php
// Avval yaratgan db.php faylimizni chaqiramiz
require 'db.php';

try {
    // 1. Animelar jadvalini yaratish SQL kodi
    $sql_animes = "CREATE TABLE IF NOT EXISTS animes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        slug VARCHAR(255) UNIQUE,
        title VARCHAR(255),
        image_url VARCHAR(255),
        status ENUM('ongoing', 'completed') DEFAULT 'ongoing',
        genre VARCHAR(255)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    // 2. Qismlar jadvalini yaratish SQL kodi
    $sql_episodes = "CREATE TABLE IF NOT EXISTS episodes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        anime_id INT,
        ep_number INT,
        video_url VARCHAR(255),
        FOREIGN KEY (anime_id) REFERENCES animes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    // 3. Xabarlar jadvalini yaratish SQL kodi
    $sql_messages = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        text TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    // Kodlarni bazada ishga tushiramiz
    $pdo->exec($sql_animes);
    echo "1. 'animes' jadvali muvaffaqiyatli yaratildi!<br>";

    $pdo->exec($sql_episodes);
    echo "2. 'episodes' jadvali muvaffaqiyatli yaratildi!<br>";

    $pdo->exec($sql_messages);
    echo "3. 'messages' jadvali muvaffaqiyatli yaratildi!<br>";

    echo "<br><b style='color:green;'>Tabriklayman! Barcha jadvallar Aiven bazasida tayyor!</b>";

} catch (PDOException $e) {
    // Agar xatolik bo'lsa, ekranga chiqaradi
    die("<b style='color:red;'>Jadvallarni yaratishda xatolik yuz berdi:</b> " . $e->getMessage());
}
?>