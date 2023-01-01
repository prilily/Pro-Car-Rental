<?php include 'inc/header.php'; ?>


<?php
//Adding customer into database,pwd is hashed, check if email already exist or  not

if (isset($_POST['customer_register'])) {
    //filter input data for security
    $customer_name = filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $customer_email = filter_input(INPUT_POST, 'customer_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $customer_password = filter_input(INPUT_POST, 'customer_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $customer_confirm_password = filter_input(INPUT_POST, 'customer_confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $customer_mobile_number = filter_input(INPUT_POST, 'customer_mobile_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $customer_address = filter_input(INPUT_POST, 'customer_address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $customer_license_no = filter_input(INPUT_POST, 'customer_license_no', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($customer_name == '' or $customer_email == '' or $customer_password == '' or $customer_confirm_password == '' or $customer_mobile_number == '' or $customer_address == '' or  $customer_license_no == '') {
        echo "<script> alert('Please fill all the fields') </script>";
    } else {
        //see if email already exists
        $select_email = "SELECT * from customers where email='$customer_email'";
        $result = mysqli_query($conn, $select_email);
        $row_count = mysqli_fetch_row($result);
        if ($row_count) {
            //user already exists
            echo "<script> alert('User email already exists!') </script><br><br>";
        } else if ($customer_password != $customer_confirm_password) {
            //passwords donot match
            echo "<script> alert('Passwords do not match!') </script><br><br>";
        } else {
            //hash the password
            $hash_password = password_hash($customer_password, PASSWORD_DEFAULT);
            $sql = "INSERT into customers(name,email,password,mobile_no,address,license_number,ip_address) values('$customer_name','$customer_email','$hash_password','$customer_mobile_number','$customer_address','$customer_license_no','$customer_ip_address');";

            try {
                $result = mysqli_query($conn, $sql);
                //create a session variable here
                $_SESSION['username'] = $customer_email;
                //redirect to other page as header('Location: index.php');
                header('Location: ../index.php');
            } catch (Exception $e) {
                echo $e->getMessage();

                echo "<script> alert('Failed to insert data') </script><br><br>";
            }
        }
    }
}


?>



<div class="container-fluid m-3">
    <h2 class="text-center">New Registration</h2>
    <div class="row">
        <div class="lg-12 col-x1-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-outline form-outline mt-4 mb-2 w-50 m-auto">
                    <!-- customer name -->
                    <label for="customer_name" class="form-label"> Name</label>
                    <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Enter your Name" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer email -->
                    <label for="customer_email" class="form-label"> Email Address</label>
                    <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="Enter your Email" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer password -->
                    <label for="customer_password" class="form-label"> Password</label>
                    <input type="password" id="customer_password" name="customer_password" class="form-control" placeholder="Enter your Password" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer confirm password -->
                    <label for="customer_confirm_password" class="form-label"> Confirm Password</label>
                    <input type="password" id="customer_confirm_password" name="customer_confirm_password" class="form-control" placeholder="Enter your Password" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer mobile-no -->
                    <label for="customer_mobile_number" class="form-label"> Mobile Number</label>
                    <input type="text" id="customer_mobile_number" name="customer_mobile_number" class="form-control" placeholder="Enter your Mobile number" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer address -->
                    <label for="customer_address" class="form-label"> Address</label>
                    <input type="text" id="customer_address" name="customer_address" class="form-control" placeholder="Enter your Address" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer license-number -->
                    <label for="customer_license_no" class="form-label">License Number</label>
                    <input type="text" id="customer_license_no" name="customer_license_no" class="form-control" placeholder="Enter your License Number" required="required">
                </div>

                <div class="form-outline form-outline mt-2 m-auto text-center">
                    <!-- customer submit button -->
                    <input type="submit" id="customer_register" name="customer_register" class="btn btn-dark mb-2 mt-2 p-2 " value="Register">
                    <p class="small  p-1">Already have an account? <a href="customer_login.php">Log in</a></p>
                </div>

            </form>
        </div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>