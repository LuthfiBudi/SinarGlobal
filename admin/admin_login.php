<?php
include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'Username atau kata sandi salah!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin.css">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<section class="form-container">
   <form action="" method="post">
<div class="logo" style="background-image: url('../images/logo.png'); background-size: cover; background-position: center; border: none;">
</div>
      
      <h3>Login Admin</h3>
      
      <div class="input-group">
         <label for="email">Username</label>
         <input type="text" name="name" id="email" required placeholder="Masukkan username   " maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      <div class="input-group">
         <label for="password">Password</label>
         <input type="password" name="pass" id="password" required placeholder="Masukkan password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <input type="submit" value="Login" class="btn" name="submit">
   </form>
</section>
   
</body>
</html>