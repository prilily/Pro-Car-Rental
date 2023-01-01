<?php include 'inc/header.php';
?>

<?php
if(isset($_SESSION['agency_username'])){
   // get car_id here and other details when agency is logged in
    $car_id=$_GET['car_id'];
    global $conn;
    $sql="SELECT * from `cars` where car_id=$car_id; ";
    try{
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $car_id=$row['car_id'];
            $car_model=$row['model'];
            $car_company=$row['company'];
            $car_number=$row['vehicle_number'];
            $car_capacity=$row['seating_capacity'];
            $car_rent_per_day=$row['rent_per_day'];
            $car_description=$row['description'];
            $car_features=$row['features'];
            $car_img=$row['car_image'];
        }
        

    }catch(Exception $e){
        echo $e->getMessage();
        
        echo "<script> alert('Failed to fetch data') </script><br><br>";
    }

    //UPDATE VALUES TO DATABASE
    if(isset($_POST['update_car'])){
        //get new values and add to database again. check for image field, allow it to be empty
        $car_model=filter_input(INPUT_POST,'car_model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_company=filter_input(INPUT_POST,'car_company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_number=filter_input(INPUT_POST,'car_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_capacity=filter_input(INPUT_POST,'car_capacity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_rent_per_day=filter_input(INPUT_POST,'car_rent_per_day', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_description=filter_input(INPUT_POST,'car_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_features=filter_input(INPUT_POST,'car_features', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //change this later for admin
        $agency=1;

        //accessing images using tempnames
        $updated_car_image=$_FILES['car_image1']['name'];
        $temp_car_image=$_FILES['car_image1']['tmp_name'];

        //check for empty fields 
        if($car_model=='' or $car_company='' or $car_number=='' or $car_capacity==''
            or $car_rent_per_day=='' or $car_description=='' or $car_features==''){
                echo "<script> alert('Please fill all the fields') </script>";
        }else{
                //if new image is added then
                
                move_uploaded_file($temp_car_image,"../images/$updated_car_image");
                //get file info of image
                $filename=basename($_FILES['car_image1']['name']);
                $filetype=pathinfo($filename,PATHINFO_EXTENSION);

                //allowed-image types
                $allowed_ext=array("jpg","png","jpeg","gif");
                if($updated_car_image=='' or in_array($filetype,$allowed_ext)){
                    //sql insert query
                    $sql= "UPDATE cars SET model='$car_model',company='$car_company',vehicle_number='$car_number',seating_capacity='$car_capacity',rent_per_day='$car_rent_per_day' ,description='$car_description',features='$car_features', car_image='$car_img'  where car_id=$car_id";                    
                    try{
                        $result=mysqli_query($conn,$sql);
                        header('Location:car_list.php');
                    }
                    catch(Exception $e){
                        echo $e->getMessage(); 
                        echo "<script> alert('Failed to insert data') </script><br><br>";
                    }
                    
                }else{
                    echo "<script> alert('Allowed image formats are JPG,JPEG,PNG and GIF only') </script>";
                }                
        }
    }
}else {
        //if page is accessed without user logged in.
        header('Location: ../index.php');
    }
?>

<!-- second child -->

<div class="row px-1" >
    <div class="col-md-1"></div>
        <div class="col-md-3">
            <!-- car listings -->
            <div class="row">
                <!--car detail card-->
                <?php 
                    getCarDetail($car_id);
                ?>

            </div>
        </div>
        <div class="col-md-8">
            <!-- edit car details card as a form -->
            <div class="container bg-light mb-2 p-2">
                <h2 class="text-center mt-4"><i class="fa-solid fa-car"></i>  <?php echo $car_model ?> Details</h2>
                <!-- form -->
                <form action="" method="POST" enctype="multipart/form-data" >
                    <div class="form-outline mt-3 mb-3 w-50 m-auto" >
                        <!-- car model -->
                        <label for="car_model" class="form-label">Car Model</label>
                        <input type="text" name="car_model" id="car_model" class="form-control" value="<?php echo htmlspecialchars($car_model) ?>" autocomplete="off" required="required">
                    </div>    
                    <div class="form-outline mb-2 w-50 m-auto" >
                        <!-- vehicle company -->
                        <label for="car_company" class="form-label">Car Company</label>
                        <input type="text" name="car_company" id="car_company" class="form-control" value="<?php echo $car_company ?>" autocomplete="off" required="required">
                    </div>  

                    <div class="form-outline mb-2 w-50 m-auto" >    
                        <!-- vehicle number -->
                        <label for="car_number" class="form-label">Car Number</label>
                        <input type="text" name="car_number" id="car_number" class="form-control" value="<?php echo $car_number ?>" autocomplete="off" required="required">
                    </div>  
                    
                    <div class="form-outline mb-2 w-50 m-auto" >    

                        <!-- vehicle seating capacity -->
                        <label for="car_capacity" class="form-label">Seating Capacity</label>
                        <input type="text" name="car_capacity" id="car_capacity" class="form-control" value="<?php echo $car_capacity ?>" autocomplete="off" required="required">
                    </div>  
                    
                    <div class="form-outline mb-2 w-50 m-auto" >       
                        <!-- vehicle rent per day -->
                        <label for="car_rent_per_day" class="form-label"> Rent Per Day</label>
                        <input type="text" name="car_rent_per_day" id="car_rent_per_day" class="form-control" value="<?php echo $car_rent_per_day ?>" autocomplete="off" required="required">
                    </div>  
                    
                    <div class="form-outline mb-2 w-50 m-auto" >        
                        <!-- vehicle description -->
                        <label for="car_description" class="form-label">Car Description</label>
                        <input type="text" name="car_description" id="car_description" class="form-control" value="<?php echo $car_description ?>" autocomplete="off" required="required">
                    </div>  
                    
                    <div class="form-outline mb-2 w-50 m-auto" >       
                        <!-- vehicle features -->
                        <label for="car_features" class="form-label">Car Features</label>
                        <input type="text" name="car_features" id="car_features" class="form-control" value="<?php echo $car_features ?>" autocomplete="off" required="required">
                    </div>  
                    
                    <div class="form-outline mb-2 w-50 m-auto" >       
                        <!-- vehicle image1 -->
                        <label for="car_image1" class="form-label">Car Picture</label>
                        <input type="file" name="car_image1" id="car_image1" class="form-control">
                    </div>  
                                
                    <div class="form-outline mb-2 w-50 m-auto text-center" >       
                        <!-- submit button -->
                        <input type="submit" name="update_car" class="btn btn-dark mb-4 p-2" value="Update Details">
                    </div>  
                    
                    </div>
                </form>
            </div>
            
        </div>
</div>





<?php include 'inc/footer.php';?>


