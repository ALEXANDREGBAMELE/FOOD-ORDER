        <?php include('../config/constants.php'); ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Connexion - Système de gestion restaurant</title>
            <link rel="stylesheet" href="../css/admin.css">
        </head>

        <body>
            <div class="login">
                <h1 class="text-center">Connexion</h1>
                <br><br>
                <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if (isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

                ?>
                <br>
                <br>
                <!--Login Form start here-->

                <form action="" method="post" class="text-center">
                    username : <br>
                    <input type="text" name="username" placeholder="Enter username" .img-responsive{ width: 100%};><br><br>
                    Password : <br>
                    <input type="password" name="password" placeholder="Enter Password" .img-responsive{ width: 100%};><br><br>
                    <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
                </form>
                <p class="text-center">Créer par - <a href="">AlexDev</a></p>
                <!--Login Form start here-->
            </div>
        </body>

        </html>
        <?php
       // Chech whether the submit Button is clicked or not
        if (isset($_POST['submit'])) {
           // Process for Login
           //1. Get the Data from Logi form
            $username = $_POST['username'];
            $password  = ($_POST['password']);

            $username = mysqli_real_escape_string($conn, $_POST['username']);

            $row_password  = ($_POST['password']);
            $password  = mysqli_real_escape_string($conn, $row_password);

            //2. SQL to check whether the user with username and password exists or not
            $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

            //3. Execute the Query
            $res = mysqli_query($conn, $sql);

            //4. Count rows to check whether the user exist or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //user available and login success
                $_SESSION['login'] = "<div class='success'>connexion avec succès.</div>";
                $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

                // //Redirect to home page/Dashboard
                 header('location:' . SITEURL . "admin/index.php");
            } else {
               // user not available
                $_SESSION['login'] = "<div class='error text-center' >Nom d'utilisateur ou mot de pass incorrect.</div>";
               // Redirect to login page/Dashboard
                header('location:' . SITEURL . "admin/login.php");
            }
        }
        ?>
        <?php //include('partials/footer.php'); 
        ?>