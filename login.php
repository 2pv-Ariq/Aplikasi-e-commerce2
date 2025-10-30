<?php
require 'db_connect.php';
session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
  $u = trim($_POST['username']);
  $p = $_POST['password'];
  $stmt = $pdo->prepare("SELECT id_user, password, is_admin FROM users WHERE username=? OR email=? LIMIT 1");
  $stmt->execute([$u,$u]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row && password_verify($p, $row['password'])){
    $_SESSION['user_id'] = $row['id_user'];
    $_SESSION['username'] = $u;
    $_SESSION['is_admin'] = $row['is_admin'];
    header('Location: index.php'); exit;
  } else { $err='Username atau password salah.'; }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Login</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="header"><div>E Commerce Cihuyy</div></div>
<div class="container">
  <h2>Login</h2>
  <?php if(!empty($err)) echo "<div style='color:red'>$err</div>"; ?>
  <form method="post">
    <div><input name="username" placeholder="Username atau email" required></div>
    <div><input name="password" type="password" placeholder="Password" required></div>
    <div style="margin-top:8px;"><button class="btn-primary" type="submit">Login</button></div>
  </form>
  <p>Belum punya akun? <a href="register.php">Register</a></p>
</div>
</body></html>
