<?php
include 'database.php';

/*
1. getIPAddress
2. getAllCars
3. getAgencyCars
4. getCarDetail
5. getCarBookings
6. getRentDetails
*/

//to get ip address and store session information here
function getIPAddress() {  

    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  

//to fetch all available cars available for rent
function getAllCars(){
    global $conn;
    $sql="SELECT * from `cars` order by rand();";
                    try{
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result)){
                            $car_id=$row['car_id'];
                            $car_model=$row['model'];
                            $car_company=$row['company'];
                            $car_capacity=$row['seating_capacity'];
                            $car_rent_per_day=$row['rent_per_day'];
                            $car_description=$row['description'];
                            $car_features=$row['features'];
                            $car_img=$row['car_image'];
                            $agency_id=$row['agency_id'];
                            $page = (isset($_SESSION['username']))? "customer/book_car.php?car_id=$car_id" :"customer/customer_login.php?car_id=$car_id";

                            //get car details
                            $agency_sql = "SELECT name from car_rental_agencies where agency_id=$agency_id";
                            $agency_result = mysqli_query($conn, $agency_sql);                
                            $agency_row = mysqli_fetch_assoc($agency_result);             
                            $agency_name = $agency_row['name'];

                            echo " <div class='col-md-4 mb-2'>
                            <div class='card-deck '>
                                    <div class='card text-center bg-light'>
                                    <img src='./images/$car_img' class='card-img-top p-2' height='230'>
                                    <div class='card-body'>
                                         <h5 class='card-title'>$car_company $car_model</h5>
                                            <p class='card-text'> $car_description</p>
                                            <p class='card-text'> <b>Features </b>: $car_features</p>
                                            <p class='card-text'> <b>Seating</b>  : $car_capacity </p>
                                            <p class='card-text'> <b>Rent per day </b>: $car_rent_per_day</p>
                                            <p class='card-text'> <b>Agency </b>: $agency_name</p>
                                            <a href=$page class='btn btn-primary'>Book Now</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>";

                                
                        }

                    }catch(Exception $e){
                        echo $e->getMessage();
                        
                        echo "<script> alert('Failed to fetch data.') </script><br><br>";
                    }
}

//to fetch all the available cars for rent for given agency
function getAgencyCars($agency_id){
    global $conn;
    $sql="SELECT * from `cars` where agency_id='$agency_id'; ";
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

                            


                            echo " <div class='col-md-4 mt-4 mb-2'>
                            <div class='card-deck'>
                                    <div class='card text-center bg-light'>
                                    <div class='embed-responsive embed-responsive-16by9'>
                                    <img src='../images/$car_img' class='card-img-top embed-responsive-item p-2' height='220'>
                                    <div class='card-body'>
                                         <h5 class='card-title'>$car_company $car_model</h5>
                                            <p class='card-text '> $car_description</p>
                                            <p class='card-text '> Features : $car_features</p>
                                            <p class='card-text'> Seating  : $car_capacity </p>
                                            <p class='card-text'> Rent per day : $car_rent_per_day</p>
                                            <a href='car_details.php?car_id=$car_id' class='btn btn-primary mt-2'>Edit Details</a>
                                            <a href='car_booking_details.php?car_id=$car_id' class='btn btn-primary mt-2'>View Bookings</a>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>";

                        }

                    }catch(Exception $e){
                        echo $e->getMessage();
                        
                        echo "<script> alert('Failed to fetch data') </script><br><br>";
                    }
}
// to fetch details of given car_id
function getCarDetail($car_id){
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


                            echo " 
                                    <div class='card-deck text-center bg-light' style='height=30rem'>
                                    <img src='../images/$car_img' class='card-img-top p-2 ' height='220'>
                                    <div class='card-body'>
                                         <h5 class='card-title'>$car_company $car_model</h5>
                                            <p class='card-text'> $car_description</p>
                                            <p class='card-text'> Features : $car_features</p>
                                            <p class='card-text'> Seating  : $car_capacity </p>
                                            <p class='card-text'> Rent per day : $car_rent_per_day</p>
                                            <p class='card-text'> Vehicle No : $car_number</p>
                                        </div>
                                    </div>
                                ";

                        }

                    }catch(Exception $e){
                        echo $e->getMessage();
                        
                        echo "<script> alert('Failed to fetch data') </script><br><br>";
    }
}

