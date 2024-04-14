<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }
 if(isset($_POST['submit'])){
    $select_seller="SELECT * FROM `sellers` WHERE id='$seller_id' LIMIT 1";
    $result=mysqli_query($conn,$select_seller);
    $fetch_seller=mysqli_fetch_assoc($result);

    $prev_pass= $fetch_seller["password"];
    $prev_image= $fetch_seller["image"];

    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);

    $email=$_POST['email']; 
    $email=filter_var($email,FILTER_SANITIZE_STRING);
    //update name
if(!empty($name)){
    $update_name="UPDATE `sellers` SET name='$name' WHERE id='$seller_id'";
    $result=mysqli_query($conn,$update_name);
    $success_msg[]='username updated succesfully';
}
//update email
if(!empty($email)){
    $select_email="SELECT *FROM `sellers` WHERE id='$seller_id' && email='$email'";
    $result=mysqli_query($conn,$select_email);
    if(mysqli_num_rows($result) > 0){
     $warning_msg[]='email already exist';
    }
    else{
        $update_email="UPDATE `sellers` SET email='$email' WHERE id='$seller_id'";
        $result=mysqli_query($conn,$update_email);
        $success_msg[]='email updated succesfully';
    }
   
}
//update image
$image=$_FILES['image']['name'];
$image=filter_var( $image,FILTER_SANITIZE_STRING);
$ext=pathinfo($image,PATHINFO_EXTENSION);
$rename=unique_id().'.'.$ext;
$image_size=$_FILES['image']['size'];
$image_tmp_name=$_FILES['image']['tmp_name'];
$image_folder= '../uploaded_files/'.$rename;
if(!empty($image)){
    if($image_size > 2000000){
        $warning_msg[]='image size is too large';
}
else{
    $update_image="UPDATE `sellers` SET `image`='$rename' where id='$seller_id'";
    $result=mysqli_query($conn,$update_image);
    move_uploaded_file($image_tmp_name,$image_folder);
  if($perv_image !='' &&  $perv_image !=$rename){
    unlink('../uploaded_files/'.$perv_image);
}
$success_msg[]='image updated successfully';
}
}
//update password
$empty_pass='da39a3ee5e6b40d3255bfef95601890afd80709';
$old_pass=$_POST['old_pass'];
$old_pass=filter_var($old_pass,FILTER_SANITIZE_STRING);
$new_pass=$_POST['new_pass'];
$new_pass=filter_var($new_pass,FILTER_SANITIZE_STRING);
$cpass=$_POST['cpass'];
$cpass=filter_var($cpass,FILTER_SANITIZE_STRING);
if($old_pass != $empty_pass){
    if($old_pass != $prev_pass){
        $warning_msg[]='old password not matched';
}
elseif($new_pass != $cpass){
$warning_msg[]= 'password not matched';
}
else{
    if($new_pass != $empty_pass){
    $update_pass="UPDATE `sellers` SET password='$cpass' where id='$seller_id'";
    $result=mysqli_query($conn,$update_pass);
    $success_msg[]='password updated successfully';
    }
    else{
        $warning_msg[]='please enter a new password';
    }
}
}
 }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -update profile page </title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
    .img-box{
margin-bottom: 2rem;
text-align: center;
}
 .img-box img{
width: 10rem;
height: 10rem;
border-radius: 50%;
object-fit: cover;
margin-bottom: .5rem;
padding: .5rem;
background-color: var(--main-color);
}
.form-container{
    flex-direction: column;
}
.form-container .register .img-box img{
    width: 180px;
    height: 180px;
    border-radius: 50%;
    text-align: center;
    padding: 10px;
    background-color: var(--main-color);
}
</style>
</head>
<body>
    <div class="main-container">
     <?php 
include '../components/admin_header.php'; 
?>  
 
 <section class="form-container">
       <div class="heading">
            <h1>update profile details</h1>
            <img src="../image/separator-img.png">
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="img-box">
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
            </div>
        
            <div class="flex">
                <div class="col">
                <div class="input-field">
                <p>your name <span>*</span></p>
        <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box">
               </div>
               <div class="input-field">
                <p>your email <span>*</span></p>
        <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box">
               </div>
               <div class="input-field">
                <p>select pic <span>*</span></p>
        <input type="file" name="image" accept="image/*" class="box">
               </div>
             </div>
             <div class="col">
                <div class="input-field">
                <p>old password <span>*</span></p>
        <input type="password" name="old_pass" placeholder="enter your old password" class="box">
               </div>
               <div class="input-field">
                <p>new password <span>*</span></p>
        <input type="password" name="new_pass" placeholder="enter your new password" class="box">
               </div>
               <div class="input-field">
                <p>confirm password <span>*</span></p>
        <input type="password" name="cpass" placeholder="confirm your pasword " class="box">
       
               </div>
             </div>
            </div>
            <input type="submit" name="submit" value="update profile" class="btn">
        </form>
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