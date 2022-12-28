<?php
    //include constants page
    include('../config/constants.php');


    //echo "Delete page is here !";
    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND
    {
        //Process to Delete
        //echo  "Process to Delete";

        //1. Get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //2. Remove image mname if 
        //check whether the image is available or not Delete only if available
        if($image_name != "")
        {
            //It has image and need to remove from folder
            //Get the image path
            $path = "../images/food/".$image_name ;

            //Remove Image file  from folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = '<div class="error">Failed to remove image file</div>';
                //Redirect to Manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process of deleting food
                die();
            }
        }

        //3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute query
        $res = mysqli_query($conn, $sql);
        //Check whether the query bexecuted or not and set the session message respectively

        //4. Redirect Manage food with session message
        if($res==true)
        {
            //Food deleted
            //Failed to delete food
            $_SESSION['delete'] = '<div class="success">Food deleted successfully.</div>';
            header('location:'.SITEURL.'admin/manage-food.php');

            
        }
        else
        {
            
            $_SESSION['delete'] = '<div class="error">Failed to delete food.</div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        

    }
    else
    {
        //Redirect to Manage Food Page
        //echo "Redirect";
        $_SESSION['Unauthorized']= '<div class="error">Unauthorized Acces.</div>';
        header('location:'.SITEURL.'admin/manage-food.php');
    }
 ?>