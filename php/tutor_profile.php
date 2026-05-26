<?php
require_once 'db.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare('SELECT t.*, u.name,u.city FROM tutors t JOIN users u ON t.user_id=u.id WHERE t.id = ? LIMIT 1');
$stmt->execute([$id]);
$t = $stmt->fetch();
if(!$t) { echo 'Tutor not found'; exit; }
?>
<!doctype html>
<html><head><meta charset="utf-8"><title><?=htmlspecialchars($t['title'])?> - Profile</title>
<link rel="stylesheet" href="../css/style.css"></head><body>
<header><a href="../index.php">Home</a></header>
<main>
  <h2><?=htmlspecialchars($t['name'])?> — <?=htmlspecialchars($t['title'])?></h2>
  <p><strong>Subjects:</strong> <?=htmlspecialchars($t['subjects'])?></p>
  <p><strong>Rate:</strong> SR <?=number_format($t['hourly_rate'],2)?></p>
  <p><strong>Bio:</strong> <?=nl2br(htmlspecialchars($t['bio']))?></p>
  <p><strong>Experience:</strong> <?=htmlspecialchars($t['experience'])?> years</p>
  <p><strong>Mode:</strong> <?=htmlspecialchars($t['teaching_mode'])?></p>
  <?php if($t['video_url']): ?>
    <h3>Preview video</h3>
    <video width="560" controls src="../<?=htmlspecialchars($t['video_url'])?>"></video>
  <?php endif; ?>

  <button onclick="location.href='book.php?tutor_id=<?=$t['id']?>'">Book session</button>
</main>
</body></html>
