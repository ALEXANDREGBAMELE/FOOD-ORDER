    <?php
    //Start Session
    session_start();
    //Create constants to store repeatin values
    define('SITEURL', 'http://localhost/FOOD-ORDER/');
    define('LOCALHOST', 'localhost');
    define('BD_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    $conn = mysqli_connect(LOCALHOST, BD_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database
    ?>