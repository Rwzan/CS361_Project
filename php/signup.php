<?php
// Signup page shows form and posts to register.php
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Sign up - TutorLink-Lite</title>
<link rel="stylesheet" href="../css/style.css">
</head><body>
<header><h2>Sign up</h2></header>
<main>
<form id="signupForm" method="post" action="register.php">
  <label>Name:<br/><input type="text" name="name" required></label><br/>
  <label>Email:<br/><input type="email" name="email" required></label><br/>
  <label>Password:<br/><input type="password" name="password" required></label><br/>
  <label>Role:<br/>
    <select name="role">
      <option value="">-- select --</option>
      <option value="student">Student</option>
      <option value="tutor">Tutor</option>
    </select>
  </label><br/>
  <label>City:<br/><input type="text" name="city" required></label><br/>
  <button onclick="validateSignupForm(event)">Create account</button>
</form>
</main>
<script src="../js/signup_validation.js"></script>
</body></html>
