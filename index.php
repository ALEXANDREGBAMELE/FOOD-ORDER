<?php include('partials-front/menu.php'); ?>


<div class="container-fluid col-md-12">
    <!-- baniere section start here -->
<div class="row">
    <div class="baniere col-md-12">
        <div class="title text-center pt-5 ">
            <span class="mt-5 text-white fsa-1">Restaurant</span>
        </div>
    </div>
</div>

<!-- baniere section end here -->


<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

<!--Categories Section Starts here-->

<div class="recette text-center mt-5 mb-5 ">
    <a href="">
        <button class=" bg-primary rounded-pill ">
            <h1 class="text-white">Découvrez nos Categories</h1>
        </button>
    </a>
</div>

<div class="container">
<div class="row">


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
        <div class="col-md-4">
            <div class="card" style="width: 20rem;">
            <?php
                            //Check whether image is available or not
                            if ($image_name == "") {
                                //image not available
                                echo "<div class='error'>image not available</div>";
                            } else {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                                    class="img-responsive img-curve" width="100%" height="200">
                                <?php
                            }
                            ?>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <?php



    }
}
?>

</div>
</div>

<div class="clearfix"></div>
</div>
</section>
<!--categories section End here-->


<!--Food menu section starts here-->
<div class="container">
    <div class="title">
    <h2 class="text-center m-5">Menu </h2>
    </div>
    
    <div class="row">

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

            <div class="col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0 d-flex">
                        <div class="col-md-6">
                            <?php
                            //Check whether image is available or not
                            if ($image_name == "") {
                                //image not available
                                echo "<div class='error'>image not available</div>";
                            } else {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                                    class="img-responsive img-curve" width="150" height="150">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title"><?= $title ;?></h5>
                                <p class="card-text"><?= $description ?></p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php


        }
    } else {
        //Food not available
        echo "<div class='error'>Food not available. </div>";
    }
    ?>
    </div>


</div>
</section>
<!--Food menu section Ends here-->
</div>


</div>

<?php include('partials-front/footer.php') ?>