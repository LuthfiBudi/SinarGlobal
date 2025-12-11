<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit;
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = filter_var($_POST['payment_status'], FILTER_SANITIZE_STRING);

   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);

   $message[] = 'Status Pembayaran Berhasil Diperbarui!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];

   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);

   header('location:placed_orders.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesanan</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="orders">

<h1 class="heading">Pesanan</h1>

<?php  
$status_filter = '';

if (isset($_GET['status'])) {
   $status_filter = $_GET['status'];
   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ? ORDER BY id DESC");
   $select_orders->execute([$status_filter]);
} else {
   $select_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY id DESC");
   $select_orders->execute();
}
?>

<div class="box-container">

<?php
if ($select_orders->rowCount() > 0) {
   while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
?>

   <div class="box">
      <p>Tanggal Pemesanan : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Nama : <span><?= $fetch_orders['name']; ?></span></p>
      <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>No HP : <span><?= $fetch_orders['number']; ?></span></p>
      <p>Alamat Lengkap : <span><?= $fetch_orders['address']; ?></span></p>

      <?php if (!empty($fetch_orders['street'])) { ?>
      <p>Catatan Pembeli : <span><?= $fetch_orders['street']; ?></span></p>
      <?php } ?>

      <p>Produk : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Total Harga : <span>Rp<?= number_format($fetch_orders['total_price'], 0, ',', '.'); ?></span></p>
      <p>Metode Pembayaran : <span><?= $fetch_orders['method']; ?></span></p>

      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">

         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="Pesanan Tertunda">Pesanan Tertunda</option>
            <option value="Pesanan Dikirim">Pesanan Dikirim</option>
            <option value="Pesanan Selesai">Pesanan Selesai</option>
            <option value="Pesanan Dibatalkan">Pesanan Dibatalkan</option>
         </select>

         <div class="flex-btn">
            <input type="submit" value="Update" class="option-btn" name="update_payment">
            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" 
               class="delete-btn" 
               onclick="return confirm('Hapus pesanan ini?');">Hapus</a>
         </div>
      </form>
   </div>

<?php
   }
} else {
   if ($status_filter == 'Pesanan Tertunda') {
      echo '<p class="empty">Tidak ada pesanan tertunda!</p>';
   } elseif ($status_filter == 'Pesanan Dibatalkan') {
      echo '<p class="empty">Tidak ada pesanan dibatalkan!</p>';
   } elseif ($status_filter == 'Pesanan Dikirim') {
      echo '<p class="empty">Tidak ada pesanan dikirim!</p>';
   } elseif ($status_filter == 'Pesanan Selesai') {
      echo '<p class="empty">Tidak ada pesanan selesai!</p>';
   } else {
      echo '<p class="empty">Belum ada pesanan!</p>';
   }
}
?>

</div>

</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
