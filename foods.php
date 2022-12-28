    <?php include('partials-front/menu.php') ?>

    <!--food search section starts here-->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="search for fund..." required>
                <input type="submit" name="submit" value="rechercher" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!--food search section Ends here-->

    <!--Food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu </h2>
            <?php
            //Display food that are active
            $sql = "SELECT * FROM tbl_food WHERE active='yes'";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //$count rows
            $count = mysqli_num_rows($res);

            //Check whether the food are available or not
            if ($count > 0) {
                //Food available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the value
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

            ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //Check whether image available or not
                            if ($image_name == "") {
                                //image not available
                                echo "<div class='error'>image not available</div>";
                            } else {
                                //image available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" width="200px">
                            <?php
                            }

                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price . $devise; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?= $id; ?>" class="btn btn-primary">Order Now </a>
                        </div>
                    </div>
            <?php
                }
            } else {
                //Food not available
                echo "<div class='error'>Food not found. </div>";
            }
            ?>




            <div class="clearfix"></div>

        </div>
    </section>
    <!-- Food menu section end here-->

    <?php include('partials-front/footer.php') ?>