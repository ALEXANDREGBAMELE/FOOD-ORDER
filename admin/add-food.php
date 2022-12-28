<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php 

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <form action="" method="post"  enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Descrition: </td>
                    <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                        <?php
                            //Create php codeto display category from Database
                            //1. Create Sql to get all active categories from Database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

                            //Execute the query
                            $res = mysqli_query($conn, $sql);

                            //Count rows to check whether we have category or not
                            $count = mysqli_num_rows($res);

                            //If coount is greater than zero , we have categories

                            if($count>0)
                            {
                                //We have Categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    // get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                        <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //We do not have categories
                                ?>
                                    <option value="0">No Category Found</option>
                                <?php
                            }

                            //2.Display on Drpopdown
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="" value="">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

                
            </table>
        </form>
        <?php
            //Check whether the button is clicked
            if(isset($_POST['submit']))
            {
                //Add Food in Database
                //echo "Clicked";

                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Check Whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; // setting the default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; // setting the default value
                }
                //2. Upload the image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is select
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of selected image
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image selected or not and upload image only if selected
                    if($image_name != "")
                    {
                        //Image is selected
                        //A. Rename the Image 
                        //Get the extension of selected image (jpg, png, gif, etc..) Ex: "AlexDev.jpg"
                        $ext = end(explode('.',$image_name));

                        //Create new name for image
                        $image_name = "Food_Name_".rand(0000,9999).".".$ext;// new Image Name be "Food-Name-657.jpg"

                        //. Upload the image
                        //Get the src Path and destination path

                        // Source path is the current location of the image 
                        $src = $_FILES['image']['tmp_name'];

                        //Destination path for the image be upload
                        $dst = "../images/food/".$image_name;
                         //Finally upload the food image
                         $upload = move_uploaded_file($src, $dst);

                         //Check whether image upload or not
                         if($upload==false)
                         {
                            //Failed to upload the image
                            //Redirect to add food page width error message
                            $_SESSION['upload'] = '<div class="error">Failed to upload image.</div>';
                            header('location:'.SITEURL."admin/add-food.php");
                            //Stop process
                            die();
                         }

                    }
                }
                else
                {
                    $image_name =""; //setting default value as blank
                }

                //3. Insert into Database

                //Create a SQL to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_food SET 
                title = '$title',
                description ='$description',
                price = '$price',
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirect with message to manage food
                //Check whether data inserted or not
                if($res2==true)
                {
                    //Data inserted Successfully
                    $_SESSION['add'] = '<div class="success">Food Added Successfully.</div>';
                    header('location:'.SITEURL."admin/manage-food.php");
                }
                else
                {
                    //Failed to insert Data
                    $_SESSION['add'] = '<div class="error">Failed to add food.</div>';
                    header('location:'.SITEURL."admin/manage-food.php");
                }
                
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>