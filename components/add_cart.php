<?php
if(isset($_POST['add_to_cart'])){
    if($user_id != ''){
        $id=unique_id();
        $product_id=$_POST['product_id'];
        $qty=$_POST['qty'];
        $qty=filter_var($qty,FILTER_SANITIZE_STRING);
        $verify_cart="SELECT * FROM `cart` WHERE user_id='$user_id' && product_id='$product_id'";
        $result=mysqli_query($conn,$verify_cart);
        $max_cart_items="SELECT * FROM `cart` WHERE user_id='$user_id'";
        $result1=mysqli_query($conn,$max_cart_items);
        if(mysqli_num_rows($result) > 0){
            $warning_msg[]='product already exist in your cart';
        }
        elseif(mysqli_num_rows($result1) > 20){
            $warning_msg[]=' your cart is full';
        }
        elseif($user_id != ''){
            $select_price="SELECT * FROM `products` WHERE id='$product_id' LIMIT 1";
            $result=mysqli_query($conn,$select_price);
            $fetch_price=mysqli_fetch_assoc($result);
            $price=$fetch_price['price']; 
            $insert_cart="INSERT INTO `cart` ( id, user_id, product_id, price, qty) VALUES ('$id','$user_id','$product_id','$price','$qty')";
            $result=mysqli_query($conn,$insert_cart);
            $success_msg[]='product added to your cart successfully';
        }
    }
    else{
        $warning_msg[]='please login first';
    }

}
?>