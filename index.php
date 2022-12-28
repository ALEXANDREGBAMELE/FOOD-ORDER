<?php include('partials-front/menu.php'); ?>
<!--food search section starts here-->

<div class="main-content">
    <div class="wrapper">
    </div>
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="search for fund..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!--food search section Ends here-->


    <?php

    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>

    <!--Categories Section Starts here-->
    <section class="categories">
        <div class="container ">
            <h2 class="text-center">Découvrez nos recettes</h2>

            <?php
            //create sql query to display categories from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //Execute the sql
            $res = mysqli_query($conn, $sql);
            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //Category available 
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the value like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

            ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $category_id; ?>">
                        <div class="box-3 float-container categories-space ">
                            <?php
                            //Check whether image is available or not
                            if ($image_name == "") {
                                //Display message
                                echo "<div class='error'>image not available</div>";
                            } else {
                                //image available
                            ?>
                                <img class="imag-cat" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" width="200px">
                            <?php
                            }
                            ?>


                            <h3 class="float-text text-white"><?php echo $title; ?></h3>

                        </div>
                    </a>
            <?php
                }
            } else {
                //Category not available
                echo "<div class='error'>Category not added </div>";
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!--categories section End here-->


    <!--Food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu </h2>
            <?php
            //Geting Foods from database that are actiive and featured
            //SQL 
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            //Execute the sql
            $res2 = mysqli_query($conn, $sql2);
            //Count rows
            $count2 = mysqli_num_rows($res2);
            //check food categories available or not
            if ($count2 > 0) {
                //Food available
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    //Get the value like id, title, image_name
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];

            ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //Check whether image is available or not
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
                echo "<div class='error'>Food not available. </div>";
            }
            ?>


            <div class="clearfix"></div>

        </div>
        <p class="text-center">
            <a href="#">voir plus ...</a>
        </p>
    </section>
    <!--Food menu section Ends here-->
</div>



<?php include('partials-front/footer.php') ?>