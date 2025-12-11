<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-hp.png" alt="">
         </div>
         <div class="content">
            <span>Diskon Hingga 20%</span>
            <h3>Smartphones Terbaru</h3>
            <a href="category.php?category=smartphone" class="btn">Lihat Produk</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-jam.png" alt="">
         </div>
         <div class="content">
            <span>Diskon Hingga 50%</span>
            <h3>jam tangan terbaru</h3>
            <a href="category.php?category=watch" class="btn">Lihat Produk</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-laptop.png" alt="">
         </div>
         <div class="content">
         <span>Diskon Hingga 40%</span>
            <h3>Laptop Terbaru</h3>
            <a href="category.php?category=laptop" class="btn">Lihat Produk</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-fridge.png" alt="">
         </div>
         <div class="content">
         <span>Diskon Hingga 30%</span>
            <h3>Kulkas Terbaru</h3>
            <a href="category.php?category=fridge" class="btn">Lihat Produk</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-tv.png" alt="">
         </div>
         <div class="content">
         <span>Diskon Hingga 50%</span>
            <h3>Televisi Terbaru</h3>
            <a href="category.php?category=televisi" class="btn">Lihat Produk</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-mouse.png" alt="">
         </div>
         <div class="content">
            <span>Diskon Hingga 20%</span>
            <h3>Mouse Terbaru</h3>
            <a href="category.php?category=mouse" class="btn">Lihat Produk</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-mesincuci.png" alt="">
         </div>
         <div class="content">
            <span>Diskon Hingga 25%</span>
            <h3>Mesin Cuci Terbaru</h3>
            <a href="category.php?category=washing" class="btn">Lihat Produk</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-camera.png" alt="">
         </div>
         <div class="content">
            <span>Diskon Hingga 35%</span>
            <h3>Camera Terbaru</h3>
            <a href="category.php?category=camera" class="btn">Lihat Produk</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">berbelanja berdasarkan kategori</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=laptop" class="swiper-slide slide">
      <img src="images/icon-1.png" alt="">
      <h3>Laptop</h3>
   </a>

   <a href="category.php?category=televisi" class="swiper-slide slide">
      <img src="images/icon-2.png" alt="">
      <h3>Televisi</h3>
   </a>

   <a href="category.php?category=camera" class="swiper-slide slide">
      <img src="images/icon-3.png" alt="">
      <h3>Camera</h3>
   </a>

   <a href="category.php?category=mouse" class="swiper-slide slide">
      <img src="images/icon-4.png" alt="">
      <h3>Mouse</h3>
   </a>

   <a href="category.php?category=kulkas" class="swiper-slide slide">
      <img src="images/icon-5.png" alt="">
      <h3>Kulkas</h3>
   </a>

   <a href="category.php?category=mesin cuci" class="swiper-slide slide">
      <img src="images/icon-6.png" alt="">
      <h3>Mesin Cuci</h3>
   </a>

   <a href="category.php?category=smartphone" class="swiper-slide slide">
      <img src="images/icon-7.png" alt="">
      <h3>Smartphone</h3>
   </a>

   <a href="category.php?category=jam tangan" class="swiper-slide slide">
      <img src="images/icon-8.png" alt="">
      <h3>Jam Tangan</h3>
   </a>

   </div>
   <div class="swiper-pagination"></div>
   </div>

</section>
<section class="home-products">
   <h1 class="heading">Produk Terbaru</h1>
   <div class="swiper products-slider">
   <div class="swiper-wrapper">
   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY `id` DESC LIMIT 6"); 
      $select_products->execute();
      if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price">Rp <?= number_format($fetch_product['price'], 0, ',', '.'); ?></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Tambahkan Ke keranjang" class="btn" name="add_to_cart">
      <a href="checkout.php?pid=<?= $fetch_product['id']; ?>&qty=<?= $_POST['qty'] ?? 1; ?>" class="option-btn beli-sekarang">Beli Sekarang</a>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">belum ada produk yang ditambahkan!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const beliSekarangButtons = document.querySelectorAll('.beli-sekarang');
    beliSekarangButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const qtyInput = this.closest('form').querySelector('.qty');
            const qty = qtyInput ? qtyInput.value : 1;
            const href = this.getAttribute('href').split('&qty=')[0] + '&qty=' + qty;
            
            window.location.href = href;
        });
    });
});

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});
 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});
</script>

</body>
</html>