<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Ancien mot de passe : </td>
                    <td>
                        <input type="password" name="current-password" placeholder="ancien mot de passe">
                    </td>
                </tr>
                <tr>
                    <td>Nouvau mot de passe : </td>
                    <td>
                        <input type="password" name="new_password" placeholder="nouvau mot de passe">
                    </td>
                </tr>
                <tr>
                    <td>Confimation du mot de passe : </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confimation du mot de passe">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" Value="Change Password" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    //echo "clicked";

    // 1. Get the data form from
    $id = $_POST['id'];
    $current_password = md5($_POST['current-password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Check whether the current id and current password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        // Check whether data is available or not
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //user exists and password can be change
            //echo "User found";

            //Check whther the new password and confirm match or not
            if ($new_password == $confirm_password) {
                //Update password
                //echo "Password match";
                $sql2 = "UPDATE tbl_admin SET 
                            password = '$new_password'
                            WHERE id = $id
                            ";
                //Execute the Query
                $res2 = mysqli_query($conn, $sql);

                //Check whether the query executed or not
                if ($res2 == true) {
                    //Display succes message
                    //Redirect to Manage Admin page with success message
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                    //Redirect the user
                    header('location:' . SITEURL . "admin/manage-admin.php");
                } else {
                    //Display error message
                    //User does not Exist set Message and Redirect
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password.</div>";
                    //Redirect the user
                    header('location:' . SITEURL . "admin/manage-admin.php");
                }
            } else {
                //Redirect to Manage Admin page with error message
                $_SESSION['password-not-match'] = "<div class='error'>Password did not match.</div>";
                //Redirect the user
                header('location:' . SITEURL . "admin/manage-admin.php");
            }
        } else {
            //User does not Exist set Message and Redirect
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
            //Redirect the user
            header('location:' . SITEURL . "admin/manage-admin.php");
        }
    }

    //3. Change Password if all above is true


}
?>

<?php include('partials/footer.php'); ?>