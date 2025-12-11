<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>Selamat Datang!</h3>
         <p><?= htmlspecialchars($fetch_profile['name']); ?></p>
         <a href="update_profile.php" class="btn">Memperbaharui Profil</a>
      </div>

      <div class="box">
         <?php
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['Pesanan Tertunda']);
            $total_pendings = $select_pendings->rowCount();
         ?>
         <h3><?= $total_pendings; ?></h3>
         <p>Pesanan Tertunda</p>
         <a href="placed_orders.php?status=Pesanan Tertunda" class="btn">Lihat Pesanan</a>
      </div>

      <div class="box">
         <?php
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['Pesanan Dikirim']);
            $total_pendings = $select_pendings->rowCount();
         ?>
         <h3><?= $total_pendings; ?></h3>
         <p>Pesanan Dikirim</p>
         <a href="placed_orders.php?status=Pesanan Dikirim" class="btn">Lihat Pesanan</a>
      </div>
      
      <div class="box">
         <?php
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['Pesanan Selesai']);
            $total_completes = $select_completes->rowCount();
         ?>
         <h3><?= $total_completes; ?></h3>
         <p>Pesanan Selesai</p>
         <a href="placed_orders.php?status=Pesanan Selesai" class="btn">Lihat Pesanan</a>
      </div>
      
      <div class="box">
         <?php
            $select_cancelled = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_cancelled->execute(['Pesanan Dibatalkan']);
            $total_cancelled = $select_cancelled->rowCount();
         ?>
         <h3><?= $total_cancelled; ?></h3>
         <p>Pesanan Dibatalkan</p>
         <a href="placed_orders.php?status=Pesanan Dibatalkan" class="btn">Lihat Pesanan</a>
      </div>


      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount();
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>Produk Ditambahkan</p>
         <a href="products.php" class="btn">Lihat produk</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount();
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Akun Users</p>
         <a href="users_accounts.php" class="btn">Lihat users</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount();
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>Akun Admins</p>
         <a href="admin_accounts.php" class="btn">Lihat Admins</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount();
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>Pesan Baru</p>
         <a href="messages.php" class="btn">Lihat messages</a>
      </div>

   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>
