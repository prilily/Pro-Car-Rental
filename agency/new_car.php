<?php include 'inc/header.php';
?>
<?php
if(isset($_SESSION['agency_username'])){
    // fetch page when agency is logged in
    if(isset($_POST['insert_car'])){
        $car_model=filter_input(INPUT_POST,'car_model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_company=filter_input(INPUT_POST,'car_company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_number=filter_input(INPUT_POST,'car_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_capacity=filter_input(INPUT_POST,'car_capacity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_rent_per_day=filter_input(INPUT_POST,'car_rent_per_day', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_description=filter_input(INPUT_POST,'car_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $car_features=filter_input(INPUT_POST,'car_features', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        //change this later for admin
        $agency_email=$_SESSION['agency_username'];
        //get agency id from email
        $agency_sql="SELECT agency_id from car_rental_agencies where email='$agency_email'";
        $agency_result=mysqli_query($conn,$agency_sql);
        $agency_row=mysqli_fetch_assoc($agency_result);
        $agency_id=$agency_row['agency_id'];


        //accessing images using tempnames
        $car_image=$_FILES['car_image1']['name'];
        $temp_car_image=$_FILES['car_image1']['tmp_name'];


        //check for empty fields 
        if($car_model=='' or $car_company='' or $car_number=='' or $car_capacity==''
            or $car_rent_per_day=='' or $car_description=='' or $car_features=='' or $car_image==''){
                echo "<script> alert('Please fill all the fields') </script>";
        }else{

                move_uploaded_file($temp_car_image,"../images/$car_image");
                
                //get file info of image
                $filename=basename($_FILES['car_image1']['name']);
                $filetype=pathinfo($filename,PATHINFO_EXTENSION);

                //allowed-image types
                $allowed_ext=array("jpg","png","jpeg","gif");
                if(in_array($filetype,$allowed_ext)){

                    //sql insert query
                    $sql="INSERT INTO cars(company,model,vehicle_number,seating_capacity,rent_per_day,description,features,agency_id,car_image,date) VALUES ('$car_company','$car_model','$car_number','$car_capacity','$car_rent_per_day','$car_description','$car_features',$agency_id,'$car_image',NOW())";
                    
                    try{
                        $result=mysqli_query($conn,$sql);
                        echo" <div class='alert alert-success mx-10' role='alert'>
                        <h4 class='alert-heading'>Car added Successfuly!</h4>
                        <p> Your rental for details $car_model has been recieved.</p>  
                        <hr>
                        <p>Thank you for choosing our services.</p>";
                        echo'<input type="submit" name="book_car" class="btn btn-dark" value="View Car Listing" onclick="location.href =\'car_list.php\'" >';
                    echo"</div>";
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

<div class="container bg-light mt-4 mb-3 p-2">
    <h2 class="text-center mt-4"><i class="fa-solid fa-car"></i>  New Car Form</h2>
    <!-- form -->
    <form action="" method="POST" enctype="multipart/form-data" >
        <div class="form-outline mt-4 mb-2 w-50 m-auto" >
            <!-- car model -->
            <label for="car_model" class="form-label">Car Model</label>
            <input type="text" name="car_model" id="car_model" class="form-control" placeholder="Enter car model" autocomplete="off" required="required">
        </div>    
        <div class="form-outline mb-2 w-50 m-auto" >
            <!-- vehicle company -->
            <label for="car_company" class="form-label">Car Company</label>
            <input type="text" name="car_company" id="car_company" class="form-control" placeholder="Enter car company" autocomplete="off" required="required">
        </div>  

        <div class="form-outline mb-2 w-50 m-auto" >    
            <!-- vehicle number -->
            <label for="car_number" class="form-label">Car Number</label>
            <input type="text" name="car_number" id="car_number" class="form-control" placeholder="Enter car number" autocomplete="off" required="required">
        </div>  
          
        <div class="form-outline mb-2 w-50 m-auto" >    

            <!-- vehicle seating capacity -->
            <label for="car_capacity" class="form-label">Seating Capacity</label>
            <input type="text" name="car_capacity" id="car_capacity" class="form-control" placeholder="Enter seating capacity" autocomplete="off" required="required">
        </div>  
          
        <div class="form-outline mb-2 w-50 m-auto" >       
            <!-- vehicle rent per day -->
            <label for="car_rent_per_day" class="form-label"> Rent Per Day</label>
            <input type="text" name="car_rent_per_day" id="car_rent_per_day" class="form-control" placeholder="Enter rent per day" autocomplete="off" required="required">
        </div>  
          
        <div class="form-outline mb-2 w-50 m-auto" >        
            <!-- vehicle description -->
            <label for="car_description" class="form-label">Car Description</label>
            <input type="text" name="car_description" id="car_description" class="form-control" placeholder="Enter car description" autocomplete="off" required="required">
        </div>  
          
        <div class="form-outline mb-2 w-50 m-auto" >       
            <!-- vehicle features -->
            <label for="car_features" class="form-label">Car Features</label>
            <input type="text" name="car_features" id="car_features" class="form-control" placeholder="Enter car features - Central Locking, AC" autocomplete="off" required="required">
        </div>  
          
        <div class="form-outline mb-2 w-50 m-auto" >       
            <!-- vehicle image1 -->
            <label for="car_image1" class="form-label">Car Picture</label>
            <input type="file" name="car_image1" id="car_image1" class="form-control" required="required">
        </div>  
                    
        <div class="form-outline mb-2 w-50 m-auto text-center" >       
            <!-- submit button -->
            <input type="submit" name="insert_car" class="btn btn-dark mb-4 p-2" value="Add new Car">
        </div>  
          
        </div>
    </form>
</div>


<?php include 'inc/footer.php';?>
