<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -register users page </title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
   .box-container{
      margin-top: 3rem;
   }
   .box{
      text-align: center;
      padding: 2rem;
      text-transform: capitalize;
      line-height: 2;
      color: gray;
      margin-bottom: 4rem;
   }
   .box span{
      text-transform: none;
   }
   .box img{
      width: 120px;
      height: 120px;
      border-radius: 50%;
      box-shadow: var(--box-shadow);
      padding: .5rem;
      background-color: var(--white-alpha-40);
      margin-top: -5rem;
      margin-bottom: 1rem;
   }
</style>
</head>
<body>
    <div class="main-container">
     <?php 
include '../components/admin_header.php'; 
?>  
 <section class="user-container">
         <div class="heading">
            <h1>registered users</h1>
            <img src="../image/separator-img.png">
         </div>
        <div class="box-container">
        <?php
                $select_users="SELECT * FROM `users`";
                $result=mysqli_query($conn,$select_users);
                if(mysqli_num_rows($result) > 0){
                    while($fetch_users=mysqli_fetch_assoc($result)){
                         $user_id= $fetch_users['id'];
                ?>
                <div class="box">
                  <img src="../uploaded_files/<?=$fetch_users['image']; ?>" >
                  <p>user id: <span><?=$user_id; ?></span></p>
                  <p>user name: <span><?=$fetch_users['name']; ?></span></p>
                  <p>user email: <span><?=$fetch_users['email']; ?></span></p>
                </div>
                <?php
                    }
                  }else{
                     echo'
                        <div class="empty">
                 <p>no user registered yet! </p>
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