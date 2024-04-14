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
    <title>gulu gulu -home page</title>
    <link rel="stylesheet" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>

.service{
    padding: 6%;
}
.service.box-container{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(20rem,1fr));
    align-items:center;
}
.categories .box-container .box{
    background-color:var(--white-alpha-25);
    border: 2px solid var(--white-alpha-40);
    backdrop-filter: var(--backdrop-filter);
    box-shadow: var(--box-shadow);
    padding: .1rem;
    margin: .4rem;
    border-radius: .5rem;
    position: relative;
    overflow: hidden;
}
.box{
    border: 2px solid var(--white-alpha-40);
    backdrop-filter: var(--backdrop-filter);
    box-shadow: var(--box-shadow);
    background-color: var(--pink-opacity);
    margin: 1rem;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    padding: 2rem;
    text-transform: capitalize;
    text-align: center;
    line-height: 1.5;
}
.box .detail{
    border-left: 1px solid #000;
    padding-left: 2rem;
}
.box h4{

    font-size: 1.5rem;
}
.box .icon{
    cursor: pointer;
    overflow: hidden;
    width: 130px;
}
.box .icon-box{
    display:flex;
    width: 200%;
    transition: .2s ease-in-out;
}
.box .icon-box .img1,
.box .icon-box .img2{
    flex: 1 0 50%;
    width: 40px;
    height: 60px;
    object-fit: contain;
}
.box:hover .icon-box{
    transform: translateX(-50%);
}
.menu-banner{
    width: 100%;
}
.taste{
   background-image: url('image/bn3.3.webp');
   padding: 3% 0;
   background-repeat: no-repeat;
   background-size: cover;
   background-attachment: fixed;
} 

