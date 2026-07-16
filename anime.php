<?php
require 'db.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Animeni qidirish
$stmt = $pdo->prepare("SELECT * FROM animes WHERE slug = ?");
$stmt->execute([$slug]);
$anime = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anime) {
    die("<h2 style='text-align:center; color:white;'>Anime topilmadi!</h2>");
}

// Qismlarni olish
$ep_stmt = $pdo->prepare("SELECT * FROM episodes WHERE anime_id = ? ORDER BY ep_number ASC");
$ep_stmt->execute([$anime['id']]);
$episodes = $ep_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($anime['title']) ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .anime-header { text-align: center; margin-bottom: 20px; }
        .episodes { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin: 20px 0; }
        .ep-btn { background: #e50914; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer; }
        .ep-btn:hover { background: #b20710; }
        .video-container { text-align: center; margin-top: 20px; }
        iframe { max-width: 100%; border: none; border-radius: 8px; }
    </style>
</head>
<body>
    <header>
        <h1><a href="index.php" style="color:white; text-decoration:none;">Anibla Clone</a></h1>
    </header>

    <div class="container">
        <div class="anime-header">
            <h2><?= htmlspecialchars($anime['title']) ?></h2>
            <p>Holati: <b><?= $anime['status'] === 'ongoing' ? 'Davom etmoqda' : 'Tugallangan' ?></b></p>
        </div>

        <div class="video-container">
            <!-- Video shu yerda chiqadi -->
            <iframe id="videoPlayer" width="800" height="450" src="" allowfullscreen></iframe>
        </div>

        <div class="episodes">
            <?php if (count($episodes) > 0): ?>
                <?php foreach ($episodes as $ep): ?>
                    <button class="ep-btn" onclick="playVideo('<?= htmlspecialchars($ep['video_url']) ?>')">
                        <?= $ep['ep_number'] ?>-qism
                    </button>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Hozircha qismlar qo'shilmagan.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Birinchi qismni avtomatik qo'yish
        const firstVideo = document.querySelector('.ep-btn');
        if (firstVideo) {
            firstVideo.click();
        }

        function playVideo(url) {
            document.getElementById('videoPlayer').src = url;
        }
    </script>
</body>
</html>