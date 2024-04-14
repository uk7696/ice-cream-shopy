<header class="header">
<section class="flex">
<a href="home.php" class="logo"><img src="image/ice.jpg" width="60px"></a>
<nav class="navbar">
<a href="home.php">home</a>
<a href="about-us.php">about us</a>
<a href="menu.php">shop</a>
<a href="order.php">order</a>
<a href="contact.php">contact us</a>
</nav>
<form action="search_product.php" method="post" class="search-form">
<input type="text" name="search_product" placeholder="search product..." required
maxlength="100">
<button type="submit" class="bx bx-search-alt-2" id="search_product_btn"></button>
</form>
<div class="icons">
<div class="bx bx-list-plus" id="menu-btn"></div>
<div class="bx bx-search-alt-2" id="search-btn"></div>
<?php
$count_wishlist_item="SELECT * FROM `wishlist` WHERE user_id='$user_id'";
$result=mysqli_query($conn,$count_wishlist_item);
$total_wishlist_items= mysqli_num_rows($result);
?>
<a href="wishlist.php"><i class="bx bx-heart"></i><sup><?= $total_wishlist_items; ?></sup></a>
<?php
$count_cart_item="SELECT * FROM `cart` WHERE user_id='$user_id'";
$result=mysqli_query($conn,$count_cart_item);
$total_cart_items= mysqli_num_rows($result);
?>
<a href="cart.php"><i class="bx bx-cart"></i><sup><?= $total_cart_items; ?></sup></a>
<div class="bx bxs-user" id="user-btn"></div>
</div>
<div class="profile-detail">
<?php
        $select_profile="SELECT * FROM `users` WHERE id ='$user_id'";
        $result=mysqli_query($conn,$select_profile);
        if(mysqli_num_rows($result) > 0){
            $fetch_profile=mysqli_fetch_assoc($result);
        ?>
        <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
        <h3 style="margin-bottom: 1rem;"><?= $fetch_profile['name']; ?></h3>
        <div class="flex-btn">
            <a href="profile.php" class="btn">view profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website');" class="btn">logout</a>
        </div>
        <?php }else{ ?>
<h3 style="margin-bottom: 1rem;">please login or register</h3>
<div class="flex-btn">
    <a href="login.php" class="btn">login</a>
    <a href="register.php" class="btn">register</a>
</div>
            <?php } ?>
</div>
</section>
</header>