<?php
// simple login form
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Login - TutorLink-Lite</title>
<link rel="stylesheet" href="../css/style.css">
</head><body>
<header><h2>Login</h2></header>
<main>
<form method="post" action="login_process.php">
  <label>Email:<br/><input type="email" name="email" required></label><br/>
  <label>Password:<br/><input type="password" name="password" required></label><br/>
  <button>Log in</button>
</form>
</main>
</body></html>
