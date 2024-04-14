<header>
    <div class="logo">
        <img src="../image/ice.jpg" width="80">
     </div>
    <div class="right">
        <div class="bx bxs-user" id="user-btn"></div>
        <div class="toggle-btn"> <i class="bx bx-menu"></i></div>
    </div>
    <div class="profile-detail">
        <?php
        $select_profile="SELECT * FROM `sellers` WHERE id ='$seller_id'";
        $result=mysqli_query($conn,$select_profile);
        if(mysqli_num_rows($result) > 0){
            $fetch_profile=mysqli_fetch_assoc($result);
        ?>
        <div class="profile">
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" width="100">
            <p><?= $fetch_profile['name']; ?></p>
            <div class="flex-btn">
                <a href="profile.php" class="btn">profile</a>
                <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="btn">logout</a>
            </div>
        </div>  
        <?php } ?>      
    </div>
</header>

    <div class="sidebar">
    <?php
        $select_profile="SELECT * FROM `sellers` WHERE id ='$seller_id'";
        $result=mysqli_query($conn,$select_profile);
        if(mysqli_num_rows($result) > 0){
            $fetch_profile=mysqli_fetch_assoc($result);
        
        ?>
        
        <div class="profile">
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" width="100">
            <p><?= $fetch_profile['name']; ?></p>
        </div>
         <?php } ?>
        <h5>menu</h5>
        <div class="navbar">
            <ul>
                <li><a href="dashboard.php"><i class='bx bxs-home-smile'></i>dashboard</a></li>
                <li><a href="add_products.php"><i class='bx bxs-shopping-bags'></i>add products</a></li>
                <li><a href="view_product.php"><i class='bx bxs-food-menu'></i>view product</a></li>
                <li><a href="user_accounts.php"><i class='bx bxs-user-detail'></i>accounts</a></li>
                <li><a href="../components/admin_logout.php" onclick="return confirm('logout from this website');"><i class="bx bx-log-out"></i>logout</a></li>
            </ul>
        </div>
        <h5>find us</h5>
        <div class="social-links">
            <i class='bx bxl-facebook'></i>
            <i class='bx bxl-instagram-alt'></i>
            <i class='bx bxl-linkedin'></i>
            <i class='bx bxl-twitter'></i>
            <i class='bx bxl-pinterest-alt'></i>
        </div>
    </div>
