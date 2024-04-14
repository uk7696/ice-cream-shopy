<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }

  
 if(isset($_POST['update'])){
    $product_id=$_POST['product_id'];
    $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);

    $price=$_POST['price'];
    $price=filter_var($price,FILTER_SANITIZE_STRING);

    $description=$_POST['description'];
    $description=filter_var($description,FILTER_SANITIZE_STRING);

    $stock=$_POST['stock'];
    $stock=filter_var($stock,FILTER_SANITIZE_STRING);
    $status=$_POST['status'];
    $status=filter_var($status,FILTER_SANITIZE_STRING);
    $update_product="UPDATE `products` SET name='$name',price='$price',product_detail='$description',stock='$stock',status='$status' WHERE id='$product_id'";
     $result=mysqli_query($conn,"$update_product");
      $success_msg[]='product updated';
   

    $old_image=$_POST['old_image'];
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder= '../uploaded_files/'.$image;
    $select_image="SELECT * FROM `products` WHERE image='$image' && seller_id='$seller_id'";
    $result=mysqli_query($conn,$select_image);
    if(!empty($image)){
        if($image_size > 2000000){
            $warning_msg[]='image size is too large';
    }
    elseif(mysqli_num_rows($result) > 0 && $image !=''){
  $warning_msg[]= 'please rename your image';
    }
    else{
        $update_image="UPDATE `products` SET image='$image' where id='$product_id'";
        $result=mysqli_query($conn,$update_image);
        move_uploaded_file($image_tmp_name,$image_folder);
      if($old_image != $image &&  $old_image !=''){
        unlink('../uploaded_files/'.$old_image);
    }
    $success_msg[]='image updated';
 }
}
    }
    //delete image
    if(isset($_POST['delete_image'])){
    $empty_image='';
    $product_id=$_POST['product_id'];
    $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);
    $delete_image="SELECT * FROM `products` WHERE id='$product_id'";
    $result=mysqli_query($conn,$delete_image);
    $fetch_delete_image=mysqli_fetch_assoc($result);
    if($fetch_delete_image ['image']!=''){
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $unset_image= "UPDATE `products` SET image='$empty_image' where id='$product_id'";
    $result=mysqli_query($conn,$unset_image);
    $success_msg[]='image deleted successfly';
}
//delete product
if(isset($_POST['delete_product'])){
    $product_id=$_POST['product_id'];
    $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);
    $delete_image="SELECT * FROM `products` WHERE id='$product_id'";
    $result=mysqli_query($conn,$delete_image);
    $fetch_delete_image=mysqli_fetch_assoc($result);
    if($fetch_delete_image ['image']!=''){
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $delete_product="DELETE FROM `products` WHERE id='$product_id'";
    $result=mysqli_query($conn,$delete_product);
    $success_msg[]= "product delected successfully";
    header("location:view_product.php");
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
 <section class="post-editor">
         <div class="heading">
            <h1>edit peroduct</h1>
            <img src="../image/separator-img.png">
         </div>
        <div class="box-container">
          <?php 
        $product_id=$_GET['id'];
$select_product="SELECT * FROM `products` WHERE id='$product_id' && seller_id='$seller_id'";
$result=mysqli_query($conn,$select_product);
if(mysqli_num_rows($result) > 0){
    while($fetch_products=mysqli_fetch_assoc($result)){

?>
<div class="form-container">
<form action="" method="post" enctype="multipart/form-data" class="register">
    <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
    <div class="input-field">
        <p>product status <span>*</span></p>
        <select name="status" class="box">
            <option value="<?=$fetch_products['status'];?>" selected><?=$fetch_products['status']; ?></option>
        <option value="active">active</option>
        <option value="deactive">deactive</option>
        </select>
    </div>
        <div class="input-field">
        <p>product name <span>*</span></p>
        <input type="text" name="name" value="<?= $fetch_products['name']; ?>" class="box">
        </div>
        <div class="input-field">
        <p>product price <span>*</span></p>
        <input type="number" name="price" value="<?= $fetch_products['price']; ?>" class="box">
        </div>
        <div class="input-field">
        <p>product description <span>*</span></p>
        <textarea name="description"  class="box"><?= $fetch_products['product_detail']; ?></textarea>
        </div>
        <div class="input-field">
        <p>product stock <span>*</span></p>
        <input type="number" name="stock" value="<?= $fetch_products['stock']; ?>" class="box" min="0" max="9999999999" maxlength="10">
        </div>
        <div class="input-field">
        <p>product image <span>*</span></p>
        <input type="file" name="image" accept="image/*" class="box">
        <?php if($fetch_products['image'] != ''){?>
          <img src="../uploaded_files/<?= $fetch_products['image']; ?>" class="image">
        <div class="flex-btn">
            <input type="submit" name="delete_image" class="btn" style="width:49%;" value="delete image">
            <a href="view_product.php" class="btn" style="width: 49%; text-align: center; height: 3rem; margin-top: .7rem;"> go back</a>
        </div> 
        <?php } ?>
    </div>
<div class="flex-btn">
  <input type="submit" name="update" value="update product" class="btn">
  <input type="submit" name="delete_product" value="delete product" class="btn">
</div>
    </form>
    </div>
<?php
    }
}else{
    echo'
       <div class="empty">
<p>no products add yet! </p>
</div>
    ';
?>
<br><br>
<div class="flex-btn">
    <a href="view_prodct.php" class="btn">view_product</a>
    
    <a href="add_products.php" class="btn">add_product</a>
</div>
<?php }?>
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