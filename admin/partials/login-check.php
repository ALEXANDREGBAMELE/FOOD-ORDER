    <?php
    //Authorization - Access Control
    //Check whether the user is logged in or not
    if (!isset($_SESSION['user'])) //if user session is not set
    {
        //user is not logged in
        //Redirection to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Connectez-vous à la page d'administrateur svp.</div>";
        ////Redirection to login
        header('location:' . SITEURL . "admin/login.php");
    }
    ?>