<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }
  $get_id=$_GET['post_id'];
   //delete product
 if(isset($_POST['delete'])){
    $p_id=$_POST['product_id'];
    $p_id=filter_var($p_id,FILTER_SANITIZE_STRING);
   
    $delete_image="SELECT * FROM `products` WHERE id='$p_id' && seller_id='$seller_id'";
    $result=mysqli_query($conn,$delete_image);
    if(mysqli_num_rows($result)> 0){
    $fetch_delete_image=mysqli_fetch_assoc($result);
    }
        if($fetch_delete_image['']!=''){
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
}
$delete_product="DELETE FROM `products`WHERE id='$p_id' && seller_id='$seller_id'";
$result=mysqli_query($conn,$delete_product);
header("location:view_product.php");
 
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
 <section class="read-post">
         <div class="heading">
            <h1>product detail</h1>
            <img src="../image/separator-img.png">
         </div>
       <div class="box-container">
        <?php 
        $select_product=" SELECT * FROM `PRODUCTS` WHERE id='$get_id' && seller_id='$seller_id'";
        $result=mysqli_query($conn,$select_product);
        if(mysqli_num_rows($result) > 0){
            while($fetch_product=mysqli_fetch_assoc($result)){

?>
<form action="" method="post" class="box">
    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
        <div class="status" style="color: <?php if($fetch_product['status']=='active'){
          echo"limegreen";}else{echo"coral";} ?>"><?= $fetch_product['status']; ?></div>
           <?php if($fetch_product['image'] != ''){ ?>
        <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image">
        <?php } ?>
          <div class="price">$<?= $fetch_product['price']; ?>/-</div>
           <div class="title"><?= $fetch_product['name']; ?></div>
            <div class="content"><?= $fetch_product['product_detail']; ?></div>
            <div class="flex-btn">
                <a href="edit_product.php?id=<?= $fetch_product['id']; ?>" class="btn">edit</a>
                <button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
                <a href="view_product.php?post_id=<?= $fetch_product['id']; ?>" class="btn">go back</a>
            </div>
          </div>
</form>
        <?php
            }
        }else{
            echo'
               <div class="empty">
        <p>no products add yet! <br> <a href="add_products.php" class="btn" style="margin-top: 1.5rem;"></a></p>
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