.taste .box-container .box{
   position: relative;
   width: 20rem;
   display: flex;
    align-items: center;
    justify-content: space-evenly;
    padding: .1rem;
   border: 2px solid var(--white-alpha-40);
    backdrop-filter: var(--backdrop-filter);
    box-shadow: var(--box-shadow);
    background-color: var(--pink-opacity);
    margin:2rem;
    border-radius: .5rem;
    overflow: hidden;
}
.taste .box-container .box .detail{
   width: 100%;
   text-align: center;
   position: absolute;
   top: 10%;
   line-height: 1.5;
}
.taste .box-container .box img{
   width: 100%;
   outline: .1rem solid #fff;
   outline-offset: -.5rem;
   transition: .5s;
}
.taste .box-container .box:hover img{
   outline: 2px solid var(--main-color);
   outline-offset: -.2rem;
}
.ice-container{
   position: relative;
   background-image:url('image/ice-bg.webp');
   background-size: cover;
   background-position: center;
   background-attachment: fixed;
   min-height: 100vh;
}
.ice-container .overlay{
   position: absolute;
   left: 0;
   right: 0;
   top: 0;
   bottom: 0;
   background-color: #000;
   opacity: .5;
}
.ice-container .detail{
   width: 100%;
   position: absolute;
   top: 30%;
   text-align: center;
   color: #fff;
}
.ice-container .detail h1{
   font-size: 3rem;
}
.ice-container .detail p{
   font-size: 1.5rem;
   line-height: 1.5;
   padding-bottom: 2em;
}
.taste2{
   max-width: 1200px;
   margin: 3rem auto;
}
.taste2 .t-banner{
   background-image: url('image/bg.png');
   min-height: 40vh;
   border-radius: 20px;
   position: relative;
   box-shadow: var(--box-shadow);
   margin: 1rem;
}
.taste2 .t-banner .overlay{
   position:absolute;
   width: 100%;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background-color: #ffffff99;
}
.taste2 .t-banner .detail{
width: 100%;
text-align: center;
position: absolute;
top: 30%;
line-height: 1.5;
}
.taste2 .t-banner .detail p{
   color: #666;
   margin-bottom: 2rem;
   font-size: 20px;
}
.taste2 .t-banner .detail h1{
   text-transform: capitalize;
}
.taste2 .box-container .box{
   position: relative;
   padding: .1rem;
   border: 2px solid var(--white-alpha-40);
    backdrop-filter: var(--backdrop-filter);
    box-shadow: var(--box-shadow);
    background-color: var(--pink-opacity);
    margin:2rem;
    border-radius: .5rem;
    overflow: hidden;
}
.taste2 .box-container .box img{
   width: 100%;
}
.taste2 .box-container .box .box-overlay{
   position: absolute;
   background-color: var(--pink-opacity);
   height: 99%;
   width: 100%;
   left: 0;
   top: 0;
   bottom: 0;
   right: 0;
   opacity: 0;
   -webkit-transition:all 0.4s ease-in-out 0s;
   -moz-transition:all 0.4s ease-in-out 0s;
   transition:all 0.4s ease-in-out 0s;
}
.taste2 .box-container .box:hover .box-overlay{
   opacity: .7;
}
.taste2 .box-container .box .box-details{
   position: absolute;
   text-align: center;
   padding-left: 1rem;
   padding-right: 1rem;
   width: 100%;
   top: 50%;
   left: 50%;
   opacity: 0;
   -webkit-transition:all 0.4s ease-in-out 0s;
   -moz-transition:all 0.4s ease-in-out 0s;
   transition:all 0.4s ease-in-out 0s;
   -webkit-transform: translate(-50% ,-50%);
   -moz-transform: translate(-50% ,-50%);
   transform: translate(-50% ,-50%);
   transition:all 0.3s ease-in-out 0s;
}
.taste2 .box-container .box:hover .box-details{
   opacity: 1;
   top: 50%;
   left: 50%;
}
.taste2 .box-container .box .box-details h1{
   color: var(--main-color);
   font-size: 500;
   letter-spacing: 0.15em;
   font-size: 1.5rem;
   text-transform: uppercase;
   margin-bottom: .5rem;
}
.taste2 .box-container .box .box-details p{
   color: #666;
   font-size: 1.1rem;
   margin-bottom: 1.5rem;
}
.fadeIn-bottom{
   top: 80%;
}
.pride .detail p{
    color: #666;
    font-size: 20px;
    margin-top: 1rem;
    margin-bottom: 2rem;
}
.pride .detail{
    padding-left: 40%;
}
.newsletter{
    background-image: url('image/bn3.3.webp');
    padding-top: 70px;
 padding-bottom: 100px;
background-attachment: fixed;
background-repeat: no-repeat;
display: flex;
justify-content: center;
align-items: center;
line-height: 1.5;
min-height: 100vh;
text-align: center;
}
.newsletter span{
    font-size: 1rem;
    background-color: var(--pink-opacity);
    color: var(--main-color);
    text-transform: uppercase;
    border-radius: 15px;
    padding: .5rem 1rem;
}
.newsletter h1{
    font-size: 2.5rem;
    margin: .5rem;
    text-transform: capitalize;
}
.newsletter.input-field{
   margin: 1.5rem 0;
}
.newsletter input{
    padding: 1rem;
    border-radius: 10px;
    width: 30vw;
    background-color: var(--pink-opacity);
}
.newsletter .box-container{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: .5rem;
}
.newsletter .box-container .box1{
    background-color: var(--pink-opacity);
    box-shadow: var(--box-shadow);
    margin: 1rem;
    padding: 2rem 4rem;
    border-radius: 10px;
}
.newsletter .box-container .box-counter{
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}
.newsletter .box-container .box-counter .counter,
.newsletter .box-container .box-counter i{
    color: #000;
    font-size: 3rem;
}
.newsletter .box-container h3{
   padding: .5rem;
    font-size: 1.5rem;
    color: var(--main-color);
}
.newsletter p{
    font-size: 1.1rem;
    color: gray;
}
footer{
    background-image: url("image/footer-bg.jpg");
    background-size: cover;
    background-repeat: no-repeat;
background-position: center;
padding: 259px 0 0;
width: 100%;
}
footer .content{
   display: grid;
   grid-template-columns: repeat(auto-fit,minmax(15rem,1fr));
   align-items: center;
   justify-content: center;
}
footer .content .box1{
   margin: 1rem;
   line-height: 1.7;
}
footer .content .box1 .btn{
   text-align: center;
   padding: .5rem;
}
footer .content .box1 .btn:hover{
   color: #fff;
}
footer .content .box1 h3{
   text-transform: capitalize;
   margin-bottom: .5rem;
}
footer .content .box1 a{
   font-size: 16px;
   display: block;
   color: #000;
   text-transform: capitalize;
}
footer .content .box1 a:hover{
   color: var(--main-color);
}
footer .content .box1 i{
   margin-right: .5rem;
}
footer .content .box1 p{
   line-height: 1.5;
}
footer .content .box1 .icons{
   margin-top: 1rem;
}
footer .content .box1 .icons i{
   width: 40px;
   height: 40px;
   line-height: 40px;
   text-align: center;
   border-radius: 50%;
   background-color: var(--pink-opacity);
   border: 1px solid var(--main-color);
   color: var(--main-color);
   cursor: pointer;
}
footer .bottom{
margin-top: 2rem;
display: flex;
flex-wrap: wrap;
justify-content: space-between;
padding: 2rem;
border-top: 1px solid #000;
line-height: 2;
}
footer .bottom a{
   text-transform: capitalize;
   color: #000;
}
    </style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="slider-container">
   <div class="slider">
      <div class="slideBox active">
         <div class="textBox">
            <h1> we bride ourselfs on <br>exceptional flavors</h1>
            <a href="menu.php" class="btn">shop now</a>
         </div>
         <div class="imgBox">
            <img src="image/slider.jpg">
         </div>
      </div>
      <div class="slideBox">
            <div class="textBox">
         <h1>cold treats are my kind <br>of comfort food</h1>
            <a href="menu.php" class="btn">shop now</a>
         </div>
         <div class="imgBox">
            <img src="image/slider0.jpg">
         </div>
      </div>
   </div>
   <ul class="controls">
      <li onclick="nextSlide();" class="next"><i class="bx bx-right-arrow-alt"></i></li>
      <li onclick="prevSlide();" class="perv"><i class="bx bx-left-arrow-alt"></i></li>
   </ul>
