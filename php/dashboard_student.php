<?php
require_once 'db.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='student') { header('Location: login.php'); exit; }
$student_id = $_SESSION['user']['id'];
// Show bookings
$stmt = $pdo->prepare('SELECT b.*, t.title, u.name as tutor_name FROM bookings b JOIN tutors t ON b.tutor_id=t.id JOIN users u ON t.user_id=u.id WHERE b.student_id = ?');
$stmt->execute([$student_id]);
$bookings = $stmt->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Student Dashboard</title>
<link rel="stylesheet" href="../css/style.css"></head><body>
<header><h2>Student Dashboard</h2></header>
<main>
<h3>Your bookings</h3>
<table><tr><th>ID</th><th>Tutor</th><th>Session</th><th>Status</th></tr>
<?php foreach($bookings as $b): ?>
  <tr><td><?=htmlspecialchars($b['id'])?></td><td><?=htmlspecialchars($b['tutor_name']).' ('.htmlspecialchars($b['title']).')'?></td><td><?=htmlspecialchars($b['session_date'])?></td><td><?=htmlspecialchars($b['status'])?></td></tr>
<?php endforeach; ?>
</table>
</main>
</body></html>
