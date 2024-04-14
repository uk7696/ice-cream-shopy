<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -about us page</title>
    <link rel="stylesheet" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
         .container{
    padding: 4%;
    padding-bottom:0 ;
 }
 .container .box-container .img-box{
    margin: 1rem;
 } 
 .container .box-container .img-box img{
    background-image: url('image/shap.png');
    background-size: contain;
    width: 80%;
    margin-bottom: -1.1rem;
 }
 .container .box-container .box{
    text-align: center;
    line-height: 2;
    box-shadow: none;

 }
 .container .box-container p{
    color: #666;
    font-size: 16px;
    margin-bottom: 2rem;
 }
 .team{
    background-image: url('image/bn3.3.webp');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 80px 6%;
 }
 .team .box-container .box{
    overflow: hidden;
    border: 1px solid black;
    width: 30vw;
   
 }
 .team .box-container .box .img{
    width: 100%;
    transition: .5s;
 }
 .team .box-container .box:hover .img{
    transform: scale(1.1);
 }
 .team .box-container .box .content{
    position: relative;
    display: block;
    background-color: #fff;
    padding: 33px 20px 32px 20px;
    margin-top: -80px;
    border-top-right-radius: 80px;
    text-align: center;
    line-height: 1.5;
    text-transform: capitalize;
 }
 .team .box-container .box .content .shap{
    position: absolute;
    left: 0;
    top: -80px;
    width: 80px;
    height: 80px;
    background-repeat: no-repeat;
 }
 .standers{
    background-image: url('image/std.jpg');
    padding: 135px 0 210px;
    background-repeat:no-repeat;
    background-position: center;
    background-size: cover;
    display: flex;
    align-items: flex-start;
    text-align: center;
    line-height: 1.5;
    padding-left: 6%;
}
.standers p{
    font-size: 1.6rem;
    color: #666;
    padding-bottom: .5rem;

}
.standers i{
    font-size: 2rem;
    color: var(--main-color);
}
    </style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="banner">
    <div class="detail">
        <h1>about us</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
    </div>
</div>
<div class="chef">
    <div class="box-container">
        <div class="box">
            <div class="heading">
                <span>alex</span>
                <h1>masterchef</h1>
                <img src="image/separator-img.png">
            </div>
            <p>bala is a roman-born pastry chef who spent 15 years in his city rome perfecting his craft and exceptional creations
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ipsam eius repellendus corporis esse! Ipsa cumque dolores, eaque maiores unde nesciunt? Unde dignissimos quis saepe, ipsum eum totam quaerat odio!
            </p>
            <div class="flex-btn">
                <a href="" class="btn">explore our menu</a>
                <a href="menu.php" class="btn">visit our shop</a>
</div>
        </div>
        <div class="box">
            <img src="image/ceaf.png" class="img">
        </div>
    </div>
</div>
<div class="story">
    <div class="heading">
        <h1>our story</h1>
        <img src="image/separator-img.png">
    </div>
    <p>Lorem, ipsum dolor sit amet consectetur<br> adipisicing elit. Minus modi velit veniam earum<br> eveniet assumenda, culpa ipsa dignissimos facilis doloribus ducimus<br> deserunt molestiae dicta saepe nesciunt incidunt ad quae eligendi!</p>
    <a href="menu.php" class="btn">our services</a>
</div>
<div class="container">
    <div class="box-container">
        <div class="img-box">
            <img src="image/about.png">
        </div>
        <div class="box">
            <div class="heading">
                <h1>taking ice cream to new heights</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, unde quibusdam harum vel laborum distinctio? Aperiam alias et incidunt ullam in! Alias cumque nobis voluptatum autem tempore distinctio vero dolorum?</p>
                <a href="" class="btn">learn more</a>
            </div>
        </div>
    </div>
</div>
    <div class="team">
        <div class="heading">
            <span>our team</span>
            <h1>quality & passion with our services</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team-1.jpg" class="img">
                 <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>ralph johnson</h2>
                    <p>coffee chef</p>
                 </div>
            </div>
            <div class="box">
                <img src="image/team-2.jpg" class="img">
                 <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>fioana johnson</h2>
                    <p>pastry chef</p>
                 </div>
            </div>
            <div class="box">
                <img src="image/team-3.jpg" class="img">
                 <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h2>tom johnson</h2>
                    <p>coffee shop</p>
                 </div>
            </div>
        </div>
    </div>
    <div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>our standerts</h1>
                <img src="image/separator-img.png">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing. Lorem ipsum dolor sit </p>
        <i class="bx bxs-heart"></i>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing. Lorem ipsum dolor sit  </p>
        <i class="bx bxs-heart"></i>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing. Lorem ipsum dolor sit </p>
        <i class="bx bxs-heart"></i>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing. Lorem ipsum dolor sit  </p>
        <i class="bx bxs-heart"></i>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing. Lorem ipsum dolor sit  </p>
        <i class="bx bxs-heart"></i>
        </div>
    </div>
    
<?php 
include 'components/footer.php'; 
?>
<script src="js/user_script.js"></script>
</body>
</html>