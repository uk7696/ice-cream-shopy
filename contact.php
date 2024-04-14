<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
 if(isset($_POST['send_message'])){
   if($user_id !='') {
    $id=unique_id() ;
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);

    $email=$_POST['email']; 
    $email=filter_var($email,FILTER_SANITIZE_STRING);

    $subject=$_POST['subject'];
    $subject=filter_var($subject,FILTER_SANITIZE_STRING);

    $message=$_POST['message'];
    $message=filter_var($message,FILTER_SANITIZE_STRING);

    $verify_message=" SELECT * FROM `message` WHERE user_id='$user_id' AND name='$name' AND email ='$email' AND subject='$subject' AND message='$message'";
    $result=mysqli_query($conn,$verify_message);
    if(mysqli_num_rows($result) > 0){
        $warning_msg[]='message already exist!';
}else{
    $insert_message="INSERT INTO `message` ( id, user_id, name, email, subject, message) VALUES ('$id','$user_id','$name','$email','$subject','$message')";
    $result=mysqli_query($conn,$insert_message);
    $success_msg[]='comment inserted successfully'; 
}
   }
    else{
       $warning_msg[]='please login first';
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -contact us page</title>
    <link rel="stylesheet" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
    .form-container{
        background-image:url("image/banner.jpg");
    }
    .form-container label{
        font-size: 1.5rem;
        text-transform: capitalize;
        margin: .5rem 0;
    }
    .services{
        background-image:url('image/bn3.3.webp');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        padding: 100px 6%;
        position: relative;
        min-height: 100vh;
    }
    .services .box-container .box{
        line-height: 1.5;
        text-align: center;
        padding: 2rem 0;
    }
    .services .box-container .box div{
        margin-left: 2rem;
    }
    .services .box-container .box h1{
        font-size: 25px;
        color: var(--main-color);
        margin: .5rem 0 ;
        text-transform: capitalize;
    }
    .address{
        padding: 5% 8%;
        min-height: 50vh;
    }
    .address .box{
        display: flex;
        justify-content: center;
        align-items: center;
        line-height: 2;
        padding: 2rem 0;
        background-color: var(--pink-opacity);
    }
    .address .box h4{
        text-transform: capitalize;
        color: var(--main-color);
        font-size: 1.5rem;
    }
    .address .box i{
        font-size: 2.5rem;
        margin-right: 1rem;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--main-color);
        background-color: var(--white-alpha-40);
        box-shadow: var(--box-shadow);
    }
     
</style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="banner">
    <div class="detail">
        <h1>contact us</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>contact us</span>
    </div>
</div>
<div class="services">
         <div class="heading">
            <h1>our services</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing. Lorem ipsum dolor sit amet.</p>
            <img src="image/separator-img.png">
         </div>
         <div class="box-container">
            <div class="box">
                <img src="image/0.png">
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/1.png">
                <div>
                    <h1>money back & guarantee</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/2.png">
                <div>
                    <h1>online support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum.</p>
                </div>
            </div>
         </div>
</div>
         <div class="form-container">
         <div class="heading">
            <h1>drop us a line</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing. Lorem ipsum dolor sit amet.</p>
            <img src="image/separator-img.png">
         </div>
    <form action="" method="post"  class="register">
                <div class="input-field">
                    <label> name <span>*</span></label>
                    <input type="text" name="name" required placeholder="enter your name" class="box">
                </div>
                <div class="input-field">
                    <label> email <span>*</span></label>
                    <input type="text" name="email" required  placeholder="enter your email" class="box">
                </div>
                <div class="input-field">
                    <label>subject<span>*</span></label>
                    <input type="text" name="subject" required  placeholder="reason..." class="box" >
                </div>
                <div class="input-field">
                    <label>comment <span>*</span></label>
                    <textarea name="message" cols="30" rows="10" required  placeholder="" class="box"></textarea>
                </div>
                <button type="submit" name="send_message" class="btn">send message</button>
    </form>
         </div>
<div class="address">
<div class="heading">
            <h1>our contact details</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing. Lorem ipsum dolor sit amet.</p>
            <img src="image/separator-img.png">
         </div>
         <div class="box-container">
            <div class="box">
                <i class="bx bxs-map-alt"></i>
                <div>
                    <h4>address</h4>
                    <p>1098 gandhi street <br>trichy,tamilnadu.624710</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-phone-incoming"></i>
                <div>
                    <h4>phone number</h4>
                    <p>747748948</p>
                    <p>884934889</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-envelope"></i>
                <div>
                    <h4>email</h4>
                    <p>bala23@gmail.com</p>
                    <p>navi34@gmail.com</p>
                </div>
            </div>
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