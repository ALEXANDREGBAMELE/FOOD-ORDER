

    <?php include('partials/menu.php') ?>
        <!-- Menu section end -->

        <!-- Main content section starts-->
        <div class="main-content">
            <div class="wrapper">
                <h1> Manage Admin</h1>
                <br>
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];//Displaying session Message
                        unset($_SESSION['add']); //Removing Session Message
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];//Displaying session Message
                        unset($_SESSION['delete']); //Removing Session Message
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];//Displaying session Message
                        unset($_SESSION['update']); //Removing Session Message
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['password-not-match']))
                    {
                        echo $_SESSION['password-not-match'];
                        unset($_SESSION['password-not-match']);
                    }
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>
                <br><br><br>
                <!-- botton to add admin-->
                <br/><a href="add-admin.php" class="btn-primary"> Add Admin</a><br/><br><br>

                <table class="tbl-full" >
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    //query to get all admin
                        $sql = "SELECT * FROM tbl_admin";
                    // Execute Query
                    $res = mysqli_query($conn, $sql);
                    // Check whether the Query is Execute of Not
                    if($res==TRUE)
                    {
                        // Count Rows to Check whether we have Data in Database or Not
                        $count = mysqli_num_rows($res); // Function to get all the rows in Database
                        $sn=1; // Create a variable and assign the value
                        //Check the num of rows
                        if($count>0)
                        {
                            //We Have Data in Database
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                //Using while loop to get all the Data from database.
                                //And while loop rum as long as we have data in database

                                //Get individual Data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //Display the Values in our Table
                                ?>
                                      <tr>
                                            <td><?php echo $sn++ ;?></td>
                                            <td><?php echo $full_name ; ?></td>
                                            <td><?php echo $username ; ?></td>
                                            <td>
                                            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                
                                            </td>
                                        </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //we do not ave Data in Database
                        }
                    }

                    ?>

                </table>
                    
            </div>   
        </div>
        <!-- Main content end -->

        <!-- Footer section starts -->
        <?php include('partials/footer.php') ?>
        <!-- Footer section end -->

    </body>
</html>