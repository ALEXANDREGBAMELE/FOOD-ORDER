<?php 
//include constants file
include('../config/constants.php');
   // echo "The delete page"
   //Check whether the id and image_name value is set or not
   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {
    //Get the value delete
    //echo "Get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical image file is available
    if($image_name != "")
    {
        //Image is available . So to Remove it
        $Path = "../images/category/".$image_name ;
        //Remove the image
        $remove = unlink($Path);

        //If Failed to remove image then add and error message  and stop the process
        if($remove==false)
        {
            //Set the session Message
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
            //Redirect to Manage category
            header('location:'.SITEURL."admin/manage-category.php");

            //stop the process
            die();
        }
    }
    //Delete Data from Database
    //Sql query to delete data from database

    $sql = "DELETE FROM tbl_category WHERE id =$id ";

    //Execute the query 
    $res = mysqli_query($conn,$sql);
    //Check whether the data is deleted from databasse or no
    if($res==true)
    {
        //Set success message and rediirect
        $_SESSION['delete'] = '<div class="success"> Category Deleted Successfully.</div>';
        //Redirect to Manage category page
        header('location:'.SITEURL."admin/manage-category.php");
    }   
    else
    {
        //Set error Message and redirect
        $_SESSION['delete'] = '<div class="error"> Failed to Delete Category.</div>';
        //Redirect to Manage category page
        header('location:'.SITEURL."admin/manage-category.php");
    }

    //Redirect to the Manage category Page whith message


   }
   else
   {

    //Redirect to manage category page
    header('location:'.SITEURL."admin/manage-category.php");

   }
?>