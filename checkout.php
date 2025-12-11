<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header('location:user_login.php');
    exit;
}

if (isset($_POST['order'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);

    $flat = filter_var($_POST['flat'], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
    $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
    $pin_code = filter_var($_POST['pin_code'], FILTER_SANITIZE_STRING);
    $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);

    $address = "$flat, $city, $state, $country - $pin_code, $street";

    $total_products = filter_var($_POST['total_products'], FILTER_SANITIZE_STRING);
    $total_price = filter_var($_POST['total_price'], FILTER_VALIDATE_FLOAT);

    if ($total_price > 0) {
        $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);

        $message[] = 'Pesanan Berhasil Dilakukan!';
    } else {
        $message[] = 'Total pembayaran tidak valid!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

    <form action="" method="POST">

        <h3>Pesanan Anda</h3>

        <div class="display-orders">
        <?php
        $grand_total = 0;
        $total_products = '';

        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
            $qty = isset($_GET['qty']) ? intval($_GET['qty']) : 1;

            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_product->execute([$pid]);

            if ($select_product->rowCount() > 0) {
                $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
                $product_name = $fetch_product['name'];
                $product_price = $fetch_product['price'];
                $grand_total = $product_price * $qty;

                $total_products = $product_name . " (Rp" . number_format($product_price, 0, ',', '.') . " x $qty)";
                echo "<p>$product_name <span>(Rp" . number_format($product_price, 0, ',', '.') . " x $qty)</span></p>";
            } else {
                echo '<p class="empty">Produk tidak ditemukan!</p>';
            }
        } 
        else {
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);

            if($select_cart->rowCount() > 0){
                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                    $product_name = $fetch_cart['name'];
                    $product_price = $fetch_cart['price'];
                    $product_qty = $fetch_cart['quantity'];
                    $sub_total = $product_price * $product_qty;
                    $grand_total += $sub_total;

                    $total_products .= $product_name . " (Rp" . number_format($product_price, 0, ',', '.') . " x $product_qty), ";
                    
                    echo "<p>$product_name <span>(Rp" . number_format($product_price, 0, ',', '.') . " x $product_qty)</span></p>";
                }
                $total_products = rtrim($total_products, ', ');
            } else {
                echo '<p class="empty">Tidak ada produk di keranjang!</p>';
            }
        }
        ?>
            <input type="hidden" name="total_products" value="<?= htmlspecialchars($total_products); ?>">
            <input type="hidden" name="total_price" value="<?= htmlspecialchars($grand_total); ?>">
            <div class="grand-total">Total Pembayaran : <span>Rp<?= number_format($grand_total, 0, ',', '.'); ?></span></div>
        </div>

        <h3>Tempatkan Pesanan Anda</h3>

        <div class="flex">
            <div class="inputBox">
                <span>Nama</span>
                <input type="text" name="name" placeholder="Nama Anda" class="box" maxlength="20" required>
            </div>
            <div class="inputBox">
                <span>Nomor Wa Aktif (Wajib)</span>
                <input type="number" name="number" placeholder="Nomor Wa Anda" class="box" min="0" required>
            </div>
            <div class="inputBox">
                <span>Email</span>
                <input type="email" name="email" placeholder="Email Anda" class="box" required>
            </div>
            <div class="inputBox">
                <span>Metode Pembayaran</span>
                <select name="method" class="box" required>
                    <option value="Cash on Delivery">Cash on Delivery (COD)</option>
                    <option value="Bank Transfer">Transfer Bank</option>
                    <option value="GoPay">GoPay</option>
                    <option value="Dana">DANA</option>
                    <option value="OVO">OVO</option>
                    <option value="ShopeePay">ShopeePay</option>
                    <option value="Credit Card">Kartu Kredit</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Alamat Lengkap</span>
                <input type="text" name="flat" placeholder="Alamat Lengkap Anda" class="box" required>
            </div>
            <div class="inputBox">
                <span>Kota</span>
                <input type="text" name="city" placeholder="Kota Anda" class="box" required>
            </div>
            <div class="inputBox">
                <span>Provinsi</span>
                <input type="text" name="state" placeholder="Provinsi Anda" class="box" required>
            </div>
            <div class="inputBox">
                <span>Negara</span>
                <input type="text" name="country" placeholder="Negara Anda" class="box" required>
            </div>
            <div class="inputBox">
                <span>Kode Pos</span>
                <input type="number" name="pin_code" placeholder="Kode Pos Anda" class="box" min="0" required>
            </div>
            <div class="inputBox">
                <span>Pesan untuk Penjual (Opsional)</span>
                <input type="text" name="street" placeholder="Tulis catatan untuk penjual..." class="box">
            </div>
        </div>

        <input type="submit" name="order" class="btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>" value="Lakukan Pemesanan">

    </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>