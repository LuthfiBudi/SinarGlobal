<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">
   <h1 class="heading">Produk Terbaru</h1>

   <div class="box-container">
   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY id DESC"); 
      $select_products->execute();
      if ($select_products->rowCount() > 0) {
      while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
   ?>
   <form action="" method="post" class="box">
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
         <input type="number" name="qty" class="qty" min="1" max="99" value="1">
      </div>
      <input type="submit" value="Masukkan ke keranjang" class="btn" name="add_to_cart">
      <a href="checkout.php?pid=<?= $fetch_product['id']; ?>&qty=1" class="option-btn beli-sekarang" data-pid="<?= $fetch_product['id']; ?>">Beli Sekarang</a>
   </form>
   <?php
      }
   } else {
      echo '<p class="empty">Tidak Ada Produk Yang Ditemukan !</p>';
   }
   ?>
   </div>

</section>

<?php include 'components/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const beliSekarangButtons = document.querySelectorAll('.beli-sekarang');
    
    beliSekarangButtons.forEach(button => {
        const form = button.closest('form');
        const qtyInput = form.querySelector('.qty');
        const pid = button.getAttribute('data-pid');

        updateButtonHref(button, qtyInput, pid);

        qtyInput.addEventListener('input', function() {
            updateButtonHref(button, this, pid);
        });
    });

    function updateButtonHref(button, qtyInput, pid) {
        const qty = qtyInput.value;
        const baseUrl = 'checkout.php';
        const newUrl = `${baseUrl}?pid=${pid}&qty=${qty}`;
        button.href = newUrl;
    }
});
</script>

<script src="js/script.js"></script>

</body>
</html>