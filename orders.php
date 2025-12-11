<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesanan</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">Pesanan</h1>

   <div class="box-container">

   <?php
   if($user_id == ''){
      echo '<p class="empty">Silahkan Login Untuk Melihat Pesanan Anda</p>';
   }else{
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY id DESC");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>Tanggal Pemesanan : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Nama : <span><?= $fetch_orders['name']; ?></span></p>
      <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Nomor WhatsApp : <span><?= $fetch_orders['number']; ?></span></p>

      <?php
         $address_parts = explode(',', $fetch_orders['address']);
         $flat = $address_parts[0] ?? '';
         $city = trim($address_parts[1] ?? '');
         $state = trim($address_parts[2] ?? '');
         $country_and_pin = trim($address_parts[3] ?? '');
         $street = trim($address_parts[4] ?? ''); 

         $country = trim(explode('-', $country_and_pin)[0] ?? '');
         $pin_code = trim(explode('-', $country_and_pin)[1] ?? '');
      ?>
      <p>Alamat :
         <span>
            <?= $flat ?>, <?= $city ?>, <?= $state ?>, <?= $country ?> - <?= $pin_code ?>
         </span>
      </p>

      <?php if($street !== '' && strtolower($street) !== 'null') : ?>
      <p>Catatan untuk Penjual : <span><?= $street; ?></span></p>
      <?php endif; ?>

      <p>Metode pembayaran : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Pesanan Anda : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Total Harga : 
         <span>Rp<?= number_format($fetch_orders['total_price'], 0, ',', '.'); ?></span>
      </p>

      <p>Status pembayaran : 
         <span style="color:<?= 
            ($fetch_orders['payment_status'] == 'Pesanan Tertunda' || 
            $fetch_orders['payment_status'] == 'Pesanan Dibatalkan') ? 'red' : 'green'; 
         ?>">
         <?= $fetch_orders['payment_status']; ?>
         </span>
      </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">Belum Ada Pesanan!</p>';
      }
      }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>