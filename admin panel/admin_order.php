<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }
// update order from  database
if(isset($_POST['update_order'])){
    $order_id=$_POST['order_id'];
    $order_id=filter_var($order_id,FILTER_SANITIZE_STRING);
   
    $update_payment=$_POST['update_payment'];
    $update_payment=filter_var($update_payment,FILTER_SANITIZE_STRING);

    $update_pay="UPDATE `orders` SET payment_status='$update_payment' WHERE id='$order_id'";
    $result=mysqli_query($conn,$update_pay);
    $success_msg[]='order payment status updated ';
}
//delete order
if(isset($_POST['delete_order'])){
    $delete_id=$_POST['order_id'];
    $delete_id=filter_var($delete_id,FILTER_SANITIZE_STRING);

    $verify_delete="SELECT FROM `orders` WHERE id='$delete_id'";
    $result=mysqli_query($conn,$verify_delete);

    if(mysqli_num_rows($result)> 0){
        $delete_order="DELETE FROM `orders` WHERE id='$delete_id'";
        $result=mysqli_query($conn,$delete_order);
        $success_msg[]='order deleted';
   }else{
    $warning_msg[]='order already deleted';
   }
   
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
    <style>
        .box{
            padding: 1rem;
            position: relative;
        }
        .box .status{
            position: absolute;
            left: -4%;
            top: 1%;
            text-transform: uppercase;
            font-size: 1rem;
            margin-bottom: 1rem;
            border-radius: .5rem;
            box-shadow: var(--box-shadow);
            background-color: var(--white-alpha-40);
            display: inline-block;
            padding: .5rem;
        }
        .box .details{
            margin-top: 3rem;
            line-height:2;
            color: gray;
            text-transform: capitalize;
        }
        .box span{
            text-transform: none;
        }
    </style>
</head>
<body>
    <div class="main-container">
     <?php 
include '../components/admin_header.php'; 
?>  
 <section class="order-container">
         <div class="heading">
            <h1>total order placed</h1>
            <img src="../image/separator-img.png">
         </div>
        <div class="box-container">
        <?php 
        $select_order=" SELECT * FROM `orders` WHERE seller_id='$seller_id'";
        $result=mysqli_query($conn, $select_order);
        if(mysqli_num_rows($result) > 0){
            while($fetch_order=mysqli_fetch_assoc($result)){
?>
<div class="box">
<div class="status" style="color: <?php if($fetch_order['status']=='in progress'){
          echo"limegreen";}else{echo"red";} ?>"><?= $fetch_order['status']; ?></div>
       <div class="details">
       <p>user name: <span><?= $fetch_order['name']; ?></span></p>
          <p>user id: <span><?= $fetch_order['user_id']; ?></span></p>
          <p>placed on: <span><?= $fetch_order['date']; ?></span></p>
          <p>user number: <span><?= $fetch_order['number']; ?></span></p>
          <p>user email: <span><?= $fetch_order['email']; ?></span></p>
          <p>total price: <span><?= $fetch_order['price']; ?></span></p>
          <p>payment method: <span><?= $fetch_order['method']; ?></span></p>
          <p>user address: <span><?= $fetch_order['address']; ?></span></p>
       </div>
       <form action="" method="post">
       <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
       <select name="update_payment" class="box" style="width: 90%;">
            <option disabled selected><?=$fetch_order['payment_status']; ?></option>
        <option value="pending">pending</option>
        <option value="order delivered">order delivered</option>
        </select>
        <div class="flex-btn">
  <input type="submit" name="update_order" value="update payment" class="btn">
  <input type="submit" name="delete_order" value="delete order" class="btn" onclick="return confirm('delete this order')">
</div>
       </form>
</div>
<?php
            }
        }else{
            echo'
               <div class="empty">
        <p>no order placed yet! </p>
        </div>
            ';
        }
?>
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