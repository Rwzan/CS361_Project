<?php
require_once 'db.php';
session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();
if(!$user || !password_verify($password, $user['password_hash'])){
    die('Invalid credentials. <a href="login.php">Try again</a>');
}

// login
$_SESSION['user'] = ['id'=>$user['id'],'email'=>$user['email'],'name'=>$user['name'],'role'=>$user['role']];
header('Location: ../index.php');
