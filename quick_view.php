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
    <title>Tampilan Produk</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include 'components/user_header.php'; ?>

<section class="quick-view">
    <h1 class="heading">Tampilan Produk</h1>

    <?php
    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$pid]);

        if ($select_products->rowCount() > 0) {
            while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <form action="" method="post" class="box">
        <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
        <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">

        <div class="row">
            <!-- Gambar Produk -->
            <div class="image-container">
                <div class="main-image">
                    <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="<?= $fetch_product['name']; ?>">
                </div>
                <div class="sub-image">
                    <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="<?= $fetch_product['name']; ?>">
                    <?php if (!empty($fetch_product['image_02'])) { ?>
                        <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="<?= $fetch_product['name']; ?>">
                    <?php } ?>
                    <?php if (!empty($fetch_product['image_03'])) { ?>
                        <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="<?= $fetch_product['name']; ?>">
                    <?php } ?>
                </div>
            </div>

            <!-- Konten Produk -->
            <div class="content">
                <div class="name"><?= $fetch_product['name']; ?></div>
                <div class="flex">
                    <div class="price">Rp <?= number_format($fetch_product['price'], 0, ',', '.'); ?></div>
                    <input 
                        type="number" 
                        name="qty" 
                        class="qty" 
                        min="1" 
                        max="99" 
                        value="1" 
                        oninput="updateQty(this)"
                    >
                </div>
                <div class="details"><?= $fetch_product['details']; ?></div>
                <div class="flex-btn">
                    <input type="submit" value="Masukkan Keranjang" class="btn" name="add_to_cart">
                    <a href="checkout.php?pid=<?= $fetch_product['id']; ?>&qty=1" class="option-btn beli-sekarang">Beli Sekarang</a>
                </div>
            </div>
        </div>
    </form>
    <?php
            }
        } else {
            echo '<p class="empty">Belum ada produk yang ditambahkan!</p>';
        }
    } else {
        echo '<p class="empty">Produk tidak ditemukan!</p>';
    }
    ?>
</section>

<?php include 'components/footer.php'; ?>

<script>
    function updateQty(input) {
        const buyNowLink = document.querySelector('.beli-sekarang');
        const qty = input.value;
        const url = new URL(buyNowLink.href);
        url.searchParams.set('qty', qty); 
        buyNowLink.href = url.href;
    }
</script>

<script src="js/script.js"></script>

</body>
</html>
