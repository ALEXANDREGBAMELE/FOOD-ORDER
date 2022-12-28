    <?php include('partials-front/menu.php'); ?>

    <?php
    //Check whether id passe or not 
    if (isset($_GET['category_id'])) {
        //Category id is set and get the id
        $category_id = $_GET['category_id'];
        //Get the category title Based on Category id
        $sql = "SELECT title FROM tbl_category  WHERE category_id=$category_id";

        //Execute the Query
        $res = mysqli_query($conn, $res);

        //Get the values from Database
        $row = mysqli_fetch_assoc($res);
        //Get the title
        $category_title = $row['title'];
    } else {
        //Category not passed
        //Redirect to home page
        header('location :' . SITEURL);
    }
    ?>
    <!--food search section starts here-->
    <section class="food-search text-center">
        <div class="container">
            <h2> Food on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>
        </div>
    </section>
    <!--food search section Ends here-->

    <!--Food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center"> Menu </h2>

            <?php
            //Create Sql Query to Get food based on select Category
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' ";
            //Execute the sql
            $res2 = mysqli_query($conn, $sql2);
            //Count rows
            $count2 = mysqli_num_rows($res2);
            //check food categories available or not
            if ($count2 > 0) {
                //Food available
                while ($row2 = mysqli_fetch_assoc($res2)) {

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
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Ajouter au pannier</a>
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
            <a href="#">voir plus...</a>
        </p>

        <div class="clearfix"></div>

        <?php include('partials-front/footer.php') ?>