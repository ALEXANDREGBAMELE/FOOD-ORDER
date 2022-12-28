<?php include('config/constants.php'); ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--import to make website responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> site web restaurant</title>

    <!--Link our css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <!--Navbar section start here-->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <!--<img src="images/logo.jpg" alt="Restaurant Logo" class="img-responsive">-->
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>"> Accueil </a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php"> Categories </a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php"> Foods </a>
                    </li>
                    <li>
                        <a href="#"> Contact </a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!--Navbar section end-->
</body>

</html>

<?php
// declaration de la monnaie du prix des produit ps:FCFA
$devise = " FCFA";
?>

<!--<html>

<head>
    <title> Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu section starts ->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu section end -->