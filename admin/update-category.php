    <?php include('partials/menu.php');?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Update Category</h1>
                <br><br>

                <?php
                    //Check Whether the id is set or not
                    if(isset($_GET['id']))
                    {
                        //Get the Id and all other details
                       //echo "Getting the Data";
                        $id = $_GET['id'];
                        //Create SQL Query to get all other details
                        $sql = "SELECT * FROM tbl_category WHERE id=$id";

                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Count the rows to check whether the id is valid or not
                        $count = mysqli_num_rows($res);

                        if($count == 1)
                        {
                            //Get all the data
                            $row = mysqli_fetch_assoc($res);

                            $title = $row['title'];
                            $current_image = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                        }
                        else
                        {
                            //Redirect to Manage Category with session Message
                            $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                            header('location:'.SITEURL."admin/manage-category.php");
                        }
                    }
                    else
                    {
                        //Redirect to Manage Category
                        header('location:'.SITEURL."admin/manage-category.php");
                    }
                ?>

                <form action="" method="post" enctype="multipart/form-data">

                    <table class="tbl-30">
                        <tr>
                            <td>Title: </td>
                            <td>
                                <input type="text" name="title" Value="<?php echo $title; ?>">;
                            </td>
                        </tr>
                        <tr>
                            <td>Current Image: </td>
                            <td>
                                <?php 
                                if($current_image != "")
                                {
                                    //Display the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image ;?>" alt="" width="150px">
                                    <?php
                                }
                                else
                                {
                                    //Display Message
                                    echo "<div class='error'>Image Not Added.</div>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>New Image: </td>
                            <td>
                                <input type="file" name="image" >
                            </td>
                        </tr>
                        <tr>
                            <td>Featured: </td>
                            <td>
                                <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name ="featured" value="Yes"> Yes

                                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name ="featured" value="No"> No
                            </td>
                        </tr>
                        <tr>
                            <td>Active: </td>
                            <td>
                                <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name ="active" value="Yes"> Yes

                                <input <?php if($active=="No"){echo "checked";} ?> type="radio" name ="active" value="No"> No
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                            </td>
                            
                        </tr>
                    </table>

                </form>

                <?php
                    if(isset($_POST['submit']))
                    {
                        //echo "Clicked";
                        // 2.Get the values from our form

                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $current_image = $_POST['current_image'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];

                        //2. Updating New Image if selected
                        //Check Whether the image is select or not
                        if(isset($_FILES['image']['name']))
                        {
                            //Get the image details
                            $image_name = $_FILES['image']['name'];

                            //Check whether image is available or not
                            if($image_name != "")
                            {
                                    //Image Available
                                    // A. Upload the new image

                                    // Auto Rename our image
                                 //Get the Extension of our image (jpg,png,gif, etc)e.g "specia.food1.jpg"
                                $ext = end(explode('.',$image_name));

                                //Rename the image
                                $image_name = "Food_category_".rand(000,9999).'.'.$ext; //e.g.Food category_834.jpg
                                
                                $source_path = $_FILES['image']['tmp_name'];

                                $destination_path = "../images/category/".$image_name ;

                                //Finally upload the Image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //Check whether image is uploaded or not
                                //And if the image is not uploaded then we will stop the process and redirect with error message
                                if($upload==false)
                                {
                                    // Set Message 
                                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                                    //Redirect to Add category page
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    //Stop process
                                    die();
                                }

                                // B. Remove the current image if Available
                                if($current_image != "")
                                {
                                    $remove_path = "../images/category/".$current_image;
                                    $remove = unlink($remove_path);

                                    //Check whether  the Image is removed or not
                                    //if Failed to remove then display message and stop the process
                                    if($remove==false)
                                    {
                                        //Failed to remove  image 
                                        $_SESSION['failed-remove'] = '<div class="error">Failed To Remove Current Image.</div>';
                                        header('location:'.SITEURL."admin/manage-category.php");
                                        die(); //Stop the process
                                    }
                                }
                                

                            }
                            else
                            {
                                
                                $image_name = $current_image;
                            }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }

                        //3. Update the Database
                        $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                        ";

                        //Execute the Query
                        $res2 = mysqli_query($conn, $sql2);

                        //4. Redirect to Manage Category Message
                        //Check whether execute or not
                        if($res2==true)
                        {
                            //Cetegory Updated
                            $_SESSION['update'] = '<div class="success"> Category Updated Successfully</div>';
                            header('location:'.SITEURL."admin/Manage-category.php");
                        }
                        else
                        {
                            //Failed to Update Category
                            $_SESSION['update'] = '<div class="error"> Failed To Update Category.</div>';
                            header('location:'.SITEURL."admin/Manage-category.php");
                        }


                    }
                ?>

            </div>
        </div>

    <?php include('partials/footer.php');?>

    