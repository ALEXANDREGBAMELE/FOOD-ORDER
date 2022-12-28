<?php include('partials-front/menu.php'); ?>
<!--Search section starts here-->
<section class="food-search text-center">
    <div class="container">
        <?php
        //Get the Search Keyword
        //$search = $_POST['search'];
        $search = mysqli_real_escape_string($conn, $_POST['search']);

        ?>
        <h2>Food on Your Seach <a href="" class="text-white"> <?php echo $search; ?></a> </h2>
    </div>

</section>
<!--Search section ends here-->

<!--Food Menu sectionstart here-->

<section class="food-menu">
    <div class="container">
        <h2 class="text-center"> Food Menu </h2>
        <?php

        //Sql Query to get foods based on search keybord
        //$search=burger'; DROP DataBase name;
        //"SELECT * FROM tbl_food WHERE title LIKE '%burger'%' or description LIKE '%burger%'";
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        $res = mysqli_query($conn, $sql);
        //Count rows
        $count = mysqli_num_rows($res);
        //check food  available or not
        if ($count > 0) {
            //Food available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the value like id, title, image_name
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];

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
                        <p class="food-price">$<?php echo $price; ?></p>
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
    <p class="text-center">
        <a href="#">Voir plus...</a>
    </p>
</section>

<!--Food Menu section ends here-->






<?php include('partials-front/footer.php') ?>