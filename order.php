<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
    header('location:login.php');
 }
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -user order page</title>
    <link rel="stylesheet" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
    
    .orders{
        background-image: url('image/bg1.webp');
        background-size: cover;
    }
    .orders .box-container{
        padding: 2% 6%;
    }
    .orders .box-container .box{
        position: relative;
        margin: 1rem;
        border-radius: .5rem;
        overflow: hidden;
    }
    .orders .box-container .box:hover .image{
      transform: scale(1.1);
    }
    .orders .box-container .box .content{
        position: relative;
        display: block;
        background-color: #fff;
        padding: 60px 20px;
        margin-top: -80px;
        border-top-right-radius: 80px;
        text-align: center;
        line-height:1.5;
        text-transform: capitalize;
    }
    .orders .box-container .box .content .shap{
        position: absolute;
        left: 0;
        top: -80px;
        width: 80px;
        height: 80px;
        background-repeat: no-repeat;
    }
    .orders .box-container .box a .row{
        display: flex;
        justify-content: space-between;
    }
    .orders .box-container .box .date{
        position: absolute;
        top: 1%;
        left: 1%;
        padding: .5rem 1.5rem;
        color: #fff;
        font-size: .6rem;
        display: inline-block;
        border-radius: .5rem;
        background-color: var(--main-color);
    }
    .orders .box-container .box .image{
        height: 20rem;
        width: 100%;
        object-fit: cover;
        transition: .5s;
    }
    .orders .box-container .box .name{
        font-size: 1.2rem;
        text-transform: capitalize;
        text-overflow: ellipsis;
        overflow: hidden;
        color: var(--main-color);
    }
    .orders .box-container .box .price{
        font-size: 1.3rem;
        color: #000;
    }
    .orders .box-container .box .status{
        margin-left: .5rem;
        font-size: 1rem;
        text-transform: capitalize;
    }
</style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="banner">
    <div class="detail">
        <h1>my orders</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>my orders</span>
    </div>
</div>
<div class="orders">
    <div class="heading">
        <h1>my orders</h1>
        <img src="image/separator-img.png">
    </div>
<div class="box-container">
    <?php
     $select_orders="SELECT * FROM `orders` WHERE user_id='$user_id' ORDER BY date DESC";
     $result=mysqli_query($conn,$select_orders);
     if(mysqli_num_rows($result) > 0){
         while($fetch_orders=mysqli_fetch_assoc($result)){  
             $product_id=$fetch_orders['product_id'];
             $select_products="SELECT * FROM `products` WHERE id='$product_id'";
             $result1=mysqli_query($conn,$select_products);
             if(mysqli_num_rows($result1) > 0){
             while($fetch_products=mysqli_fetch_assoc($result1)){
    ?>
    <div class="box" <?php if($fetch_orders['status'] == 'canceled'){echo 'style= "border:2px solid red"';} ?>>
<a href="view_order.php?get_id=<?=$fetch_orders['id']; ?>">
<img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image"> 
 <p class="date"><i class="bx bxs-calender-alt"></i><?=$fetch_orders['date']; ?></p>
<div class="content">
            <img src="image/shape-19.png" alt="" class="shap">
          
            <div class="row">
            <h3 class="name"><?= $fetch_products['name']; ?></h3>
            <p class="price">price: $<?= $fetch_products['price']; ?>/-</p>
            <p class="status" style="color:<?php if($fetch_orders['status'] == 'delivered'){echo'green';}elseif($fetch_orders['status'] == 'canceled'){echo'red';}else{echo'orange';} ?>"><?=$fetch_orders['status']; ?></p>
            </div>
</div>
</a>
    </div>
<?php
             }
            }
        }
    }else{
            echo'<p class="empty">
            <p>no orders take placed yet! </p>
        </p>';
        }
    
?>
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