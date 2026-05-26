<?php
require_once 'db.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='tutor'){ header('Location: login.php'); exit; }
$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare('DELETE FROM tutors WHERE user_id = ?');
$stmt->execute([$user_id]);
echo '<p>Deleted. (DELETE executed)</p>';
