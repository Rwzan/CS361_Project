<?php
require_once 'db.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='tutor') { header('Location: login.php'); exit; }
$user_id = $_SESSION['user']['id'];

// Fetch tutor profile
$stmt = $pdo->prepare('SELECT * FROM tutors WHERE user_id = ? LIMIT 1');
$stmt->execute([$user_id]);
$tutor = $stmt->fetch();

// Handle update (UPDATE)
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update'])){
    $title = $_POST['title']; $subjects = $_POST['subjects']; $rate = $_POST['hourly_rate']; $bio = $_POST['bio'];
    $stmt = $pdo->prepare('UPDATE tutors SET title=?,subjects=?,hourly_rate=?,bio=? WHERE user_id = ?');
    $stmt->execute([$title,$subjects,$rate,$bio,$user_id]);
    echo '<p>Profile updated. (UPDATE executed)</p>';
    // refresh
    $stmt = $pdo->prepare('SELECT * FROM tutors WHERE user_id = ? LIMIT 1');
    $stmt->execute([$user_id]);
    $tutor = $stmt->fetch();
}

// Handle delete (DELETE) - demo: tutor may delete their own profile row
if(isset($_GET['delete']) && $_GET['delete']=='1'){
    $stmt = $pdo->prepare('DELETE FROM tutors WHERE user_id = ?');
    $stmt->execute([$user_id]);
    echo '<p>Tutor profile deleted. (DELETE executed)</p>';
    header('Location: ../index.php');
    exit;
}

// Show bookings (SELECT)
$stmt = $pdo->prepare('SELECT b.*, u.name as student_name FROM bookings b JOIN users u ON b.student_id=u.id WHERE b.tutor_id = ?');
$stmt->execute([$tutor['id'] ?? 0]);
$bookings = $stmt->fetchAll();

?>
<!doctype html><html><head><meta charset="utf-8"><title>Tutor Dashboard</title>
<link rel="stylesheet" href="../css/style.css"></head><body>
<header><h2>Tutor Dashboard</h2></header>
<main>
<?php if($tutor): ?>
  <h3>Your profile</h3>
  <form method="post">
    <label>Title:<br/><input name="title" value="<?=htmlspecialchars($tutor['title'])?>"></label><br/>
    <label>Subjects:<br/><input name="subjects" value="<?=htmlspecialchars($tutor['subjects'])?>"></label><br/>
    <label>Hourly rate:<br/><input name="hourly_rate" type="number" step="0.01" value="<?=htmlspecialchars($tutor['hourly_rate'])?>"></label><br/>
    <label>Bio:<br/><textarea name="bio"><?=htmlspecialchars($tutor['bio'])?></textarea></label><br/>
    <button name="update">Save changes</button>
  </form>
  <p><a href="dashboard_tutor.php?delete=1" onclick="return confirm('Delete profile?')">Delete profile (demo)</a></p>

  <h3>Bookings</h3>
  <table>
    <tr><th>ID</th><th>Student</th><th>Session</th><th>Status</th></tr>
    <?php foreach($bookings as $b): ?>
      <tr><td><?=htmlspecialchars($b['id'])?></td><td><?=htmlspecialchars($b['student_name'])?></td><td><?=htmlspecialchars($b['session_date'])?></td><td><?=htmlspecialchars($b['status'])?></td></tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>
  <p>No tutor profile found. Please edit your account to become a tutor.</p>
<?php endif; ?>
</main>
</body></html>
