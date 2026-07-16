<?php
// Buni dashboard.php ning eng tepasiga, PHP kodlar ichiga qo'shasiz:
$messages = $pdo->query("SELECT * FROM messages ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Buni esa dashboard.php ning pastki qismiga, HTML ichiga qo'shasiz: -->
<div class="card">
    <h3>Foydalanuvchilardan kelgan xabarlar</h3>
    <?php if (count($messages) > 0): ?>
        <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse; background:#fff;">
            <tr>
                <th>Ism</th>
                <th>Xabar matni</th>
                <th>Vaqti</th>
            </tr>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?= htmlspecialchars($msg['name']) ?></td>
                    <td><?= htmlspecialchars($msg['text']) ?></td>
                    <td><?= $msg['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Hozircha hech qanday xabar yoq.</p>
    <?php endif; ?>
</div>

<!-- Navigatsiya tugmasini ham dashboard.php ga qo'shib qo'yamiz -->
<br>
<a href="manage.php" style="display:inline-block; padding:10px 20px; background:#007bff; color:white; text-decoration:none; border-radius:4px;">
    Animelarni Boshqarish sahifasiga o'tish →
</a>