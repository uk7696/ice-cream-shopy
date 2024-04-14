<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }
$select_products="SELECT * FROM `products` WHERE seller_id='$seller_id'";
 $result=mysqli_query($conn,$select_products);
 $total_products=mysqli_num_rows($result) ;

 $select_orders="SELECT * FROM `orders` WHERE seller_id='$seller_id'";
 $result=mysqli_query($conn,$select_orders);
 $total_orders=mysqli_num_rows($result) ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -seller profile page </title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
.details{
background-color: var(--white-alpha-25);
border: 2px solid var(--white-alpha-40);
backdrop-filter: var(--backdrop-filter);
box-shadow: var(--box-shadow);
align-items: center;
text-align: center;
 border-radius: .5rem;
padding: 1rem;
}
 .details .seller{
margin-bottom: 2rem;
text-align: center;
}
 .seller img{
width: 10rem;
height: 10rem;
border-radius: 50%;
object-fit: cover;
margin-bottom: .5rem;
padding: .5rem;
background-color: var(--main-color);
}
 .seller h3{
font-size: 1.2rem;
margin: .5rem 0;
text-transform: capitalize;
}
 .seller span{
font-size: 1.2rem;
color: gray;
display: block;
margin-bottom: 2rem;
text-transform: capitalize;
}
.details .flex{
display: flex;
gap: 1.5rem;
align-items: center;
flex-wrap: wrap;
margin: 4rem 0;
}
 .flex .box{
flex: 1 1 18rem ;
border-radius: .5rem;
background-color: #cccccc33;
padding: 2rem;

}
 .flex .box span{
color: var(--main-color);
display: block;
margin-bottom: .5rem;
font-size: 2.5rem;
text-transform: capitalize;
}
 .flex .box p{
font-size: 2rem;
color: #000;
padding: .8rem 0;
margin-bottom: 1rem;
}
</style>
</head>
<body>
    <div class="main-container">
     <?php 
include '../components/admin_header.php'; 
?>  
 <section class="seller-profile">
        <div class="heading">
            <h1>profile details</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="details">
            <div class="seller">
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3 class="name"><?= $fetch_profile['name'];?></h3>
                <span>seller</span>
                <a href="update.php" class="btn">update profile</a>
            </div>
            <div class="flex">
                <div class="box">
               <span><?= $total_products; ?></span>
                <p>total products</p>
                <a href="view_product.php" class="btn">view product</a>
                </div>
                <div class="box">
               <span><?= $total_orders; ?></span>
                <p>total orders placed</p>
                <a href="admin_order.php" class="btn">view order</a>
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