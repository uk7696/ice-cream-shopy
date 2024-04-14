<?php

include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -admin dashboard page </title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <div class="main-container">
     <?php 
include '../components/admin_header.php'; 
?>  
 <section class="dashboard">
         <div class="heading">
            <h1>dashboard</h1>
            <img src="../image/separator-img.png">
         </div>
        <div class="box-container">
            <div class="box">
                <h3>welcome</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="update.php" class="btn">update profile</a>
            </div>
            <div class="box">
                <?php
                $select_message="SELECT * FROM `message`";
                $result=mysqli_query($conn,$select_message);
                $number_of_msg=mysqli_num_rows($result);
                ?>
                <h3><?= $number_of_msg; ?></h3>
                <p>unread message</p>
                <a href="admin_message.php" class="btn">see messge</a>
            </div>
            <div class="box">
                <?php
                $select_products="SELECT * FROM `products` WHERE seller_id='$seller_id'";
                $result=mysqli_query($conn,$select_products);
                $number_of_products=mysqli_num_rows($result);
                ?>
                <h3><?= $number_of_products; ?></h3>
                <p>products added</p>
                <a href="add_products.php" class="btn">add product</a>
            </div>
            <div class="box">
                <?php
                $select_active_products="SELECT * FROM `products` WHERE seller_id='$seller_id' && status='active'";
                $result=mysqli_query($conn,$select_active_products);
                $number_active_of_products=mysqli_num_rows($result);
                ?>
                <h3><?= $number_active_of_products; ?></h3>
                <p>total active products</p>
                <a href="view_product.php" class="btn">active product</a>
            </div> 
            <div class="box">
                <?php
                $select_deactive_products="SELECT * FROM `products` WHERE seller_id='$seller_id' && status='deactive'";
                $result=mysqli_query($conn,$select_deactive_products);
                $number_deactive_of_products=mysqli_num_rows($result);
                ?>
                <h3><?= $number_deactive_of_products; ?></h3>
                <p>total deactive products</p>
                <a href="view_product.php" class="btn">deactive product</a>
            </div> 
            <div class="box">
                <?php
                $select_users="SELECT * FROM `users`";
                $result=mysqli_query($conn,$select_users);
                $number_of_users=mysqli_num_rows($result);
                ?>
                <h3><?= $number_of_users; ?></h3>
                <p>users account</p>
                <a href="user_accounts.php" class="btn">see users</a>
            </div>
            <div class="box">
                <?php
                $select_sellers="SELECT * FROM `sellers`";
                $result=mysqli_query($conn,$select_sellers);
                $number_of_sellers=mysqli_num_rows($result);
                ?>
                <h3><?= $number_of_sellers; ?></h3>
                <p>sellers account</p>
                <a href="user_accounts.php" class="btn">see sellers</a>
            </div>
            <div class="box">
                <?php
                $select_orders="SELECT * FROM `orders` WHERE seller_id='$seller_id'";
                $result=mysqli_query($conn,$select_orders);
                $number_of_orders=mysqli_num_rows($result);
                ?>
                <h3><?= $number_of_orders; ?></h3>
                <p>total orders placed</p>
                <a href="admin_order.php" class="btn">total orders</a>
            </div>
            <div class="box">
                <?php
                $select_confirm_orders="SELECT * FROM `orders` WHERE seller_id='$seller_id' && status='in progress'";
                $result=mysqli_query($conn,$select_confirm_orders);
                $number_of_confirm_orders=mysqli_num_rows($result);
                ?>
                <h3><?= $number_of_confirm_orders; ?></h3>
                <p>total confirm orders</p>
                <a href="admin_order.php" class="btn">confirm orders</a>
            </div>
            <div class="box">
                <?php
                $select_canceled_orders="SELECT * FROM `orders` WHERE seller_id='$seller_id' && status='canceled'";
                $result=mysqli_query($conn,$select_canceled_orders);
                $number_of_canceled_orders=mysqli_num_rows($result);
                ?>
                <h3><?= $number_of_canceled_orders; ?></h3>
                <p>total canceled orders</p>
                <a href="admin_order.php" class="btn">canceled orders</a>
            </div>
         </div>
    </section>
    </div>
   


<!--sweet alert cdn link-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!--custom js link-->
<script src="../js/admin_script.js"></script>
<?php 
include '../components/alerts.php'; 
?>
</body>
</html>  
               