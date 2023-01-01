<?php include'inc/header.php'; ?>


<?php
//Adding user into database,pwd is hashed, user already exist or  not
    
    if(isset($_POST['agency_register'])){
        //if not logged in as agency redirect to home page
        $agency_name=filter_input(INPUT_POST,'agency_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $agency_email=filter_input(INPUT_POST,'agency_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $agency_password=filter_input(INPUT_POST,'agency_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $agency_confirm_password=filter_input(INPUT_POST,'agency_confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $agency_mobile_number=filter_input(INPUT_POST,'agency_mobile_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $agency_address=filter_input(INPUT_POST,'agency_address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $agency_license_no=filter_input(INPUT_POST,'agency_license_no', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        

        if($agency_name=='' or $agency_email=='' or $agency_password=='' or $agency_confirm_password=='' or $agency_mobile_number=='' or $agency_address=='' or  $agency_license_no==''){
            echo "<script> alert('Please fill all the fields') </script>";
        }else{           

            //see if email already exists
            $select_email="SELECT * from car_rental_agencies where email='$agency_email'";
            $result=mysqli_query($conn,$select_email);
            $row_count=mysqli_fetch_row($result);
            if($row_count){
                //user already exists
                echo "<script> alert('Agency email already exists!') </script><br><br>";
            }
            else if($agency_password!=$agency_confirm_password){
                //passwords donot match
                echo "<script> alert('Passwords donot match!') </script><br><br>";
            }
            else{
                //hash the password
                $hash_password=password_hash($agency_password,PASSWORD_DEFAULT);  
                $sql="INSERT into car_rental_agencies(name,email,password,mobile,address,license_no) values('$agency_name','$agency_email','$hash_password','$agency_mobile_number','$agency_address','$agency_license_no');";
            
                try{
                    $result=mysqli_query($conn,$sql);
                    //create a session variable here
                    $_SESSION['agency_username']=$agency_email;
                    //redirect to other page as header('Location: index.php');
                    header('Location: agency_index.php');
                }
                catch(Exception $e){
                    echo $e->getMessage();
                    echo "<script> alert('Failed to insert data') </script><br><br>";
                }
            }
            
        }
    }


?>



<div class="container-fluid m-3">
    <h2 class="text-center">Agency Registration</h2>
    <div class="row">
        <div class="lg-12 col-x1-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-outline form-outline mt-4 mb-2 w-50 m-auto">
                    <!-- agency name -->
                    <label for="agency_name" class="form-label"> Name</label>
                    <input type="text"  id="agency_name" name="agency_name" class="form-control" placeholder="Enter your Name" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency email -->
                    <label for="agency_email" class="form-label"> Email Address</label>
                    <input type="email"  id="agency_email" name="agency_email" class="form-control" placeholder="Enter your Email" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency password -->
                    <label for="agency_password" class="form-label"> Password</label>
                    <input type="password"  id="agency_password" name="agency_password" class="form-control" placeholder="Enter your Password" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency confirm password -->
                    <label for="agency_confirm_password" class="form-label"> Confirm Password</label>
                    <input type="password"  id="agency_confirm_password" name="agency_confirm_password" class="form-control" placeholder="Enter your Password" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency mobile-no -->
                    <label for="agency_mobile_number" class="form-label"> Mobile Number</label>
                    <input type="text"  id="agency_mobile_number" name="agency_mobile_number" class="form-control" placeholder="Enter your Mobile number" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency address -->
                    <label for="agency_address" class="form-label"> Address</label>
                    <input type="text"  id="agency_address" name="agency_address" class="form-control" placeholder="Enter your Address" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency license-number -->
                    <label for="agency_license_no" class="form-label">License Number</label>
                    <input type="text"  id="agency_license_no" name="agency_license_no" class="form-control" placeholder="Enter your License Number" required="required">
                </div>

                <div class="form-outline form-outline mt-2 m-auto text-center">
                    <!-- agency submit button -->
                    <input type="submit"  id="agency_register" name="agency_register" class="btn btn-dark mb-2 mt-2 p-2 " value="Register">
                    <p class="small  p-1">Already have an account? <a href="agency_login.php">Log in</a></p>
                </div>

            </form>
        </div>
    </div>
</div>



<?php include'inc/footer.php'; ?>