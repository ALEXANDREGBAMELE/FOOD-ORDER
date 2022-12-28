<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">-
        <h1>Update Order </h1>
        <br><br>
        <?php
        //Check whether id set or not
        if (isset($_GET['id'])) {
            //Get the Order Details
            $id = $_GET['id'];
            //Get all details based this id
            //SQL Query to get the order  details
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            //Execute Query 
            $res = mysqli_query($conn, $sql);
            //count Rows
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //Detail Available
                $row = mysqli_fetch_row($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_adress = $row['customer_adress'];
            } else {
                //Detail not available*
                //Redirect to Manage Order
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        } else {
            //Redirect to manage order page
            header('location:' . SITEURL . 'admin/manage-order.php');
        }
        ?>
        <form action="#" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b> $ <?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<b><?php echo $qty; ?></b>"></td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == "On Delivery") {
                                        echo "selected";
                                    } ?> value="On Delivery">On Delivery</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered">Delivery</option>
                            <option <?php if ($status == "Cancelled") {
                                        echo "selected";
                                    } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Adress:</td>
                    <td>
                        <textarea name="customer_adress" cols="30" rows="5"><?php echo $customer_adress; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //check whether Update Button is clicked or not
        if (isset($_POST['submit'])) {
            //echo "check";
            //Get All the Values from form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $status = $_POST['status'];

            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_adress = $_POST['customer_adress'];

            //Update the values
            $sql2 = "UPDATE tbl_order SET
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_adress = '$customer_adress'
                WHERE id = $id
             ";
            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            // check whether update or not 
            //And redirect to Manage order with Message
            if ($res2 == true) {
                $_SESSION['update'] = '<div class="success"> Order Updated successfully.</div>';
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                //Failed to update
                $_SESSION['update'] = '<div class="error">Failed to Order Update.</div>';
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        }
        ?>

    </div>
</div>
<?php include('partials/menu.php'); ?>