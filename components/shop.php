<div class="products">
       <div class="box-container">
        <?php 
        $select_products=" SELECT * FROM `products` WHERE status='active' LIMIT 6";
        $result=mysqli_query($conn,$select_products);
        if(mysqli_num_rows($result) > 0){
            while($fetch_products=mysqli_fetch_assoc($result)){
        ?>
        <form action="" method="post" class="box" <?php if($fetch_products['stock']== 0){
            echo"disabled";
        } ?>>
         <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
         <?php if($fetch_products['stock'] > 9){ ?>
        <span class="stock" style="color:green;">in stock</span>
        <?php } elseif($fetch_products['stock'] == 0){ ?>
        <span class="stock" style="color:red;">out of stock</span>
        <?php } else{ ?>
        <span class="stock" style="color:red;">hurry,only <?= $fetch_products['stock']; ?> </span>
          <?php }?>
          <div class="content">
            <img src="image/shape-19.png" alt="" class="shap">
            <div class="button">
                <div>
                <h3 class="name"><?= $fetch_products['name']; ?></h3></div>
                <div>
                    <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                    <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                    <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show"></a>
            </div>
            </div>
            <p class="price">price $<?= $fetch_products['price']; ?></p>
            <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
            <div class="flex-btn">
                <a href="checkout.php?get_id=<?= $fetch_products['id'] ?>" class="btn">buy now</a>
            <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty box">
            </div>
          </div>
        </form>
          <?php
            } 
        }else{
            echo'
               <div class="empty">
        <p>no products add yet! </p>
    </div>
            ';
         }

 ?>
        </div>
</div>