<?php include('partials-front/menu.php'); ?>
<?php include('config/constants.php'); ?>

<!--Categories Section Starts here-->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        //Display all the categories that are active
        // sql query
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'";
        //Execute the sql
        $res = mysqli_query($conn, $sql);
        //Count rows to check whether the category is available or not
        $count = mysqli_num_rows($res);
        //check whether categories available or not
        if ($count > 0) {
            //Category available 
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the value like id, title, image_name
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

        ?>
                <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                        //Check whether image is available or not
                        if ($image_name == "") {
                            //Display message
                            echo "<div class='error'>image not found</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" width="200px">
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
        /* <?php
                //create sql query to display categories from database
            
                /
                
                
            ?>*/

        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!--categories section End here-->

<?php include('partials-front/footer.php') ?>