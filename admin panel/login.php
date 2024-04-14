<?php
include '../components/connect.php';

if(isset($_POST['submit'])){
   
    $email=$_POST['email']; 
    $email=filter_var($email,FILTER_SANITIZE_STRING);

    $pass=$_POST['pass'];
    $pass=filter_var($pass,FILTER_SANITIZE_STRING);

    $select_sellers= " SELECT * FROM `sellers` WHERE email ='$email' && password='$pass'";
    $result=mysqli_query($conn,$select_sellers);
    if(mysqli_num_rows($result) > 0){
        $row=mysqli_fetch_assoc($result);
      setcookie('seller_id',$row['id'],time() + 60*60*24*30,'/');
      header('location:dashboard.php');
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
    <title>gulu gulu -seller registeration page </title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
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


<!--sweet alert cdn link-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!--custom js link-->
<script src="../js/script.js"></script>
<?php 
include '../components/alerts.php'; 
?>
</body>
</html> 