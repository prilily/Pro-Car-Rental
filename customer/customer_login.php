<?php include 'inc/header.php'; ?>

<?php

//when login button is clicked
if (isset($_POST['customer_login'])) {
    $customer_email = filter_input(INPUT_POST, 'customer_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $customer_password = filter_input(INPUT_POST, 'customer_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $sql = "SELECT * from customers where email='$customer_email'";
    $result = mysqli_query($conn, $sql);
    $row_count = mysqli_num_rows($result);
    if ($row_count) {
        //check for hashed passwords
        $row_data = mysqli_fetch_assoc($result);
        $stored_hash_password = $row_data['password'];
        if (password_verify($customer_password, $stored_hash_password)) {
            //make a session variable and redirect booking or home page
            $car_id = $_GET['car_id'];
            if ($car_id) {
                $_SESSION['username'] = $customer_email;
                header("Location: book_car.php?car_id=$car_id");
            } else {
                $_SESSION['username'] = $customer_email;
                header('Location: ../index.php');
            }
        } else {
            echo "<script> alert('Invalid Credentials.') </script>";
        }
    } else {
        //user doesnt exist or invalid credentials
        echo "<script> alert('Email Address cannott be found. Please Register.') </script>";
    }
}

?>

<div class="container-fluid m-3 ">
    <h2 class="text-center">User Login</h2>
    <div class="row">
        <div class="lg-12 col-x1-6">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-outline form-outline mt-4 mb-2 w-50 m-auto">
                    <!-- customer email -->
                    <label for="customer_email" class="form-label"> Email Address</label>
                    <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="Enter your Email" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- customer password -->
                    <label for="customer_password" class="form-label"> Password</label>
                    <input type="password" id="customer_password" name="customer_password" class="form-control" placeholder="Enter your Password" required="required">
                </div>


                <div class="form-outline form-outline mt-2 m-auto text-center">
                    <!-- customer submit button -->
                    <input type="submit" id="customer_login" name="customer_login" class="btn btn-dark mb-2 mt-2 p-2 " value="Login">
                    <p class="small  p-1">Don't have an account? <a href="registration.php">Register</a></p>
                </div>

            </form>
        </div>
    </div>
</div>



<?php include 'inc/footer.php' ?>