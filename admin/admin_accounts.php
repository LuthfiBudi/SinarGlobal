<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit;
}

$message = [];

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];

   if($delete_id == $admin_id){
      $message[] = 'Tidak Bisa Menghapus Akun Anda Sendiri!';
   } else {
      $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
      $delete_admins->execute([$delete_id]);
      $message[] = 'Akun Admin Berhasil Dihapus!';
   }

   $_SESSION['msg'] = $message;
   header('location:admin_accounts.php');
   exit;
}

if(isset($_SESSION['msg'])){
   $message = $_SESSION['msg'];
   unset($_SESSION['msg']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">Akun Admin</h1>

   <div class="box-container">

      <div class="box">
         <p>Tambah Admin Baru</p>
         <a href="register_admin.php" class="option-btn">Daftar Admin</a>
      </div>

      <?php
         $select_current_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
         $select_current_admin->execute([$admin_id]);
         $current_admin = $select_current_admin->fetch(PDO::FETCH_ASSOC);
      ?>

      <div class="box" style="border: 2px solid #ffc800ff;">
         <p> ID Admin (Anda) : <span><?= $current_admin['id']; ?></span> </p>
         <p> Nama Admin : <span><?= htmlspecialchars($current_admin['name']); ?></span> </p>

         <div class="flex-btn">
            <a href="update_profile.php" class="option-btn">Update</a>
         </div>
      </div>

      <?php
         $select_accounts = $conn->prepare("SELECT * FROM `admins` WHERE id != ? ORDER BY id ASC");
         $select_accounts->execute([$admin_id]);

         if($select_accounts->rowCount() > 0){
            while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
      ?>
      <div class="box">
         <p> ID Admin : <span><?= $fetch_accounts['id']; ?></span> </p>
         <p> Nama Admin : <span><?= htmlspecialchars($fetch_accounts['name']); ?></span> </p>

         <div class="flex-btn">
            <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" 
               onclick="return confirm('Hapus Akun Ini?')" 
               class="delete-btn">Delete</a>
         </div>
      </div>

      <?php
            }
         } else {
            echo '<p class="empty">Tidak Ada Akun Admin Lain!</p>';
         }
      ?>

   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
