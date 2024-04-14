<?php
include 'components/connect.php';

 if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
    header('location:login.php');
 }
 if(isset($_POST['place_order'])){
    $id=uniqid();
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);

    $number=$_POST['number'];
    $number=filter_var($number,FILTER_SANITIZE_STRING);

    $email=$_POST['email']; 
    $email=filter_var($email,FILTER_SANITIZE_STRING);

    $address=$_POST['flat'].','.$_POST['street'].','.$_POST['city'].','.$_POST['country'].','.$_POST['pin'];
    $address=filter_var($address,FILTER_SANITIZE_STRING);

    $address_type=$_POST['address_type'];
    $address_type=filter_var($address_type,FILTER_SANITIZE_STRING);

    $method=$_POST['method']; 
    $method=filter_var($method,FILTER_SANITIZE_STRING);
    $verify_cart="SELECT * FROM `cart` WHERE user_id='$user_id'";
    $result=mysqli_query($conn,$verify_cart);

    if(isset($_GET['get_id'])){
        $get_id=$_GET['get_id'];
        $get_product = "SELECT * FROM `products` WHERE id='$get_id' LIMIT 1";
        $result1=mysqli_query($conn,$get_product);
        if(mysqli_num_rows($result1) > 0){
            while($fetch_p=mysqli_fetch_assoc($result1)){
                $seller_id=$fetch_p['seller_id'];
                $product_id=$fetch_p['id'];
                $price=$fetch_p['price'];
                $insert_order="INSERT INTO `orders` ( id, user_id, seller_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES ('$id','$user_id','$seller_id','$name','$number','$email','$address','$address_type','$method','$product_id','$price',1)";
                $result2=mysqli_query($conn,$insert_order);
                header('location:order.php');
            }  
        } else{
            $warning_msg="something went wrong";
        }   
    }elseif(mysqli_num_rows($result) > 0){
        while($f_cart=mysqli_fetch_assoc($result)){
            $product_id=$f_cart['product_id'];
            $s_products = "SELECT * FROM `products` WHERE id='$product_id' LIMIT 1";
            $result3=mysqli_query($conn,$s_products);
            $f_product=mysqli_fetch_assoc($result3);
            $seller_id=$f_product['seller_id'];
            $price=$f_product['price'];
            $insert_order="INSERT INTO `orders` ( id, user_id, seller_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES ('$id','$user_id','$seller_id','$name','$number','$email','$address','$address_type','$method','$product_id','$price',1)";
            $result2=mysqli_query($conn,$insert_order);
        }
        if($insert_order){
            $delete_cart="DELETE FROM `cart` WHERE user_id='user_id'";
            $result=mysqli_query($conn,$delete_cart);
            header('location:order.php');
        }
    }else{
        $warning_msg[]='something went wrong';
    }
 }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gulu gulu -checkout page</title>
    <link rel="stylesheet" href="css/user_style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<style>
    .form-container{
        background-image:url("image/banner.jpg");
    }
    .checkout{
        background-image: url("image/bg1.webp");
    background-repeat: no-repeat;
    background-size:cover;
background-attachment: fixed;
padding: 100px 6%;
    }
    .checkout .row{
        display: flex;
        flex-direction: column;
        flex-flow: column-reverse;
    }
    .checkout .row form,
    .checkout .summary{
        box-shadow: var(--box-shadow);
        border-radius: .5rem;
        width: 1000px;
        padding: 1rem;
        margin: 1rem auto;
    }
    .checkout .row h3{
        font-size: 2rem;
        padding-bottom: 1rem;
        text-transform: capitalize;
        text-align: center;
    }
    .checkout .row form .box{
           flex: 1 1 20rem;
    }
    .checkout .row form .input{
        background-color: var(--white-alpha-25);
    border: 2px solid var(--white-alpha-40);
    backdrop-filter: var(--backdrop-filter);
    box-shadow: var(--box-shadow);
    width: 100%;
    border-radius: .5rem;
    margin: 1rem 0;
    font-size: 1.3rem;
    padding: 1rem;
 
    }
    .checkout .row form .flex{
        display: flex;
        column-gap: 1.5rem;
        flex-wrap: wrap;
    }
    .checkout .row form p{
        text-align: left;
        padding-top: .5rem;
        font-size: 1.1rem;
        text-transform: uppercase;
        color: gray;
    }
    .checkout .row form span{
        color: red;
    }
    .checkout .row form .btn{
        width: 100%;
    }
    .checkout .summary .name{
        font-size: 1.2rem;
        color:#000;
    
        text-transform: capitalize;
       
    }
    .checkout .summary .flex{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 0;
        margin: .5rem;
    }
    .checkout .summary .box-container{
        grid-template-columns: repeat(auto-fit,minmax(15rem,1fr));
    }
    .checkout .summary .flex img{
        box-shadow: var(--box-shadow);
        border-radius: 50%;
        width: 100px;
        height: 100px;
        padding: .5rem;
        margin-right:2rem ;
    }
    .checkout .summary .price{
        font-size: 1.5rem;
        color: red;
    }
    .checkout .summary .grand-total{
        border-radius: .5rem;
        box-shadow: var(--box-shadow);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        font-size: 2rem;
        margin-top: 1.5rem;
        text-transform: capitalize;
        padding: 2rem 0;
    }
    .checkout .summary .grand-total p{
        color: red;
        margin-left: .5rem;
    }
