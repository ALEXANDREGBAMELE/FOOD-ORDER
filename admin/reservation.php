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
                        $res = mysqli_query($conn,$sql);

                        //Count the rows to check whether the id is valid or not
                        $count = mysqli_num_rows($res);

                        if($count==1)
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
                            $_SESSION['no-category-found'] = '<div class="error">Category Not Found.</div>';
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
                                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                            </td>
                            
                        </tr>
                    </table>

                </form>

                <?php
                    if(isset($_POST['Submit']))
                    {
                        echo "Clicked";
                    }
                ?>

            </div>
        </div>

    <?php include('partials/footer.php');?>

    