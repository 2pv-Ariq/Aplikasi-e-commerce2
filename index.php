<?php
require 'db_connect.php';
session_start();


if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = (float)$_POST['price'];
    $desc = trim($_POST['description']);

  
    $img = 'images/placeholder.jpg';
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "images/";
        if (!is_dir($targetD)) mkdir($targetDir, 0755, true);
        $fn = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fn;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $img = "images/" . $fn;
        }
    }   

    $ins = $pdo->prepare("INSERT INTO products (name, price, description, image_url) VALUES (?,?,?,?)");
    $ins->execute([$name, $price, $desc, $img]);
    $msg = "Produk berhasil ditambahkan!";
}


$cartCount = 0;
if (!empty($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT SUM(quantity) FROM carts WHERE id_user=?");
    $stmt->execute([$_SESSION['user_id']]);
    $cartCount = $stmt->fetchColumn() ?: 0;
}


$products = $pdo->query("SELECT * FROM products ORDER BY id_product DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>E Commerce Ariqq</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="images/logo.jpg">
</head>
<body>
<div class="header">
  <div style="font-weight:bold">E Commerce Cihuyy</div>
  <div class="nav">
  <?php if(!empty($_SESSION['username'])): ?>
    Halo, <?=htmlspecialchars($_SESSION['username'])?> |
    <a href="cart.php">Keranjang <span class="cart-count"><?= $cartCount ?></span></a>
    <a href="logout.php">Logout</a>
  <?php else: ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  <?php endif; ?>

  <?php if(!empty($_SESSION['is_admin']) && $_SESSION['is_admin']==1): ?>
    <a href="admin/manage_products.php">Kelola Produk</a>
  <?php else: ?>
    <!-- <a href="admin/admin_login.php">Admin</a> -->
  <?php endif; ?>
</div>

</div>

<div class="container">

  <?php if(!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
    <h2>Tambah Produk</h2>
    <?php if(!empty($msg)) echo "<div class='success'>$msg</div>"; ?>
    <form method="post" enctype="multipart/form-data" style="margin-bottom:20px;">
      <input type="hidden" name="add_product" value="1">
      <input type="" name="name" placeholder="Nama produk" required>
      <input type="number" step="0.01" name="price" placeholder="Harga" required>
      <textarea name="description" placeholder="Deskripsi produk"></textarea>
      <input type="file" name="image" accept="image/*">
      <button type="submit" class="btn-primary">Tambah Produk</button>
    </form>
  <?php endif; ?>

  <h2>Produk</h2>
  <div class="products">
    <?php foreach($products as $p): ?>
      <div class="card">
        <img src="<?=htmlspecialchars($p['image_url'] ?: 'images/placeholder.jpg')?>" alt="">
        <h3><?=htmlspecialchars($p['name'])?></h3>
        <p><?=number_format($p['price'],0,',','.')?> IDR</p>
        <p style="font-size:14px;color:#555"><?=htmlspecialchars($p['description'])?></p>
        <?php if(!empty($_SESSION['user_id'])): ?>
        <form method="post" action="cart.php">
          <input type="hidden" name="action" value="add">
          <input type="hidden" name="id_product" value="<?= $p['id_product'] ?>">
          <button type="submit" class="btn-primary">Tambah ke Keranjang</button>
        </form>
        <?php else: ?>
        <p><a href="login.php">Login dulu untuk membeli</a></p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="footer">
  &copy; <?= date('Y') ?> E Commerce Cihuyy | Dibuat oleh <b>M Shafa Ariq Yasaputra</b>. Gelooooooo.
</div>

</body>
</html>
