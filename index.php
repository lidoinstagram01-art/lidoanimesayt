<?php
require 'db.php';

// Animelarni bazadan olish
$stmt = $pdo->query("SELECT * FROM animes ORDER BY id DESC");
$animes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Sayt</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Anibla Clone</h1>
    </header>

    <div class="container">
        <h2>So'nggi Animelar</h2>
        <br>
        <div class="anime-grid">
            <?php if (count($animes) > 0): ?>
                <?php foreach ($animes as $anime): ?>
                    <div class="anime-card">
                        <a href="anime.php?slug=<?= htmlspecialchars($anime['slug']) ?>">
                            <img src="<?= htmlspecialchars($anime['image_url']) ?>" alt="Prevyu">
                            <h3><?= htmlspecialchars($anime['title']) ?></h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Hozircha saytga animelar qo'shilmagan.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>