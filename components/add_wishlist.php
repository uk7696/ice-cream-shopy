<?php
if(isset($_POST['add_to_wishlist'])){
    if($user_id != ''){
        $id=unique_id();
        $product_id=$_POST['product_id'];
        $verify_wishlist="SELECT * FROM `wishlist` WHERE user_id='$user_id' && product_id='$product_id'";
        $result=mysqli_query($conn,$verify_wishlist);
        $cart_num="SELECT * FROM `cart` WHERE user_id='$user_id' && product_id='$product_id'";
        $result1=mysqli_query($conn,$cart_num);
        if(mysqli_num_rows($result) > 0){
            $warning_msg[]='product already exist in your wishlist';
        }
        elseif(mysqli_num_rows($result1) > 0){
            $warning_msg[]='product already exist in your cart';
        }
        elseif($user_id != ''){
            $select_price="SELECT * FROM `products` WHERE id='$product_id' LIMIT 1";
            $result=mysqli_query($conn,$select_price);
            $fetch_prices=mysqli_fetch_assoc($result);
            $fetch_price=$fetch_prices['price'];
            $insert_wishlist="INSERT INTO `wishlist` ( id, user_id, product_id, price) VALUES ('$id','$user_id','$product_id','$fetch_price')";
            $result=mysqli_query($conn,$insert_wishlist);
            $success_msg[]='product added to your wishlist successfully';
        }
    }
    else{
        $warning_msg[]='please login first';
    }
}