//to get all rent bookings for given car
function getCarBookings($car_id){
    if(isset($_SESSION['agency_username'])){
        $agency_email= $_SESSION['agency_username'];
        //fetch details of user from database
        global $conn;
        $sql="SELECT * from `car_rental_agencies` where email='$agency_email'; ";
        try{
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $agency_id=$row['agency_id'];
            $bookingg_sql="SELECT * from rentals where agency_id=$agency_id and car_id=$car_id";
            try{
                $result=mysqli_query($conn,$bookingg_sql);
                $count=1;
                echo"
                <div class='row px-1' >
                    <div class='col-md-1'></div>
                        <div class='col-md-3'>";
                         getCarDetail($car_id);
                        echo"</div>
                        <div class='col-md-6'>
                            <table class='table table-hover'>
                            <thead class='thead-dark'>
                            <tr>
                                <th scope='col'>S.No</th>
                                <th scope='col'>Booking Id</th>
                                <th scope='col'>Car Model</th>
                                <th scope='col'>Start Date</th>
                                <th scope='col'>End Date</th>
                                <th scope='col'>Total Cost</th>
                                <th scope='col'>Customer Name</th>
                                <th scope='col'>Customer Contact</th>
                                <th scope='col'>Status</th>
                            </tr>
                            </thead>
                            <tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    
                    $booking_id=$row['rental_id'];
                    $car_id=$row['car_id'];
                    $start_date=$row['start_date'];
                    $end_date=$row['end_date'];
                    $total_cost=$row['total_cost'];
                    $customer_id=$row['customer_id'];

                    //get customer details using customer_id
                    $customer_sql="SELECT name,mobile_no from customers where customer_id=$customer_id";
                    $customer_result=mysqli_query($conn,$customer_sql);
                    $customer_row=mysqli_fetch_assoc($customer_result);

                    $customer_name=$customer_row['name'];
                    $customer_mobile=$customer_row['mobile_no'];

                    $today= date("Y-m-d");
                    $status=($end_date<$today)? 'Completed':'Live';

                    //now display table row
                    echo"<tr>
                        <th scope='row'>$count</th>
                        <td>$booking_id</td>
                        <td>$car_id</td>
                        <td>$start_date</td>
                        <td>$end_date</td>
                        <td>$total_cost</td>
                        <td>$customer_name</td>
                        <td>$customer_mobile</td>
                        <td>$status</td>
                    </tr>";
                  $count++;
                }
                      
                echo"  </tbody>
                </table>
                </div><div class='col-md-1'> </div></div></div></div>";
    
            }catch(Exception $e){
                echo $e->getMessage();
                
                echo "<script> alert('Failed to get Booking data') </script><br><br>";
            }
            
            

        }catch(Exception $e){
            echo $e->getMessage();
            
            echo "<script> alert('Failed to retrieve data') </script><br><br>";
        }

        }
        else{
            header('Location: ../index.php');
        }
}

//to get booking detail of given rent_id
function getRentDetails($booking_id){
    if(isset($_SESSION['agency_username'])){
        $agency_email= $_SESSION['agency_username'];
        //fetch details of user from database
        global $conn;
        $sql="SELECT * from `rentals` where rental_id=$booking_id";
        try{
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $customer_id=$row['customer_id'];
            $car_id=$row['car_id'];
            $start_date=$row['start_date'];
            $end_date=$row['end_date'];
            $total_cost=$row['total_cost'];

            //get customer details using customer_id
            $customer_sql="SELECT name,mobile_no from customers where customer_id=$customer_id";
            $customer_result=mysqli_query($conn,$customer_sql);
            $customer_row=mysqli_fetch_assoc($customer_result);

            $customer_name=$customer_row['name'];
            $customer_mobile=$customer_row['mobile_no'];

                echo"
                <div class='row px-1' >
                <div class='col-md-1'></div>
                <div class='col-md-3'>";
                getCarDetail($car_id);
                echo"</div>
                <div class='col-md-6'>
                    <!-- booking details to be displayed here -->
                    <div class='container bg-light mb-2 p-2'>
                        <h2 class='text-center mt-4'><i class='fa-solid fa-car'></i> Booking Details</h2>
                        <!-- form -->
                        <form action='' method='' enctype='multipart/form-data'>
                    <div class='form-outline mb-2 w-50 m-auto' >
                        <!-- car model -->
                        <label for='car_model' class='form-label'>Booking Id</label>
                        <input type='text' name='car_model' id= 'car_model' class='form-control' value=$booking_id readonly>
                    </div>  
                <div class='form-outline mb-2 w-50 m-auto' >
                    <!-- car model -->
                    <label for='car_model' class='form-label'>Customer Name</label>
                    <input type='text' name='car_model' id= 'car_model' class='form-control' value=$customer_name readonly>
                </div>  
                <div class='form-outline mb-2 w-50 m-auto' >
                    <!-- car model -->
                    <label for='car_model' class='form-label'>Customer Contact</label>
                    <input type='text' name='car_model' id= 'car_model' class='form-control' value=$customer_mobile readonly>
                </div>    
                <div class='form-outline mb-2 w-50 m-auto' >
                    <!-- vehicle company -->
                    <label for='start_date' class='form-label'>Start Date</label>
                    <input type='date' name='start_date' id='start_date' class='form-control' value=$start_date readonly>
                </div>  

                <div class='form-outline mb-2 w-50 m-auto'>    
                    <!-- vehicle number -->
                    <label for='end_date' class='form-label'>End Date</label>
                    <input type='date' name='end_date' id='end_date' class='form-control' value=$end_date readonly>
                </div>  
                
                <div class='form-outline mb-5 w-50 m-auto'>    
                    <!-- vehicle number -->
                    <label for='total_cost' class='form-label'>Total Cost</label>
                    <input type='text' name='total_cost' id='total_cost' class='form-control' value=$total_cost readonly>
                </div>  
                
                </div>
            </form>
                        
                    </div>
                </div></div>";

        }catch(Exception $e){
            echo $e->getMessage();
            
            echo "<script> alert('Failed to retrieve data') </script><br><br>";
        }

        }
        else{
            header('Location: ../index.php');
        }
}



?>
