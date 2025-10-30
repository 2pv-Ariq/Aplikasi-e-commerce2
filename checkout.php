<?php
require 'db_connect.php';
session_start();
if (empty($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
$uid = $_SESSION['user_id'];

$checkoutSuccess = false;
$orderId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
  $stmt = $pdo->prepare("SELECT c.quantity, p.id_product, p.price FROM carts c JOIN products p ON c.id_product=p.id_product WHERE c.id_user=?");
  $stmt->execute([$uid]);
  $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if ($items) {
    $total = 0;
    foreach ($items as $it) $total += $it['quantity'] * $it['price'];

    $pdo->prepare("INSERT INTO orders (id_user, total_price) VALUES (?, ?)")->execute([$uid, $total]);
    $orderId = $pdo->lastInsertId();

    $insItem = $pdo->prepare("INSERT INTO order_items (id_order, id_product, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($items as $it) {
      $insItem->execute([$orderId, $it['id_product'], $it['quantity'], $it['price']]);
    }

    $pdo->prepare("DELETE FROM carts WHERE id_user=?")->execute([$uid]);

    $checkoutSuccess = true;
  }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Checkout</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="header"><div>E Commerce Cihuyy</div></div>
<div class="container">
  <h2>Checkout</h2>

  <?php if ($checkoutSuccess): ?>
    <div class="success-box">
      <p><strong>Pesanan Anda berhasil di-checkout!</strong></p>
      <p>ID Pesanan Anda: <strong>#<?= htmlspecialchars($orderId) ?></strong></p>
      <p>Terima kasih telah berbelanja di E Commerce Cihuyy.</p>
      <a href="index.php" class="btn">Kembali ke Beranda</a>
    </div>
  <?php else: ?>

    <p>Tekan tombol di keranjang untuk konfirmasi pesanan.</p>
  <?php endif; ?>
</div>
</body>
</html>