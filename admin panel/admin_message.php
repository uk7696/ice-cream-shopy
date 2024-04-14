<?php
include '../components/connect.php';

 if(isset($_COOKIE['seller_id'])){
    $seller_id = $_COOKIE['seller_id'];
 }else{
    $seller_id = '';
    header('location:login.php');
 }
//delete msg from database
if(isset($_POST['delete_msg'])){
    $delete_id=$_POST['delete_id'];
    $delete_id=filter_var($delete_id,FILTER_SANITIZE_STRING);
   
    $verify_delete="SELECT FROM `message`WHERE id='$delete_id'";
    $result=mysqli_query($conn,$verify_delete);
    if(mysqli_num_rows($result)> 0){
        $delete_msg="DELETE FROM `message`WHERE id='$delete_id'";
        $result=mysqli_query($conn,$delete_product);
        $success_msg[]='message delected sucessfully';
   }
   else{
$warning_msg[]= 'message already deleted';
   }
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
    <style>
        .box{
            line-height: 2;
            padding: 2rem;
        }
        .box .name{
            text-transform: capitalize;
            font-size: 1.5rem;
        }
        .box h4{
            text-transform: capitalize;
            color: var(--main-color);

        }
        .box p{
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="main-container">
     <?php 
include '../components/admin_header.php'; 
?>  
 <section class="message-container">
         <div class="heading">
            <h1>unread messages</h1>
            <img src="../image/separator-img.png">
         </div>
        <div class="box-container">
        <?php
                $select_message="SELECT * FROM `message`";
                $result=mysqli_query($conn,$select_message);
                if(mysqli_num_rows($result) > 0){
                    while($fetch_message=mysqli_fetch_assoc($result)){
        
                ?>
                <div class="box">
                 <h3 class="name"><?=$fetch_message['name']; ?></h3>
                 <h4><?=$fetch_message['subject']; ?></h4>
                 <p><?=$fetch_message['message']; ?></p>
                 <form action="" method="post">
                    <input type="hidden" name="delete_id" value="<?=$fetch_message['id']; ?>">
                    <input type="submit" name="delete_msg" value="delete message" class="btn" onclick="return confirm('delete this message');">
                 </form>
                </div>
                <?php
                    }
                }else{
                    echo'
                       <div class="empty">
                <p>no unread message yet! </p>
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