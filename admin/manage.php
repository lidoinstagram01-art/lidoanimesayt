<?php
session_start();
require '../db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}

// 1. Qism qo'shish logikasi
if (isset($_POST['add_episode'])) {
    $anime_id = $_POST['anime_id'];
    $ep_number = $_POST['ep_number'];
    $video_url = $_POST['video_url'];

    $stmt = $pdo->prepare("INSERT INTO episodes (anime_id, ep_number, video_url) VALUES (?, ?, ?)");
    $stmt->execute([$anime_id, $ep_number, $video_url]);
    $msg = "Yangi qism muvaffaqiyatli qo'shildi!";
}

// 2. Statusni o'zgartirish logikasi
if (isset($_POST['update_status'])) {
    $anime_id = $_POST['anime_id'];
    $new_status = $_POST['status'];
    $new_title = $_POST['title'];

    $stmt = $pdo->prepare("UPDATE animes SET status = ?, title = ? WHERE id = ?");
    $stmt->execute([$new_status, $new_title, $anime_id]);
    $msg = "Anime ma'lumotlari yangilandi!";
}

// Barcha animelar ro'yxatini olish (forma uchun)
$animes = $pdo->query("SELECT * FROM animes ORDER BY title ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Animelarni Boshqarish</title>
    <style>
        body { background: #f4f4f4; font-family: sans-serif; padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        input, select { width: 100%; padding: 10px; margin: 10px 0; box-sizing: border-box; }
        button { background: #28a745; color: white; padding: 10px 15px; border: none; cursor: pointer; border-radius: 4px; }
        .btn-blue { background: #007bff; }
        .nav-links { margin-bottom: 20px; }
        .nav-links a { margin-right: 15px; text-decoration: none; color: #333; font-weight: bold; }
    </style>
</head>
<body>
    <div class="nav-links">
        <a href="dashboard.php">← Bosh sahifa (Statistika)</a>
        <a href="manage.php">Animelarni Boshqarish</a>
    </div>

    <h2>Animelarni tahrirlash va qismlar qo'shish</h2>
    <?php if(isset($msg)) echo "<p style='color:green; font-weight:bold;'>$msg</p>"; ?>

    <!-- QISM QO'SHISH FORMASI -->
    <div class="card">
        <h3>Animega Qism (Seriya) Qo'shish</h3>
        <form method="POST">
            <label>Animeni tanlang:</label>
            <select name="anime_id" required>
                <?php foreach ($animes as $anime): ?>
                    <option value="<?= $anime['id'] ?>"><?= htmlspecialchars($anime['title']) ?> (<?= $anime['status'] ?>)</option>
                <?php endforeach; ?>
            </select>

            <input type="number" name="ep_number" placeholder="Qism raqami (Masalan: 10)" required>
            <input type="text" name="video_url" placeholder="Video URL (iframe yoki mp4 havola)" required>
            <button type="submit" name="add_episode">Qismni joylash</button>
        </form>
    </div>

    <!-- STATUSTNI VA NOMINI TAHRIRLASH FORMASI -->
    <div class="card">
        <h3>Animeni tahrirlash (Ongoing / Completed qilish)</h3>
        <form method="POST">
            <label>Tahrirlanadigan anime:</label>
            <select name="anime_id" required>
                <?php foreach ($animes as $anime): ?>
                    <option value="<?= $anime['id'] ?>"><?= htmlspecialchars($anime['title']) ?></option>
                <?php endforeach; ?>
            </select>

            <input type="text" name="title" placeholder="Yangi nomi (agar xato yozilgan bo'lsa)">
            
            <label>Statusni o'zgartirish:</label>
            <select name="status">
                <option value="ongoing">Davom etmoqda (Ongoing)</option>
                <option value="completed">Tugallangan (Completed)</option>
            </select>
            <button type="submit" name="update_status" class="btn-blue">O'zgarishlarni saqlash</button>
        </form>
    </div>
</body>
</html>