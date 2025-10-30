<?php
require 'db_connect.php';
session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
  $u = trim($_POST['username']);
  $e = trim($_POST['email']);
  $p = $_POST['password'];

  if($u=='' || $e=='' || $p==''){ $err='Lengkapi semua field.'; }
  else {
    
    $stmt = $pdo->prepare("SELECT id_user FROM users WHERE username=? OR email=?");
    $stmt->execute([$u,$e]);
    if($stmt->fetch()) $err='Username atau email sudah dipakai.';
    else{
      $hash = password_hash($p, PASSWORD_DEFAULT);
      $ins = $pdo->prepare("INSERT INTO users (username,password,email) VALUES (?,?,?)");
      $ins->execute([$u,$hash,$e]);
      $_SESSION['user_id'] = $pdo->lastInsertId();
      $_SESSION['username'] = $u;
      header('Location: index.php'); exit;
    }
  }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Register</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="header"><div style="font-weight:bold">E Commerce Cihuyyy</div></div>
<div class="container">
  <h2>Register</h2>
  <?php if(!empty($err)) echo "<div style='color:red'>$err</div>"; ?>
  <form method="post">
    <div><input name="username" placeholder="Username" required></div>
    <div><input name="email" type="email" placeholder="Email" required></div>
    <div><input name="password" type="password" placeholder="Password" required></div>
    <div style="margin-top:8px;"><button class="btn-primary" type="submit">Daftar</button></div>
  </form>
  <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body></html>
