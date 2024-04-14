<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }
 //delete product
 if(isset($_POST['delete'])){
 $p_id=$_POST['product_id'];
 $p_id=filter_var($p_id,FILTER_SANITIZE_STRING);

 $delete_product="DELETE FROM `products`WHERE id='$p_id'";
 $result=mysqli_query($conn,$delete_product);
 $success_msg[]='product delected sucessfully';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -admin show products page </title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <div class="main-container">
     <?php 
include '../components/admin_header.php'; 
?>  
 <section class="show-post">
         <div class="heading">
            <h1>your products</h1>
            <img src="../image/separator-img.png">
         </div>
       <div class="box-container">
        <?php 
        $seller_products=" SELECT * FROM `products` WHERE seller_id='$seller_id'";
        $result=mysqli_query($conn,$seller_products);
        if(mysqli_num_rows($result) > 0){
            while($fetch_products=mysqli_fetch_assoc($result)){

?>
<form action="" method="post" class="box">
    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
    <?php if($fetch_products['image'] != ''){ ?>
        <img src="../uploaded_files/<?= $fetch_products['image']; ?>" class="img">
        <?php } ?>
        <div class="status" style="color: <?php if($fetch_products['status']=='active'){
          echo"limegreen";}else{echo"coral";} ?>"><?= $fetch_products['status']; ?></div>
          <div class="price">$<?= $fetch_products['price']; ?>/-</div>
          <div class="content">
            <img src="../image/shape-19.png" class="shap">
            <div class="title"><?= $fetch_products['name']; ?></div>
            <div class="flex-btn">
                <a href="edit_product.php?id=<?= $fetch_products['id']; ?>" class="btn">edit</a>
                <button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
                <a href="read_product.php?post_id=<?= $fetch_products['id']; ?>" class="btn">read</a>
            </div>
          </div>
</form>
        <?php
            }
        }else{
            echo'
               <div class="empty">
        <p>no products add yet! <br> <a href="add_products.php" class="btn" style="margin-top: 1.5rem;">add products</a></p>
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