<?php
require_once 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'tutor') {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $subjects = $_POST['subjects'];
  $rate = $_POST['hourly_rate'];
  $bio = $_POST['bio'];

  $stmt = $pdo->prepare(
    'INSERT INTO tutors 
    (user_id, title, subjects, hourly_rate, bio, experience, video_url, teaching_mode) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
  );

  $stmt->execute([
    $user_id,
    $title,
    $subjects,
    $rate,
    $bio,
    1,
    '',
    'online'
  ]);

  echo '<p>Tutor profile created. (INSERT executed)</p>';
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Tutor</title>
</head>
<body>

  <form method="post">
    <label>
      Title
      <input name="title">
    </label>
    <br/>

    <label>
      Subjects
      <input name="subjects">
    </label>
    <br/>

    <label>
      Rate
      <input name="hourly_rate" type="number" step="0.01">
    </label>
    <br/>

    <label>
      Bio
      <textarea name="bio"></textarea>
    </label>
    <br/>

    <button>Create</button>
  </form>

</body>
</html>
