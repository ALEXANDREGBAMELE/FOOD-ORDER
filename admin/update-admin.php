    <?php include('partials/menu.php'); ?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Update Admin</h1>
                <br><br>
                <?php
                    // 1.Get the ID select Admin
                    $id = $_GET['id'];
                    
                    // 2. Create SQL query to Get the details
                    $sql = "SELECT * FROM tbl_admin";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //Check whether the query Execute or not
                    if($res==true)
                    {
                        //Check whethr the Data is available or not
                        $count = mysqli_num_rows($res);
                        //Check whether we have admin data or not
                        if($count==1)
                        {
                            //Get the details
                            //echo "Admin Available";
                            $rows=mysqli_fetch_assoc($res);

                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                        }
                        else
                        {
                            //Redirect to manage admin page
                            header('location:'.SITEURL."admin/manage-admin.php");
                        }
                    }
                ?>
                <form action="" method ="post">
                    <table class="tbl-30" >
                            <tr>
                                <td>Full Name : </td>
                                <td><input type="text" name="full_name" value="<?php echo $full_name ; ?>"></td>
                            </tr>

                            <tr>
                                <td>Username : </td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $username ; ?>">
                                </td>
                            </tr>
                            
                            <tr>

                                <td colspan="2">
                                    <input type="hidden" name="id" value="<?php echo $id ; ?> ">
                                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                                </td>
                            </tr>
                    </table>
                </form>
            </div>
        </div>
        <?php
            //Check whether the submit Button clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Button clicked";
                //Get all the values from form to updte
                $id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];

                //Create query to update Admin
                $sql = "UPDATE tbl_admin SET 
                full_name = '$full_name',
                username = '$username'
                WHERE id = '$id'
                ";
                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Check whether the query execute successffuly or not
                if($res==true)
                {
                    // Query executed and Admin updated
                    $_SESSION['update'] = " <div class='success'>Admin Updated Succssfully</div> ";
                    //Redirected to manage Admin page
                    header('location:'.SITEURL."admin/manage-admin.php");
                }
                else
                {
                    //Failed to update Admin
                    $_SESSION['update'] = " <div class='error'>Failed to update Admin</div> ";
                    //Redirected to manage Admin page
                    header('location:'.SITEURL."admin/manage-admin.php");

                }
            }

        ?>
    <?php include('partials/footer.php'); ?>