<?php
require_once 'db.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='student'){
    die('Only logged-in students may book. <a href="login.php">Login</a>');
}
$student_id = $_SESSION['user']['id'];
$tutor_id = $_GET['tutor_id'] ?? $_POST['tutor_id'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $session_date = $_POST['session_date'] ?? null;
    $stmt = $pdo->prepare('INSERT INTO bookings (student_id,tutor_id,session_date,status) VALUES (?,?,?,?)');
    $stmt->execute([$student_id,$tutor_id,$session_date,'booked']);
    echo '<p>Booking created. (INSERT executed)</p><p><a href="dashboard_student.php">Go to student dashboard</a></p>';
    exit;
}

if(!$tutor_id) die('Missing tutor id');

?>
<!doctype html><html><head><meta charset="utf-8"><title>Book</title></head><body>
<h3>Book with tutor #<?=htmlspecialchars($tutor_id)?></h3>
<form method="post">
  <label>Session date/time:<br/><input type="datetime-local" name="session_date" required></label><br/>
  <input type="hidden" name="tutor_id" value="<?=htmlspecialchars($tutor_id)?>">
  <button>Confirm booking</button>
</form>
</body></html>
