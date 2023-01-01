<?php include'inc/header.php'; ?>

<?php
    if(isset($_SESSION['agency_username'])){
        $agency_email= $_SESSION['agency_username'];
        //fetch details of user from database
        global $conn;
        $sql="SELECT * from `car_rental_agencies` where email='$agency_email'; ";
        try{
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $agency_id=$row['agency_id'];
            $agency_name=$row['name'];
            $agency_mobile_number=$row['mobile'];
            $agency_address=$row['address'];
            $agency_license_no=$row['license_no'];         
            

        }catch(Exception $e){
            echo $e->getMessage();
            echo "<script> alert('Failed to get data') </script><br><br>";
        }

        }
        else{
            header('Location: ../index.php');
        }

        //update user details
        if(isset($_POST['update_details'])){
            $agency_name=filter_input(INPUT_POST,'agency_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $updated_agency_email=filter_input(INPUT_POST,'agency_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $agency_mobile_number=filter_input(INPUT_POST,'agency_mobile_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $agency_address=filter_input(INPUT_POST,'agency_address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $agency_license_no=filter_input(INPUT_POST,'agency_license_no', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
    
            if($agency_name=='' or $updated_agency_email=='' or $agency_mobile_number=='' or $agency_address=='' or  $agency_license_no==''){
                echo "<script> alert('Please fill all the fields') </script>";
            }else{           
    
                //see if email already exists
                if($updated_agency_email!=$agency_email){
                    $select_email="SELECT * from car_rental_agencies where email='$updated_agency_email'";
                    $result=mysqli_query($conn,$select_email);
                    $row_count=mysqli_fetch_row($result);
                    if($row_count){
                        //user already exists
                        echo "<script> alert('User email already exists!') </script><br><br>";
                    }else{
                            $sql="UPDATE car_rental_agencies set name='$agency_name',email='$updated_agency_email',mobile='$agency_mobile_number',address='$agency_address',license_no='$agency_license_no' where email='$agency_email';";
                            try{
                                $result=mysqli_query($conn,$sql);
                                //create a session variable here
                                $_SESSION['username']=$updated_agency_email;
                            }
                            catch(Exception $e){
                                echo $e->getMessage();
                                echo "<script> alert('Failed to update data') </script><br><br>";
                            }
                    }
                }
                
                else{
                    $sql="UPDATE car_rental_agencies set name='$agency_name',email='$agency_email',mobile='$agency_mobile_number',address='$agency_address',license_no='$agency_license_no' where email='$agency_email';";
                
                    try{
                        $result=mysqli_query($conn,$sql);
                        //create a session variable here
                        $_SESSION['agency_username']=$updated_agency_email;
                        //redirect to other page as header('Location: index.php');
                    }
                    catch(Exception $e){
                        echo $e->getMessage();
                        echo "<script> alert('Failed to update data') </script><br><br>";
                    }
                }
                
            }
        }
?>
 
 <div class="container-fluid m-4">
 <h2 class="text-center">AGENCY DETAILS</h2>
    <div class="row">
        <div class="lg-12 col-x1-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-outline form-outline mt-4 mb-2 w-50 m-auto">
                    <!-- agency name -->
                    <label for="agency_name" class="form-label"> Name</label>
                    <input type="text"  id="agency_name" name="agency_name" class="form-control" value="<?php echo htmlspecialchars($agency_name) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency email -->
                    <label for="agency_email" class="form-label"> Email Address</label>
                    <input type="email"  id="agency_email" name="agency_email" class="form-control" value="<?php echo htmlspecialchars($agency_email) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency mobile-no -->
                    <label for="agency_mobile_number" class="form-label"> Mobile Number</label>
                    <input type="text"  id="agency_mobile_number" name="agency_mobile_number" class="form-control" value="<?php echo htmlspecialchars($agency_mobile_number) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency address -->
                    <label for="agency_address" class="form-label"> Address</label>
                    <input type="text"  id="agency_address" name="agency_address" class="form-control" value="<?php echo htmlspecialchars($agency_address) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 mb-2 w-50 m-auto">
                    <!-- agency license-number -->
                    <label for="agency_license_no" class="form-label">License Number</label>
                    <input type="text"  id="agency_license_no" name="agency_license_no" class="form-control" value="<?php echo htmlspecialchars($agency_license_no) ?>" required="required">
                </div>

                <div class="form-outline form-outline mt-2 m-auto text-center">
                    <!-- agency submit button -->
                    <input type="submit"  id="update_details" name="update_details" class="btn btn-dark mb-2 mt-2 p-2 " value="Update Details">
                </div>

            </form>
        </div>
    </div>
</div>



<?php include'inc/footer.php'; ?>