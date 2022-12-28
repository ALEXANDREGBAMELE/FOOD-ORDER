    
    <?php include('partials/menu.php') ?>
    <?php include('../config/constants.php') ?>
        <div class="menu-content">
            <div class="wrapper">
                <h1>Add Admin</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];//Displaying session Message
                        unset($_SESSION['add']); //Removing Session Message
                    }
                ?>
                <br><br>
                <form action="#" method="post">
                    <table class="tbl-30">
                        <tr>
                            <td>Full Name : </td>
                            <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                        </tr>

                        <tr>
                            <td>Username : </td>
                            <td>
                                <input type="text" name="username" placeholder="your username">
                            </td>
                        </tr>

                        <tr>
                            <td>Password : </td>
                            <td>
                                <input type="password" name="password" placeholder="your password">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    <?php include('partials/footer.php') ?>

    <?php
        //Precss the value from and save it in Database
        //Check wether the button is clicked or not

        if(isset($_POST['submit']))
        {
            //Button Clicked
        // echo "Botton clicked";
        // 1 Get Data from form
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            $password =md5($_POST['password']);//password Encription with md5

            //2. SQL query to save the Data into database
            $sql = "INSERT INTO tbl_admin SET 
            full_name= '$full_name',
            username= '$username',
            password= '$password'
            ";
            // 3 Execute query and save Data in Database
            $res = mysqli_query($conn, $sql) or die(mysqli_error());

            //4 Check whether thr Data is inserted or not and display apropriate message
            if($res == TRUE){
                //Data inserted
                //echo " Data inserted ";
                //Create Session Variable to Display Message
                $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
                //Redirect page to Add Admin
                header("location:".SITEURL.'admin/manage-admin.php');
            }
            else
            {
                // Failled to insert Data
                //echo " Failed to insert Data ";
                //Create Session Variable to Display Message
                $_SESSION['add'] = 'Failed to insert Data ';
                //Redirect page to Add Admin
                header("location:".SITEURL.'admin/manage-admin.php');
            }

        }
    
    ?>