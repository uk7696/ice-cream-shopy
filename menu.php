<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
  
 include 'components/add_wishlist.php';
 include 'components/add_cart.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -our shop page</title>
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
}
</style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="banner">
    <div class="detail">
        <h1>our shop</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>our shop</span>
    </div>
</div>
<div class="products">
         <div class="heading">
            <h1>our latest flavours</h1>
            <img src="image/separator-img.png">
         </div>
       <div class="box-container">
        <?php 
        $select_products=" SELECT * FROM `products` WHERE status='active'";
        $result=mysqli_query($conn,$select_products);
        if(mysqli_num_rows($result) > 0){
            while($fetch_products=mysqli_fetch_assoc($result)){
        ?>
        <form action="" method="post" class="box" <?php if($fetch_products['stock']== 0){
            echo"disabled";
        } ?>>
         <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
         <?php if($fetch_products['stock'] > 9){ ?>
        <span class="stock" style="color:green;">in stock</span>
        <?php } elseif($fetch_products['stock'] == 0){ ?>
        <span class="stock" style="color:red;">out of stock</span>
        <?php } else{ ?>
        <span class="stock" style="color:red;">hurry,only <?= $fetch_products['stock']; ?> </span>
          <?php }?>
          <div class="content">
            <img src="image/shape-19.png" alt="" class="shap">
            <div class="button">
                <div>
                <h3 class="name"><?= $fetch_products['name']; ?></h3></div>
                <div>
                    <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                    <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                    <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show"></a>
            </div>
            </div>
            <p class="price">price $<?= $fetch_products['price']; ?></p>
            <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
            <div class="flex-btn">
                <a href="checkout.php?get_id=<?= $fetch_products['id'] ?>" class="btn">buy now</a>
            <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty box">
            </div>
          </div>
        </form>
          <?php
            } 
        }else{
            echo'
               <div class="empty">
        <p>no products add yet! </p>
    </div>
            ';
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