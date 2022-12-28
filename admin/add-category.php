<?php include('partials/menu.php') ;?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
            <!--Add Category Form Start-->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title : </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image : </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured : </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active : </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="20">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!--Add Category Form Ends-->

            <?php
                // Check whether the Submit utton is clicked or Not 
                if(isset($_POST['submit']))
                {
                    //echo "Button is clicked !";

                    //1. Get the Value from Category Form
                    $title = $_POST['title'];

                    //For Radio input, we need to check whether the Button is selected or not
                    if(isset($_POST['featured']))
                    {
                        //Get the value from form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        //Set the default value
                        
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        //Get the value from form
                        $active = $_POST['active'];
                    }
                    else
                    {
                        //Set the default value
                        
                        $active = "No";
                    }

                    //Check whether the image is select or not and set the value for image name accoridingly
                    //print_r($_FILES['image']);

                    //die(); // Break the code here

                    if(isset($_FILES['image']['name']))
                    {
                        //Upload the image
                        //To upload image we need image name , source  path and destination path
                        $image_name = $_FILES['image']['name'];

                        //Upload the Image only if image is selected
                        if($image_name != "")

                        {
                                // Auto Rename our image
                            //Get the Extension of our image (jpg,png,gif, etc)e.g "specia.food1.jpg"
                            $ext = end(explode('.',$image_name));

                            //Rename the image
                            $image_name = "Food_category_".rand(0000,9999).'.'.$ext; //e.g.Food category_834.jpg
                            
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
                                header('location:'.SITEURL.'admin/add-category.php');
                                //Stop process
                                die();
                            }
                        }

                       
                    }
                    else
                    {
                        //Don't upload image and set image_name value as blank
                        $image_name = "";// 0565793885 M Konate
                    }

                    // 2. Create SQL Query to insert Category into Database
                    $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

                    // 3. Execute Query and Save in Database
                    $res = mysqli_query($conn, $sql);

                    // 4. Check whether the query executed or not and data added or not
                    if($res==true)
                    {
                        //Query executed and Category Added
                        $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                        // Redirect Category Page
                        header('location:'.SITEURL."admin/manage-category.php");
                    }
                    else
                    {
                        //Failed to Add Category
                        $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                        // Redirect Category Page
                        header('location:'.SITEURL."admin/manage-category.php");
                    }
                }
            ?>

        </div>
    </div>
<?php include('partials/footer.php') ;?>