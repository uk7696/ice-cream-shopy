<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }
 if(isset($_POST['publish'])){
    $id=unique_id();
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);

    $price=$_POST['price'];
    $price=filter_var($price,FILTER_SANITIZE_STRING);

    $description=$_POST['description'];
    $description=filter_var($description,FILTER_SANITIZE_STRING);

    $stock=$_POST['stock'];
    $stock=filter_var($stock,FILTER_SANITIZE_STRING);
    $status='active';
     
    $image=$_FILES['image']['name'];
    $image=filter_var($image,FILTER_SANITIZE_STRING);

    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder= '../uploaded_files/'.$image;
    $select_image="SELECT * FROM products WHERE image='$image' && seller_id='$seller_id'";
    $result=mysqli_query($conn,$select_image);
    if(isset($image)){
    if(mysqli_num_rows($result) > 0){
        $fetch_profile=mysqli_fetch_assoc($result);
        $warning_msg[]='image name repeated';
    }elseif($image_size > 2000000){
        $warning_msg[]= 'image size is too large';
 }
 else{
    move_uploaded_file($image_tmp_name,$image_folder);
 }}
 else{
    $image='';
 }
 if(mysqli_num_rows($result) > 0 && $image !=''){
    $warning_msg[]= 'please rename your image';
 }
 else{
    $insert_product="INSERT INTO products ( id , seller_id,name,price,image,stock,product_detail,status) VALUES ('$id','$seller_id','$name','$price','$image','$stock','$description','$status')";
    $result=mysqli_query($conn,$insert_product);
    $success_msg[]= "product inserted sucessfully";
 }
}
  
 if(isset($_POST['draft'])){
    $id=unique_id();
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);

    $price=$_POST['price'];
    $price=filter_var($price,FILTER_SANITIZE_STRING);

    $description=$_POST['description'];
    $description=filter_var($description,FILTER_SANITIZE_STRING);

    $stock=$_POST['stock'];
    $stock=filter_var($stock,FILTER_SANITIZE_STRING);
    $status='deactive';
     
    $image=$_FILES['image']['name'];
    $image=filter_var($image,FILTER_SANITIZE_STRING);

    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder= '../uploaded_files/'.$image;
    $select_image="SELECT * FROM `products` WHERE image='$image' && seller_id='$seller_id'";
    $result=mysqli_query($conn,$select_image);
    if(isset($image)){
    if(mysqli_num_rows($result) > 0){
        $fetch_profile=mysqli_fetch_assoc($result);
        $warning_msg[]='image name repeated';
    }elseif($image_size > 2000000){
        $warning_msg[]= 'image size is too large';
 }
 else{
    move_uploaded_file($image_tmp_name,$image_folder);
 }}
 else{
    $image='';
 }
 if(mysqli_num_rows($result) > 0 && $image !=''){
    $warning_msg[]= 'please rename your image';
 }
 else{
    $insert_product="INSERT INTO `products` ( id , seller_id,name,price,image,stock,product_detail,status) VALUES ('$id','$seller_id','$name','$price','$image','$stock','$description','$status')";
    $result=mysqli_query($conn,$insert_product);
    $success_msg[]= "product saved as draft sucessfully";
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -admin add products page </title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <div class="main-container">
     <?php 
include '../components/admin_header.php'; 
?>  
 <section class="post-editer">
    <div class="heading">
        <h1>add product</h1>
        <img src="../image/separator-img.png">
    </div>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
<div class="input-field">
    <p>product name <span>*</span></p>
    <input type="text" name="name" maxlength="100" placeholder="add product name" required class="box">
</div>
<div class="input-field">
    <p>product price <span>*</span></p>
    <input type="number" name="price" maxlength="100" placeholder="add product price" required class="box">
</div>
<div class="input-field">
    <p>product detail <span>*</span></p>
   <textarea name="description" required maxlength=1000 placeholder="add product detail" class="box"></textarea>
</div>
<div class="input-field">
    <p>product stock <span>*</span></p>
    <input type="number" name="stock" maxlength="10" min="0" max="9999999999" placeholder="add product stock" required class="box">
</div>
<div class="input-field">
    <p>product image <span>*</span></p>
    <input type="file" name="image" accept="image/*"  required class="box">
</div>
<div class="flex-btn">
    <input type="submit" name="publish" value="add product" class="btn">
    <input type="submit" name="draft" value="save as draft" class="btn">
</div>
        </form>
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