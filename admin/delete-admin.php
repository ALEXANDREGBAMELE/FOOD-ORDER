<?php
    // include constants.php file here
    include('../config/constants.php');
    // 1. Get the Id of Admin to be deleted
        $id = $_GET['id'];
    // 2.Create SQL Query to delete Admin
        $sql = "DELETE FROM tbl_admin WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn, $sql);
        //Check whether the query successfully or not
        if($res==true)
        {
            //Query Executed successfully and Admin deleted
            //echo "Admin Deleted";
            //Create session variable to display message
            $_SESSION['delete'] = " <div class='success'>Admin Deleted Successfully</div> ";
            //Redirect to message Admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Fail to Delete Admin
            //echo "Failled to Dellete Add";
            //Create session variable to display message
            $_SESSION['delete'] = "<div class='error'>Failed to delete Admin</div>";
            //Redirect to message Admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

        

    // 3.Redirect to Manage Admin page with message(success/error)
?>