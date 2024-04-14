<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
 if(isset($_GET['get_id'])){
    $get_id = $_GET['get_id'];
 }else{
    $get_id = '';
    header('location:order.php');
 }
 if(isset($_POST['cancel'])){
    $update_order="UPDATE `orders` SET status='canceled' WHERE id='$get_id'";
    $result=mysqli_query($conn,$update_order);
    header('location:order.php');
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -order detail page</title>
    <link rel="stylesheet" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
    
    .order-detail{
        background-image: url('image/bg1.webp');
        background-size: cover;
        padding: 4rem 0;
    }
    .order-detail .box-container{
        border-radius: .5rem;
        max-width: 1200px;
        margin: 1rem auto;
        padding: 2rem;
    }
    
    .order-detail .box-container .box{
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        align-items: center;
        overflow-x:hidden ;
        padding: 2rem;
    }
    .order-detail .box-container .box .col{
        flex: 1 1 30rem;
        font-size: 1rem;
    }
    .order-detail .box-container .box .image{
        height: 17rem;
        width: 100%;
        object-fit: fill;
        margin: 1rem 0;
    }
    .order-detail .box-container .box .col .title{
        border-radius: .5rem;
        margin-bottom: 1rem;
        padding: .5rem 2rem;
        font-size: 1rem;
        color: #fff;
        background-color: var(--main-color);
        border: 2px solid var(--main-color);
        display: inline-block;
        text-transform: capitalize;
    }
    .order-detail .box-container .box .col .date{
        border-radius: .5rem;
        margin-bottom: 1rem;
        padding: .5rem 2rem;
        font-size: 1rem;
        color: #fff;
        background-color: var(--main-color);
        border: 2px solid var(--main-color);
        display: inline-block;
        text-transform: capitalize;
    }
    .order-detail .box-container .box .col .price{
        color: crimson;
        font-size: 1rem;
        padding: .5rem 0;
        margin-top: -3rem;
    }
    .order-detail .box-container .box .col .name{
        font-size: 1.5rem;
        text-overflow: ellipsis;
        overflow-x: hidden;
    }
    .order-detail .box-container .box .col .user{
        padding: .5rem 0;
        font-size: 1.3rem;
        color: gray;
    }
    .order-detail .box-container .box .col i{
        margin-right: 1rem;
        color: gray;
    }
    .order-detail .box-container .box .col .grand-total{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: .5rem;
        text-transform: capitalize;
        flex-wrap: wrap;
    }
    .order-detail .box-container .box .col .grand-total{
        color: orange;
        text-transform: capitalize;
        font-size: 1.5rem;
    }
    .order-detail .box-container .box .col .status{
        font-size: 1.4rem;
        padding: .5rem;
        text-transform: capitalize;
    }
    .order-detail a{
        margin-top: 3rem;
    }
    .order-detail .box-container .box .col .btn{
        width: 100%;
    
        margin-top: 1rem;
    }


</style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="banner">
    <div class="detail">
        <h1>order detail</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>order detail</span>
    </div>
</div>
<div class="order-detail">
    <div class="heading">
        <h1>my order detail</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum cum harum at similique vero aliquid.</p>
        <img src="image/separator-img.png">
    </div>
    <div class="box-container">
             <?php 
             $grand_total=0;
             $select_order="SELECT * FROM `orders` WHERE id='$get_id' LIMIT 1";
             $result=mysqli_query($conn,$select_order);
             if(mysqli_num_rows($result) > 0){
                while($fetch_order=mysqli_fetch_assoc($result)){
                    $id=$fetch_order['product_id'];
                    $select_product="SELECT * FROM `products` WHERE id='$id' LIMIT 1";
                    $result1=mysqli_query($conn,$select_product);
                    if(mysqli_num_rows($result1) > 0){
                        while($fetch_product=mysqli_fetch_assoc($result1)){
                        $sub_total=(float)$fetch_order['price'] *(float)$fetch_order['qty'];
                        $grand_total +=$sub_total;
                   
    ?>
    <div class="box">
        <div class="col">
        <p class="date"><i class="bx bxs-calender-alt"></i><?=$fetch_order['date']; ?></p>
        <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image">
        <h3 class="name"><?= $fetch_product['name']; ?></h3>
            <p class="price">price: $<?= $fetch_product['price']; ?>/-</p>
            <p class="grand-total">total amount payable: $<span><?= $grand_total; ?> /-</span></p> 
        </div>
        <div class="col">
            <p class="title">billing address</p>
            <p class="user"><i class="bi bi-person-bounding-box"></i><?=$fetch_order['name']; ?></p>
            <p class="user"><i class="bi bi-phone"></i><?=$fetch_order['number']; ?></p>
            <p class="user"><i class="bi bi-envelope"></i><?=$fetch_order['email']; ?></p>
            <p class="user"><i class="bi bi-pin-map-fill"></i><?=$fetch_order['address']; ?></p>
            <p class="status" style="color:<?php if($fetch_order['status'] == 'delivered'){echo'green';}elseif($fetch_order['status'] == 'canceled'){echo'red';}else{echo'orange';} ?>"><?=$fetch_order['status']; ?></p>
        <?php if($fetch_order['status'] == 'canceled'){ ?>
        <a href="checkout.php?get_id=<?=$fetch_product['id']; ?>" class="btn" style="line-height: 4;">order again</a>
        <?php }else{?>
            <form action="" method="post">
                <button type="submit" name="cancel" class="btn" onclick="return confirm ('do you want to cancel this product');">cancel</button>
            </form>
            <?php } ?>
        </div>
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