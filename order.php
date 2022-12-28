<?php include('partials-front/menu.php') ?>

<!--Food search section starts here-->
<!--<section class="food-search text-center">
    <div class="container">
        <form action="<?php //echo SITEURL; 
                        ?>food-search.php" method="POST"></form>
        <input type="search" name="search" placeholder="search for food..." required>
        <input type="submit" name="submit" placeholder="search" class="btn btn-primary">
    </div>
</section>
-->
<?php
//Check whether food id is set or not
if (isset($_GET['food_id'])) {

    //Get the food id and details of the selected food
    $food_id = $_GET['food_id'];

    //Get the details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //count the rows
    $count = mysqli_num_rows($res);
    //Check whether the data is available or not
    if ($count == 1) {
        //We have Data
        //Get the Data from database
        $row = mysqli_fetch_assoc($res);

        //$id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        //$description = $row['description'];
        $image_name = $row['image_name'];
    } else {
        //Food not available
        //Redirect to home page
        header('location:' . SITEURL);
    }
} else {
    //Redirect to home page
    header('location:' . SITEURL);
}
?>

<!--food search section starts here-->
<section class="food-search">
    <div class="container">
        <div class="fond-bleu">

            <h2 class="text-center text-white">Remplissez ce formulaire pour confirmer votre commande</h2>
            <from action="" method="POST" class="order">
                <fieldset>
                    <legend>Plat sélectionné </legend>
                    <div class="food-menu-img">
                        <?php
                        //Check whether the image is available or not
                        if ($image_name == "") {
                            //image not available
                            echo "<div class='error'>image not available</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" width="100px">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <input type="hidden" name="food" value="<?php echo $title ?>">
                        <p class="food-price"><?php echo $price . $devise; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ?>">

                        <div class="order-label"> Quantité</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        <a href="<?php echo SITEURL; ?>/order.php" class="btn btn-primary"> Ajouter commande </a>

                    </div>
                </fieldset>

                <fieldset>
                    <legend> Détails de livraison </legend>

                    <div class="order-label">Nom : </div>
                    <input type="text" name="full-name" placeholder="exple: Alex Dev" class="input-responsive" required>

                    <div class="order-label">Numéro téléphone</div>
                    <input type="tel" name="contact" placeholder="exple: 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">E-mail</div>
                    <input type="email" name="email" placeholder="exple: alexdev@gmail.com" class="input-responsive" required>

                    <div class="order-label">Adresse</div>
                    <textarea name="address" rows="10" placeholder="exple: streat, city,contry" class="input-responsive" required></textarea>
                    <input type="submit" name="submit" value="confirmer la commande" class="btn btn-primary">

                    <!--<a href="ending-order.php"><input type="submit" name="submit" value="confirmer la commande" class="btn btn-primary"></a>-->

                </fieldset>
            </from>
            <?php
            //Check whether submit button is clicked or not
            if (isset($_POST['submit'])) {
                //Get all the details from the form

                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty; //total = price * qty

                $order_date = date("y-m-d h:i:sa"); //Heure de commande

                $status = "Ordered"; //Ordered, On Delivered, Cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['adress'];

                //Save the order in Database
                //Create Sql to save the data
                $sql2 = "INSERT INTO tbl_order SET 
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
            ";

                echo $sql2;
                die();

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether query executed successfully or not
                if ($res2 == true) {
                    //Query executed and order save
                    $_SESSION['order'] = '<div class="success"text-center>Food ordered successfully.</div>';
                    header('location:' . SITEURL);
                } else {
                    //Failed to save order
                    $_SESSION['order'] = '<div class="error" text-center>Failed to order food.</div>';
                    header('location:' . SITEURL);
                }
            }
            ?>
        </div>

    </div>
</section>
<!--food search section Ends here-->
<?php include('partials-front/footer.php') ?>