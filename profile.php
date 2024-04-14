<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = 'location:login.php';
 }
 $select_orders="SELECT * FROM `orders` WHERE user_id='$user_id'";
 $result=mysqli_query($conn,$select_orders);
 $total_orders=mysqli_num_rows($result) ;

 $select_message="SELECT * FROM `message` WHERE user_id='$user_id'";
 $result=mysqli_query($conn,$select_message);
 $total_message=mysqli_num_rows($result) ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -user profile page</title>
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
        <h1>profile</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>profile</span>
    </div>
</div>
<section class="profile">
        <div class="heading">
            <h1>profile detail</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="details">
            <div class="user">
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3><?= $fetch_profile['name'];?></h3>
                <span>seller</span>
                <a href="update.php" class="btn">update profile</a>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="flex">
                      <i class="bx bxs-folder-minus"></i>
                    <h3><?= $total_orders; ?></h3> 
                </div>
                <a href="order.php" class="btn">view orders</a>
                </div>
                <div class="box">
                    <div class="flex">
                      <i class="bx bxs-chat"></i>
                    <h3><?= $total_message; ?></h3> 
                </div>
                <a href="message.php" class="btn">view message</a>
                </div>
            </div>
    
 </section>



    
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