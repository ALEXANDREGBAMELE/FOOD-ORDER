<?php include('partials/menu.php') ?>

<!-- Main content section starts-->
<div class="main-content">
            <div class="wrapper">
                <h1> Manage Food</h1>
                <br><br>

                <?php 

                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['Unauthorized']))
                    {
                        echo $_SESSION['Unauthorized'];
                        unset($_SESSION['Unauthorized']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }


                ?>


                <!-- botton to add admin-->
                <br/><a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary"> Add Food</a><br/><br><br>

                <table class="tbl-full" >
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>image</th>
                        <th>featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                
                        //Creat sql query to get  all the food
                        $sql = "SELECT * FROM tbl_food";

                        //Execute the query 
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have food or not
                        $count = mysqli_num_rows($res);
                        //Create serial number variable and set default value as 1
                        $sn = 1;

                        if($count>0)
                        
                        {
                            //We have food in Database
                            //Get the Food from Database and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the value from individual colums
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                     <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td>
                                            <?php 
                                                //Check whether we have image or not

                                                    //We do not have image or not
                                                    if($image_name != "")
                                                    {

                                                           //we have image , display image
                                                           ?>
                                                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" >
                                                           <?php

                                                        
                                                    }
                                                    else
                                                    {
                                                     //We do not have image, display error message
                                                     echo '<div class="error">Image not added.</div>';

                                                    }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>

                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php $image_name; ?>" class="btn-danger">Delete Food</a>
                            
                        </td>
                    </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr><td colspan='7' class='error'>Found not Added Yet. </td></tr>";
                        }
                    ?>        
                   
                </table>
                    
            </div>   
        </div>
        <!-- Main content end -->
    
    
<?php include('partials/footer.php') ?>