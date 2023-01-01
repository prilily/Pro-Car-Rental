<?php include 'inc/header.php'; ?>

<?php
//user landing page after LOGIN
if (isset($_SESSION['username'])) {
    $customer_email = $_SESSION['username'];
    //fetch details of user from database
    global $conn;
    $sql = "SELECT * from `customers` where email='$customer_email'; ";
    try {
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['customer_id'];
        $customer_name = $row['name'];
        $customer_mobile_number = $row['mobile_no'];
        $customer_address = $row['address'];
        $customer_license_no = $row['license_number'];
    } catch (Exception $e) {
        echo $e->getMessage();

        echo "<script> alert('Failed to retrieve data') </script><br><br>";
    }

    //update user details- PROFILE
    if (isset($_POST['update_details'])) {
        $customer_name = filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $updated_customer_email = filter_input(INPUT_POST, 'customer_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $customer_mobile_number = filter_input(INPUT_POST, 'customer_mobile_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $customer_address = filter_input(INPUT_POST, 'customer_address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $customer_license_no = filter_input(INPUT_POST, 'customer_license_no', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        if ($customer_name == '' or $updated_customer_email == '' or $customer_mobile_number == '' or $customer_address == '' or  $customer_license_no == '') {
            echo "<script> alert('Please fill all the fields') </script>";
        } else {

            //see if updated email already exists as it is unique identifier
            if ($updated_customer_email != $customer_email) {
                $select_email = "SELECT * from customers where email='$updated_customer_email'";
                $result = mysqli_query($conn, $select_email);
                $row_count = mysqli_fetch_row($result);
                if ($row_count) {
                    //updated email already exists
                    echo "<script> alert('User email already exists!') </script><br><br>";
                } else {
                    $sql = "UPDATE customers set name='$customer_name',email='$updated_customer_email',mobile_no='$customer_mobile_number',address='$customer_address',license_number='$customer_license_no' where email='$customer_email';";
                    try {
                        $result = mysqli_query($conn, $sql);
                        //create a session variable here
                        $_SESSION['username'] = $updated_customer_email;
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        echo "<script> alert('Failed to insert data') </script><br><br>";
                    }
                }
            } else {
                //when email-id is not updated
                $sql = "UPDATE customers set name='$customer_name',email='$customer_email',mobile_no='$customer_mobile_number',address='$customer_address',license_number='$customer_license_no' where email='$customer_email';";
                try {
                    $result = mysqli_query($conn, $sql);
                    //create a session variable here
                    $_SESSION['username'] = $updated_customer_email;
                    //redirect to other page as header('Location: index.php');
                } catch (Exception $e) {
                    echo $e->getMessage();
                    echo "<script> alert('Failed to insert data') </script><br><br>";
                }
            }
        }
    }
} else {
    //if page is accessed without user logged in.
    header('Location: ../index.php');
}

?>

<div class="container-fluid m-3">
    <h2 class="text-center">USER DETAILS</h2>
    <div class="row">
        <div class="lg-12 col-x1-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-outline form-outline mt-4 mb-2 w-50 m-auto">
                    <!-- customer name -->
                    <label for="customer_name" class="form-label"> Name</label>
                    <input type="text" id="customer_name" name="customer_name" class="form-control" value="<?php echo htmlspecialchars($customer_name) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer email -->
                    <label for="customer_email" class="form-label"> Email Address</label>
                    <input type="email" id="customer_email" name="customer_email" class="form-control" value="<?php echo htmlspecialchars($customer_email) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer mobile-no -->
                    <label for="customer_mobile_number" class="form-label"> Mobile Number</label>
                    <input type="text" id="customer_mobile_number" name="customer_mobile_number" class="form-control" value="<?php echo htmlspecialchars($customer_mobile_number) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer address -->
                    <label for="customer_address" class="form-label"> Address</label>
                    <input type="text" id="customer_address" name="customer_address" class="form-control" value="<?php echo htmlspecialchars($customer_address) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer license-number -->
                    <label for="customer_license_no" class="form-label">License Number</label>
                    <input type="text" id="customer_license_no" name="customer_license_no" class="form-control" value="<?php echo htmlspecialchars($customer_license_no) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 m-auto text-center">
                    <!-- customer submit button -->
                    <input type="submit" id="update_details" name="update_details" class="btn btn-dark mb-2 mt-2 p-2 " value="Update Details">
                </div>

            </form>
        </div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>