</div>
<div class="service">
   <div class="box-container">
      <div class="box">
         <div class="icon">
            <div class="icon-box">
               <img src="image/services.png" class="img1">
               <img src="image/services (1).png" class="img2">
               
            </div>
         </div>
         <div class="detail">
            <h4>delivery</h4>
            <span>100% secure</span>
         </div>
      </div>
      <div class="box">
         <div class="icon">
            <div class="icon-box">
               <img src="image/services (2).png" class="img1">
               <img src="image/services (3).png" class="img2">
            </div>
         </div>
         <div class="detail">
            <h4>payment</h4>
            <span>100% secure</span>
         </div>
      </div>
      <div class="box">
         <div class="icon">
            <div class="icon-box">
               <img src="image/services (5).png" class="img1">
               <img src="image/services (6).png" class="img2">
            </div>
         </div>
         <div class="detail">
            <h4>support</h4>
            <span>24*7 hours</span>
         </div>
      </div>
      <div class="box">
         <div class="icon">
            <div class="icon-box">
               <img src="image/services (7).png" class="img1">
               <img src="image/services (8).png" class="img2">
            </div>
         </div>
         <div class="detail">
            <h4>gift service</h4>
            <span>support gift service</span>
         </div>
      </div>
      <div class="box">
         <div class="icon">
            <div class="icon-box">
               <img src="image/service.png" class="img1">
               <img src="image/service (1).png" class="img2">
            </div>
         </div>
         <div class="detail">
            <h4>returns</h4>
            <span>24*7 free return</span>
         </div>
      </div>
      <div class="box">
         <div class="icon">
            <div class="icon-box">
               <img src="image/services.png" class="img1">
               <img src="image/services (1).png" class="img2">
            </div>
         </div>
         <div class="detail">
            <h4>deliver</h4>
            <span>100% secure</span>
         </div>
      </div>
   </div>
</div> 
<div class="categories">
   <div class="heading">
      <h1>categories features</h1>
      <img src="image/separator-img.png">
   </div>
   <div class="box-container">
      <div class="box">
         <img src="image/categories.jpg">
         <a href="menu.php" class="btn">cocounts</a>
      </div>
      <div class="box">
         <img src="image/categories0.jpg">
         <a href="menu.php" class="btn">chocolate</a>
      </div>
      <div class="box">
         <img src="image/categories2.jpg">
         <a href="menu.php" class="btn">strawberry</a>
      </div>
      <div class="box">
         <img src="image/categories1.jpg">
         <a href="menu.php" class="btn">corn</a>
      </div>
   </div>
</div>
<img src="image/menu-banner.jpg" class="menu-banner">
<div class="taste">
<div class="heading">
   <span>Taste</span>
      <h1>buy any ice cream @ get one free</h1>
      <img src="image/separator-img.png">
   </div>
   <div class="box-container">
      <div class="box">
      <img src="image/taste.webp">
      <div class="detail">
         <h2>natural sweetness</h2>
         <h1>venila</h1>
      </div>
   </div>
   <div class="box">
      <img src="image/taste0.webp">
      <div class="detail">
         <h2>natural sweetness</h2>
         <h1>matcha</h1>
      </div>
   </div>
   <div class="box">
      <img src="image/taste1.webp">
      <div class="detail">
         <h2>natural sweetness</h2>
         <h1>blueberry</h1>
      </div>
   </div>
   </div>
</div>
<div class="ice-container">
   <div class="overlay"></div>
      <div class="detail">
         <h1>ice cream is cheaper than <br> therapy for stress</h1>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br> Est aliquam amet odio esse impedit maxime autem tempora minima<br> consequatur laboriosam eaque minus atque perferendis ad,<br> eum illum veritatis, vel voluptas!</p>
      <a href="menu.php" class="btn">shop now</a>
      </div>
   </div>


<div class="taste2">
   <div class="t-banner">
      <div class="overlay"></div>
      <div class="detail">
      <h1>find your taste of desserts</h1>
