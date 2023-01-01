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
            $bookingg_sql="SELECT * from rentals where agency_id=$agency_id";
            try{
                $result=mysqli_query($conn,$bookingg_sql);
                $count=1;
                echo"
                <div class='card mt-4 mx-4 mb-4 '>
                
                <div class='row px-1' >
                    <div class='col-md-1'></div>
                        <div class='col-md-2'> </div>
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

                    //get car_model and agency_name
                    $car_sql="SELECT model from cars where car_id=$car_id";
                    $customer_sql="SELECT name from customers where customer_id=$customer_id";
                    $car_result=mysqli_query($conn,$car_sql);
                    $customer_result=mysqli_query($conn,$customer_sql);

                    $car_row=mysqli_fetch_assoc($car_result);
                    $customer_row=mysqli_fetch_assoc($customer_result);

                    $car_model=$car_row['model'];
                    $customer_name=$customer_row['name'];

                    $today= date("Y-m-d");
                    $status=($end_date<$today)? 'Completed':'Live';

                    //now display table row
                    echo"<tr>
                        <th scope='row'>$count</th>
                        <td>$booking_id</td>
                        <td>$car_model</td>
                        <td>$start_date</td>
                        <td>$end_date</td>
                        <td>$total_cost</td>
                        <td>$customer_name</td>
                        <td>$status</td>
                        <td><div class='card-body'><a href='rent_detail.php?booking_id=$booking_id' class='btn btn-primary'>View Details</a></div></td>
                    </tr>";
                  $count++;
                }
                      
                echo"  </tbody>
                </table>
                </div><div class='col-md-2'> </div></div></div></div></div>";
    
            }catch(Exception $e){
                echo $e->getMessage();
                
                echo "<script> alert('Failed to insert data') </script><br><br>";
            }
            
            

        }catch(Exception $e){
            echo $e->getMessage();
            
            echo "<script> alert('Failed to insert data') </script><br><br>";
        }

        }
        else{
            header('Location: ../index.php');
        }
?>
 



<?php include'inc/footer.php'; ?>


<!-- 

make function to get booking details given booking id
see why index page is not showing after login
upload to 000webhost

 -->