<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = 'location:login.php';
 }
 if(isset($_POST['update_cart'])){

    $cart_id=$_POST['cart_id'];
    $cart_id=filter_var($cart_id,FILTER_SANITIZE_STRING);
    $qty=$_POST['qty'];
    $qty=filter_var($qty,FILTER_SANITIZE_STRING);
    $update_qty="UPDATE `cart` SET qty='$qty' WHERE id='$cart_id'";
    $result=mysqli_query($conn,$update_qty);
    if($result){
    $success_msg[]="cart quantity updated successfully";
 }
 else{
    $warning_msg[]="error";
 }
}
if(isset($_POST['delete_item'])){

    $cart_id=$_POST['cart_id'];
    $cart_id=filter_var($cart_id,FILTER_SANITIZE_STRING);
  
    $verify_delete_item="SELECT * FROM `cart` WHERE id='$cart_id'";
    $result=mysqli_query($conn,$verify_delete_item);
    if(mysqli_num_rows($result) > 0){
        $delete_cart_id="DELETE FROM `cart` WHERE id='$cart_id'";
        $result=mysqli_query($conn,$delete_cart_id);
        $success_msg[]='cart item delete successfully';
 }
 else{
    $warning_msg[]='cart item already removed';
 }
}
if(isset($_POST['empty_cart'])){
    $verify_empty_item="SELECT * FROM `cart` WHERE user_id='$user_id'";
    $result=mysqli_query($conn,$verify_empty_item);
    if(mysqli_num_rows($result) > 0){
        $delete_cart_id="DELETE FROM `cart` WHERE user_id='$user_id'";
        $result=mysqli_query($conn,$delete_cart_id);
        $success_msg[]='empty cart successfully';
 }
 else{
    $warning_msg[]='your cart is already empty';
 }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -user cart page</title>
    <link rel="stylesheet" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
    .form-container{
        background-image:url("image/banner.jpg");
    }
    .products{
    background-image: url('image/bg1.webp');
    padding: 4%;
}
.products .box-container .box{
    position: relative;
    margin: 1rem;
    overflow: hidden;
}
.products .box-container .box .stock{
    position: absolute;
    top: 2%;
    left: 2%;
    font-size: 1rem;
    background-color: var(--white-alpha-40);
    padding: .4rem 1rem;
    border-radius: 10px;
}
.products .box-container .box .image{
    width: 100%;
    height: 25rem;
    object-fit: cover;
    transition: .5s;
    background-color: palegreen;
}
.products .box-container .box:hover .image{
    transform: scale(1.1);
} 
.products .box-container .box .content{
    position: relative;
    display: block;
    background-color: #fff;
    padding: 40px 10px;
    margin-top:-80px ;
    border-top-right-radius: 80px;
    text-align: center;
    line-height: 1.5;
    text-transform: capitalize;
}
.products .box-container .box .content .shap{
    position: absolute;
    left: 0;
    top: -80px;
    width: 80px;
    height: 80px;
    background-repeat: no-repeat;

}
.products .box-container .box  h3{
    text-transform: capitalize;
    font-size: 18px;

}
.products .box-container .box .price{
    position: absolute;
    top: 4%;
    left: 4%;
    text-transform: capitalize;
    font-weight: bold;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}
.products .box-container .box .button{
display: flex;
justify-content: space-between;
margin: 1rem 0;
}
.products .box-container .box .button button{
    background-color: transparent;
    cursor:pointer;
}
.products .box-container .box .button i,
.products .box-container .box .button a{
    color: var(--main-color);
    margin: 0 .5rem;
    font-size: 1.8rem;
}
.products .box-container .box .button i:hover,
.products .box-container .box .button :hover{
color: var(--main-color);
}
.products .box-container .box .flex-btn{
    justify-content: space-between;
}
.products .box-container .box .flex-btn input{
    width: 48%;
    color: var(--main-color);
    padding:.6rem 2rem;
    border-radius: 1.5rem;
    font-size: 18px;
}
.products .more{
    margin: 3rem auto;
    text-align: center;
}
.products .fa-edit{
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--main-color);
    width: 200px;
    border-radius: 20px;
}
.cart-total{
    text-align: center;
    padding: 4%;
    margin: 2rem;
    box-shadow: var(--box-shadow);
}
.cart-total p{
    font-size: 1.5rem;
    margin: 2rem 0;
    text-transform: capitalize;
}
.cart-total p span{
    color: var(--main-color);
    font-size: 2rem;
    font-weight: bold;
}
.cart-total .button{
    display: flex;
    align-items: center;
    justify-content: center;
}
.cart-total .btn{
    margin: .5rem;
}
</style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="banner">
    <div class="detail">
        <h1>cart</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>cart</span>
    </div>
</div>
<div class="products">
         <div class="heading">
            <h1>my wishlist</h1>
            <img src="image/separator-img.png">
         </div>
         <div class="box-container">
             <?php 
             $grand_total=0;
             $select_cart="SELECT * FROM `cart` WHERE user_id='$user_id'";
             $result=mysqli_query($conn,$select_cart);
             if(mysqli_num_rows($result) > 0){
                while($fetch_cart=mysqli_fetch_assoc($result)){
                    $id=$fetch_cart['product_id'];
                    $select_products="SELECT * FROM `products` WHERE id='$id'";
                    $result1=mysqli_query($conn,$select_products);
                    if(mysqli_num_rows($result1) > 0){
                        $fetch_products=mysqli_fetch_assoc($result1);
             ?> <form action="" method="post" class="box" <?php if($fetch_products['stock']== 0){
                echo"disabled";
            }; ?>>
             <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
             <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
             <?php if($fetch_products['stock'] > 9){ ?>
        <span class="stock" style="color:green;">in stock</span>
        <?php } elseif($fetch_products['stock'] == 0){ ?>
        <span class="stock" style="color:red;">out of stock</span>
        <?php } else{ ?>
        <span class="stock" style="color:red;">left <?= $fetch_products['stock']; ?> </span>
          <?php }?>
          <div class="content">
            <img src="image/shape-19.png" alt="" class="shap">
                <h3 class="name"><?= $fetch_products['name']; ?></h3>
                <div class="flex-btn">
                <p class="price">price $<?=$fetch_products['price']; ?>/-</p>
                <input type="number" name="qty" required min="1" value="<?=$fetch_cart['qty'] ?>" max="99" maxlength="2" class="box qty ">
                 <button type="submit" name="update_cart" class="bx bx-edit fa-edit box"></button>
            </div>
<div class="flex-btn">
<p class="sub-total">sub total: <span>$<?=$sub_total=(float)$fetch_cart['price'] *(float)$fetch_cart['qty'];0  ?></span></p>
<button type="submit" name="delete_item" class="btn" onclick="return confirm('remove from cart');">delete</button>
</div>
          </div>

             </form>
          <?php
         $grand_total +=$sub_total;
                
            } else{ echo'
            <div class="empty">
     <p>no products was found! </p>
 </div>
         ';
            }
                       }
                           }
                           else{ echo'
                            <div class="empty">
                     <p>no products add yet! </p>
                 </div>
                         ';
                            }                     
?>
         </div>
         <?php if($grand_total !=0){ ?>
<div class="cart-total">
    <p>total amount payable : <span>$ <?= $grand_total; ?>/-</span></p>
    <div class="button">
        <form action="" method="post">
            <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart');">empty cart</button>
        </form>
        <a href="checkout.php" class="btn">proceed to checkout</a>
    </div> 
     <?php } ?>
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