<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
 if(isset($_POST['submit'])){
    $email=$_POST['email']; 
    $email=filter_var($email,FILTER_SANITIZE_STRING);

    $pass=$_POST['pass'];
    $pass=filter_var($pass,FILTER_SANITIZE_STRING);

    $select_users= " SELECT * FROM `users` WHERE email ='$email' && password='$pass'";
    $result=mysqli_query($conn,$select_users);
    if(mysqli_num_rows($result) > 0){
        $row=mysqli_fetch_assoc($result);
      setcookie('user_id',$row['id'],time() + 60*60*24*30,'/');
      header('location:home.php');
}else{
       $warning_msg[]='incorrect email or password';
    }
   
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -user login page</title>
    <link rel="stylesheet" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
    .form-container{
        background-image:url("image/banner.jpg");
    }
</style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="banner">
    <div class="detail">
        <h1>login</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>login</span>
    </div>
</div>
<div class="form-container">
<form action="" method="post" enctype="multipart/form-data" class="login">
        <h3>login now</h3>
            <div class="input-field">
                    <p>your email <span>*</span></p>
                    <input type="text" name="email" placeholder="enter your email" maxlength="50" required class="box">
            </div>
               <div class="input-field">
                    <p>your password<span>*</span></p>
                    <input type="password" name="pass" placeholder="enter your password" maxlength="50" required class="box">
                </div> 
    
                <p class="link">do not have an account? <a href="register.php">register now</a></p>
                <input type="submit" name="submit" value="login now" class="btn">
    </form>
   </div> 



    
<?php 
include 'components/footer.php'; 
?>
<!--sweet alert cdn link-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!--custom js link-->
<script src="js/user_script.js"></script>
<?php 
include 'components/alerts.php'; 
?>

</body>
</html>