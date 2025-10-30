<?php
require 'db_connect.php';
session_start();

if(empty($_SESSION['user_id'])){ 
    header('Location: login.php'); 
    exit; 
}
$uid = $_SESSION['user_id'];


if($_SERVER['REQUEST_METHOD']==='POST' && $_POST['action']==='add'){
    $idp = (int)$_POST['id_product'];
    $s = $pdo->prepare("SELECT quantity FROM carts WHERE id_user=? AND id_product=?");
    $s->execute([$uid,$idp]);
    $row = $s->fetch();
    if($row){
        $upd = $pdo->prepare("UPDATE carts SET quantity = quantity + 1 WHERE id_user=? AND id_product=?");
        $upd->execute([$uid,$idp]);
    } else {
        $ins = $pdo->prepare("INSERT INTO carts (id_user,id_product,quantity) VALUES (?,?,1)");
        $ins->execute([$uid,$idp]);
    }
    
    header("Location: cart.php");
    exit;
}

// Logika hapus produk dari cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
  $idp = (int)$_POST['id_product'];
  $del = $pdo->prepare("DELETE FROM carts WHERE id_user=? AND id_product=?");
  $del->execute([$uid, $idp]);
  header("Location: cart.php");
  exit;
}



$stmt = $pdo->prepare("SELECT c.quantity, p.* FROM carts c JOIN products p ON c.id_product=p.id_product WHERE c.id_user=?");
$stmt->execute([$uid]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
foreach($items as $it) $total += $it['price'] * $it['quantity'];
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Keranjang</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="header"><div>E Commerce Cihuyy</div></div>
<div class="container">
  <h2>Keranjang Anda</h2>
   <form action="index.php" method="post">
      <button type="submit" name="confirm" value="1" class="btn-primary">Home</button>
    </form>
  <?php if(empty($items)): ?>
    <div class="card">Keranjang kosong. <a href="index.php">Belanja sekarang</a></div>
  <?php else: ?>
    <table class="table">
      <tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th><th>Action</th></tr>
      <?php foreach($items as $it): ?>
      <tr>
        <td><?=htmlspecialchars($it['name'])?></td>
        <td><?=number_format($it['price'],0,',','.')?></td>
        <td><?= $it['quantity'] ?></td>
        <td><?=number_format($it['price']*$it['quantity'],0,',','.')?></td>
          <td>
            <form action="cart.php" method="post" style="display:inline">
              <input type="hidden" name="id_product" value="<?= $it['id_product'] ?>">
              <input type="hidden" name="action" value="delete">
              <button type="submit" class="btn-danger" onclick="return confirm('Hapus produk dari keranjang?')">Hapus</button>
            </form>
          </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p style="text-align:right;font-weight:bold">Total: <?=number_format($total,0,',','.')?> IDR</p>
    <form action="checkout.php" method="post">
      <button type="submit" name="confirm" value="1" class="btn-primary">Checkout</button>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
