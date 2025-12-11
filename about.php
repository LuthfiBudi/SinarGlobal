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
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">
   <div class="row">
      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>
      <div class="content">
         <h3>Mengapa Memilih Kami?</h3>
         <p><b>Sinar Global Electronics</b> adalah toko yang menyediakan berbagai
            produk elektronik berkualitas tinggi dengan harga terjangkau.
            Kami berkomitmen untuk memberikan pengalaman belanja
            yang terbaik kepada pelanggan, dengan menyediakan pilihan
            produk terbaru dari merek terkemuka di dunia elektronik.
            Sejak didirikan, Sinar Global Electronics bertujuan untuk 
            menjadi mitra terpercaya dalam memenuhi kebutuhan elektronik 
            di rumah maupun di tempat kerja. Kami menawarkan produk mulai dari
            Terima kasih telah memilih Sinar Global Electronics sebagai pilihan
            belanja Anda! Kami berkomitmen untuk terus memberikan yang terbaik.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>
   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>
</body>
</html>