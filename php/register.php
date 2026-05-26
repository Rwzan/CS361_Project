<?php
require_once 'db.php';
session_start();

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? 'student';
$city = $_POST['city'] ?? '';

if(!$name || !$email || !$password){
    die('Missing fields.');
}

// server-side basic validation
if(strlen($name)<3 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password)<8){
    die('Validation failed on server.');
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$pdo->beginTransaction();
try {
    $stmt = $pdo->prepare('INSERT INTO users (email,password_hash,role,name,city) VALUES (?,?,?,?,?)');
    $stmt->execute([$email,$hash,$role,$name,$city]);
    $user_id = $pdo->lastInsertId();

    // If user is a tutor, create an empty tutors row for profile editing later
    if($role==='tutor'){
        $stmt = $pdo->prepare('INSERT INTO tutors (user_id, title, subjects, hourly_rate, bio, experience, video_url, teaching_mode) VALUES (?,?,?,?,?,?,?,?)');
        $stmt->execute([$user_id,'','',0.00,'',0,'','online']);
    }

    $pdo->commit();

    // log user in
    $_SESSION['user'] = ['id'=>$user_id,'email'=>$email,'name'=>$name,'role'=>$role];
    echo '<p>Registration successful. <a href="../index.php">Go to home</a></p>';
} catch (Exception $e){
    $pdo->rollBack();
    die('Registration error: ' . $e->getMessage());
}