</style>
</head>
<body>
<?php 
include 'components/user_header.php'; 
?>
<div class="banner">
    <div class="detail">
        <h1>checkout</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum consequatur aliquam sint magnam error labore,<br> nemo aperiam tempore in cumque recusandae delectus sit maiores neque corrupti quibusdam? Expedita, culpa aliquid.</p>
    <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>checkout</span>
    </div>
</div>
<div class="checkout">
    <div class="heading">
        <h1>checkout summary</h1>
        <img src="image/separator-img.png">
    </div>
    <div class="row">
    <form action="" method="post" class="register">
        <input type="hidden" name="p_id" value="<?= $get_id; ?> ">
        <h3>billing details</h3>
        <div class="flex">
            <div class="box">
            <div class="input-field">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="input">
            </div>
               <div class="input-field">
                    <p>your number<span>*</span></p>
                    <input type="number" name="number" placeholder="enter your number" maxlength="10" required class="input">
                </div> 
                <div class="input-field">
                    <p>your email <span>*</span></p>
                    <input type="text" name="email" placeholder="enter your email" maxlength="50" required class="input">
            </div>
            <div class="input-field">
            <p>payment method<span>*</span></p>
            <select name="method" class="input">
                <option value="cash on delivery">cash on delivery</option>
                <option value="credit or debit card">credit or debit card</option>
                <option value="net banking">net banking</option>
                <option value="UPI or RuPay">UPI or RuPay</option>
                <option value="paytm">paytm</option>
            </select>
            </div>
            <div class="input-field">
            <p>address type<span>*</span></p>
            <select name="address_type" class="input">
                <option value="home">home</option>
                <option value="office">office</option>
            </select>
            </div>
            </div>
            <div class="box">
            <div class="input-field">
                    <p>address line 01 <span>*</span></p>
                    <input type="text" name="flat" placeholder="e.g flat or building name" maxlength="50" required class="input">
            </div>
            <div class="input-field">
                    <p>address line 02 <span>*</span></p>
                    <input type="text" name="street" placeholder="e.g street name" maxlength="50" required class="input">
            </div>
            <div class="input-field">
                    <p>city name <span>*</span></p>
                    <input type="text" name="city" placeholder="enter your city name" maxlength="50" required class="input">
            </div>
            <div class="input-field">
                    <p>country name <span>*</span></p>
                    <input type="text" name="country" placeholder="enter your country name" maxlength="50" required class="input">
            </div>
            <div class="input-field">
                    <p>pincode <span>*</span></p>
                    <input type="number" name="pin" placeholder="e.g 110011" maxlength="6" required class="input">
            </div>
            </div>
        </div>
        <button type="submit" name="place_order" class="btn">place order</button>
    </form>
    <div class="summary">
        <h3>my bag</h3>
        <div class="box-container">
            <?php 
             $grand_total=0;
             if(isset($_GET['get_id'])){
                $get_id=$_GET['get_id'];
              $select_get="SELECT * FROM `products` WHERE id='$get_id'";
              $result=mysqli_query($conn,$select_get);
              while($fetch_get=mysqli_fetch_assoc($result)){
             $sub_total =$fetch_get['price'];
             $grand_total+=$sub_total;
            ?>
            <div class="flex">
            <img src="uploaded_files/<?= $fetch_get['image']; ?>" class="image">
            <div>
            <h3 class="name"><?= $fetch_get['name']; ?></h3>
            <p class="price">price $<?= $fetch_get['price']; ?></p>
            </div>
        </div>
            <?php
              }
            }else{
                $select_cart="SELECT * FROM `cart` WHERE user_id='$user_id'";
                $result=mysqli_query($conn,$select_cart);
                if(mysqli_num_rows($result) > 0){
                    while($fetch_cart=mysqli_fetch_assoc($result)){  
                        $cart_id=$fetch_cart['product_id'];
                        $select_products="SELECT * FROM `products` WHERE id='$cart_id'";
                        $result1=mysqli_query($conn,$select_products);
                        $fetch_products=mysqli_fetch_assoc($result1);
                        $sub_total=((float)$fetch_products['price'] *(float)$fetch_cart['qty']);
                        $grand_total +=$sub_total;

            ?>
            <div class="flex">
            <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
            <div>
            <h3 class="name"><?= $fetch_products['name']; ?></h3>
            <p class="price"><?= $fetch_products['price']; ?> X <?=$fetch_cart['qty']; ?></p>
            </div>
        </div>
            <?php 
                    }
                }else{
                    echo'<p class="empty">your cart is empty</p>';
                }
            }
            ?>
        </div>
      <div class="grand-total">
        <span>total amount payable:</span>
        <p><?= $grand_total; ?>/-</p>
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