<p>treat them to a delicious treat and send them some luck 'o the irish too!</p>
<a href="menu.php" class="btn">shop now</a>
      </div>
   </div>
      <div class="box-container">
         <div class="box">
            <div class="box-overlay"></div>
            <img src="image/type4.jpg">
            <div class="box-details fadeIn-bottom">
               <h1>strawberry</h1>
               <p>find your taste of desserts</p>
               <a href="menu.php" class="btn">explore more</a>
            </div>
         </div>
         <div class="box">
            <div class="box-overlay"></div>
            <img src="image/type.avif">
            <div class="box-details fadeIn-bottom">
               <h1>strawberry</h1>
               <p>find your taste of desserts</p>
               <a href="menu.php" class="btn">explore more</a>
            </div>
         </div>
         <div class="box">
            <div class="box-overlay"></div>
            <img src="image/type1.png">
            <div class="box-details fadeIn-bottom">
               <h1>strawberry</h1>
               <p>find your taste of desserts</p>
               <a href="menu.php" class="btn">explore more</a>
            </div>
         </div>
         <div class="box">
            <div class="box-overlay"></div>
            <img src="image/type2.png">
            <div class="box-details fadeIn-bottom">
               <h1>strawberry</h1>
               <p>find your taste of desserts</p>
               <a href="menu.php" class="btn">explore more</a>
            </div>
         </div>
         <div class="box">
            <div class="box-overlay"></div>
            <img src="image/type0.avif">
            <div class="box-details fadeIn-bottom">
               <h1>strawberry</h1>
               <p>find your taste of desserts</p>
               <a href="menu.php" class="btn">explore more</a>
            </div>
         </div>
         <div class="box">
            <div class="box-overlay"></div>
            <img src="image/type4.jpg">
            <div class="box-details fadeIn-bottom">
               <h1>strawberry</h1>
               <p>find your taste of desserts</p>
               <a href="menu.php" class="btn">explore more</a>
            </div>
         </div>
      </div>
   </div>
   <div class="flavor">
      <div class="box-container">
         <img src="image/left-banner2.webp">
         <div class="detail">
            <h1>hot deal! sale up to <span>20% off</span></h1>
            <p>expired</p>
            <a href="menu.php" class="btn">shop now</a>
         </div>
      </div>
   </div>
<div class="usage">
   <div class="heading">
      <h1>how it works</h1>
      <img src="image/separator-img.png">
   </div>
   <div class="row">
      <div class="box-container">
         <div class="box">
            <img src="image/icon.avif">
            <div class="detail">
               <h3>scoop ice-cream</h3>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas eum obcaecati necessitatibus repudiandae ducimus aspernatur consectetur id, recusandae provident perspiciatis qui,
                  </p>
            </div>
         </div>
         <div class="box">
            <img src="image/icon0.avif">
            <div class="detail">
               <h3>scoop ice-cream</h3>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas eum obcaecati necessitatibus repudiandae ducimus aspernatur consectetur id, recusandae provident perspiciatis qui,
                   </p>
            </div>
         </div>
         <div class="box">
            <img src="image/icon1.avif">
            <div class="detail">
               <h3>scoop ice-cream</h3>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas eum obcaecati necessitatibus repudiandae ducimus aspernatur consectetur id, recusandae provident perspiciatis qui,
                  </p>
            </div>
         </div>
      </div>
      <img src="image/sub-banner.png" class="divider">
      <div class="box-container">
         <div class="box">
            <img src="image/icon2.avif">
            <div class="detail">
               <h3>scoop ice-cream</h3>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas eum obcaecati necessitatibus repudiandae ducimus aspernatur consectetur id, recusandae provident perspiciatis qui,
               </p>
            </div>
         </div>
         <div class="box">
            <img src="image/icon3.avif">
            <div class="detail">
               <h3>scoop ice-cream</h3>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas eum obcaecati necessitatibus repudiandae ducimus aspernatur consectetur id, recusandae provident perspiciatis qui,
                  </p>
            </div>
         </div>
         <div class="box">
            <img src="image/icon4.avif">
            <div class="detail">
               <h3>scoop ice-cream</h3>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas eum obcaecati necessitatibus repudiandae ducimus aspernatur consectetur id, recusandae provident perspiciatis qui,
                  </p>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="pride">
   <div class="detail">
      <h1>we pride oueselves on <br>exceptional flavors</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br> Voluptas eum obcaecati necessitatibus repudiandae ducimus aspernatur consectetur id, recusandae provident perspiciatis qui,
                  </p>
           <a href="menu.php" class="btn">shop now</a>
   </div>
</div>
<?php 
include 'components/footer.php'; 
?>
<script src="js/user_script.js"></script>
</body>
</html>