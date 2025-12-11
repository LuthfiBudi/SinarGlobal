<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $message[] = 'Nama Pengguna Sudah Ada!';
   }else{
      if($pass != $cpass){
         $message[] = 'Konfirmasi Kata Sandi Tidak Cocok!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'Admin Baru Berhasil Didaftar!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">
   <form action="" method="post">
      <div class="logo" style="background-image: url('../images/logo.png'); background-size: cover; background-position: center; border: none;">
      </div>
      
      <h3>Registrasi Admin</h3>
      
      <div class="input-group">
         <label for="username">Username</label>
         <input type="text" name="name" id="username" required placeholder="Masukkan username" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      <div class="input-group">
         <label for="password">Password</label>
         <input type="password" name="pass" id="password" required placeholder="Masukkan password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      <div class="input-group">
         <label for="cpassword">Konfirmasi Password</label>
         <input type="password" name="cpass" id="cpassword" required placeholder="Konfirmasi password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      <input type="submit" value="Daftar Sekarang" class="btn" name="submit">
   </form>
</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>
