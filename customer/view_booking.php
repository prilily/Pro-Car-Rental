<?php include 'inc/header.php'; ?>
<!-- TO VIEW CUSTOMER BOOKINGS -->
<?php

if (isset($_SESSION['username'])) {

    echo"<div class='toast' role='alert' aria-live='polite' aria-atomic='true' style='position: relative; min-height: 200px;''>
    <div style='position: absolute; top: 0; right: 0;'>            
    <div class='toast-header'>
                  <strong class='mr-auto'>Booking Confirmed</strong>
                  <button type='button' class='ml-2 mb-1 close' data-dismiss='toast' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='toast-body'>
                Your car rental booking for  has been confirmed! Details have been sent over registred mobile number. Thank you for choosing our service.
                </div>
              </div>
              </div>                ";

    //check if a user is logged in or not.
    $customer_email = $_SESSION['username'];
    //fetch details of user from database
    global $conn;
    $sql = "SELECT * from `customers` where email='$customer_email'; ";
    try {
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['customer_id'];
        $bookingg_sql = "SELECT * from rentals where customer_id=$customer_id";
        try {
            $result = mysqli_query($conn, $bookingg_sql);
            $count = 1;
            echo "
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
                                <th scope='col'>Agency Name</th>
                                <th scope='col'>Status</th>
                            </tr>
                            </thead>
                            <tbody>";
            while ($row = mysqli_fetch_assoc($result)) {

                $booking_id = $row['rental_id'];
                $car_id = $row['car_id'];
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
                $total_cost = $row['total_cost'];
                $agency_id = $row['agency_id'];

                //get car_model and agency_name
                $car_sql = "SELECT model from cars where car_id=$car_id";
                $car_result = mysqli_query($conn, $car_sql);
                $car_row = mysqli_fetch_assoc($car_result);
                $car_model = $car_row['model'];

                $agency_sql = "SELECT name from car_rental_agencies where agency_id=$agency_id";
                $agency_result = mysqli_query($conn, $agency_sql);                
                $agency_row = mysqli_fetch_assoc($agency_result);             
                $agency_name = $agency_row['name'];

                $today = date("Y-m-d");
                $completed = ($end_date < $today) ? 'Completed' : 'Live';

                //now display table row
                echo "<tr>
                        <th scope='row'>$count</th>
                        <td>$booking_id</td>
                        <td>$car_model</td>
                        <td>$start_date</td>
                        <td>$end_date</td>
                        <td>$total_cost</td>
                        <td>$agency_name</td>
                        <td>$completed</td>
                    </tr>";
                $count++;
            }

            echo "  </tbody>
                </table>
                </div><div class='col-md-2'> </div></div></div></div></div>";
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "<script> alert('Failed to get Booking data') </script><br><br>";
        }
    } catch (Exception $e) {
        echo $e->getMessage();

        echo "<script> alert('Failed to insert data') </script><br><br>";
    }
} else {
    //re-direct to home page if user is not logged in as a customer
    header('Location: ../index.php');
}
?>



<?php include 'inc/footer.php'; ?>
