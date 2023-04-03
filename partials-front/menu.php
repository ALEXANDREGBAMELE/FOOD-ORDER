<?php include('config/constants.php'); ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--import to make website responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> site web restaurant</title>

    <!--Link our css file-->
    <!-- <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css"> -->
    <link rel="stylesheet" href="css/font-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  
    <!-- newnavbar start here -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a href="#" title="Logo" class="me-3">
                <img src="images/logo.jpg" alt="Restaurant Logo" class="img-responsive">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo SITEURL; ?>"> Accueil </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo SITEURL; ?>categories.php">
                            Categories </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active" aria-current="page" href="<?php echo SITEURL; ?>foods.php"> Foods
                        </a>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"> Contact </a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="<?php echo SITEURL; ?>food-search.php" method="POST">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                    <!-- <input type="submit" name="submit" value="Search" class="btn btn-primary"> -->
                </form>

            </div>
        </div>
    </nav><br><br><br>

    <!-- new navbar end here -->
</body>

</html>

<?php
// type de monnais en FCFA
$devise = " FCFA";
?>