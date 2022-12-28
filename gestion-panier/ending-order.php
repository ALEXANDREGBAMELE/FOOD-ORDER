<?php include('partials-front/menu.php') ?>
<section class="food-search">
    <div class="container">
        <div class="fond-bleu">
            <fieldset>
                <legend> Détails de livraison </legend>

                <div class="order-label">Nom : </div>
                <input type="text" name="full-name" placeholder="E.g. Alex Dev" class="input-responsive" required>

                <div class="order-label">Numéro téléphone</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">E-mail</div>
                <input type="email" name="email" placeholder="E.g. alexdev@gmail.com" class="input-responsive" required>

                <div class="adresse">Adresse</div>
                <textarea name="adress" rows="10" placeholder="E.g.streat, city,contry" class="input-responsive" required></textarea>

                <a href="facture.php"><input type="submit" name="submit" value="confirmer" class="btn btn-primary"></a>
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

                $order_date = date("y-m-d h:i:sa");

                $fstatus = "Ordered"; //Ordered, On Delivered, Cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_adress = $_POST['adress'];

                //Save the order in Database
                //Create Sql to save the data
                $sql2 = "INSERT INTO tbl_order SET 
            food = '$food',
            price = '$price',
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_adress = '$customer_adress'
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