<?php include'inc/header.php'; ?>

<?php

    if(isset($_POST['agency_login'])){
        $agency_email=filter_input(INPUT_POST,'agency_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $agency_password=filter_input(INPUT_POST,'agency_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        
        $sql="SELECT * from car_rental_agencies where email='$agency_email'";
        $result=mysqli_query($conn,$sql);
        $row_count=mysqli_num_rows($result);
        if($row_count){
            //check for hashed passwords
            $row_data=mysqli_fetch_assoc($result);
            $stored_hash_password=$row_data['password'];
            if(password_verify($agency_password,$stored_hash_password)){
                //make a session variable
                    $_SESSION['agency_username']=$agency_email;
                    
                    header('Location: agency_index.php');
                
            }else{
                echo "<script> alert('Invalid Credentials. Passwords donnott match') </script>";
            }
        }
        else{
            //user doesnt exist or invalid credentials
            echo "<script> alert('Invalid Credentials. Email Address cannot be found.') </script>";
        }
    }

?>

<div class="container-fluid m-3 ">
    <h2 class="text-center">Agency Login</h2>
    <div class="row">
        <div class="lg-12 col-x1-6">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-outline form-outline mt-4 mb-2 w-50 m-auto">
                    <!-- agency email -->
                    <label for="agency_email" class="form-label"> Email Address</label>
                    <input type="email"  id="agency_email" name="agency_email" class="form-control" placeholder="Enter your Email" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency password -->
                    <label for="agency_password" class="form-label"> Password</label>
                    <input type="password"  id="agency_password" name="agency_password" class="form-control" placeholder="Enter your Password" required="required">
                </div>


                <div class="form-outline form-outline mt-2 m-auto text-center">
                    <!-- agency submit button -->
                    <input type="submit"  id="agency_login" name="agency_login" class="btn btn-dark mb-2 mt-2 p-2 " value="Login">
                    <p class="small  p-1">Don't have an account? <a href="agency_registration.php">Register</a></p>
                </div>

            </form>
        </div>
    </div>
</div>



<?php include 'inc/footer.php' ?>
