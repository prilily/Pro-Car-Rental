<?php
include 'inc/header.php';
?>


<?php
$car_id = $_GET['car_id'];
if ($_SESSION['username']) {
    if (isset($_POST['book_car'])) {
        $customer_email = $_SESSION['username'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];


        if ((strtotime($end_date) < strtotime($start_date))) {
            echo "<script> alert('Start Date cannot be after End Date data'); </script><br><br>";
        } else {
            //get number of days here
            $timeDiff = (strtotime($end_date) - strtotime($start_date));
            $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
            $numberDays = intval($numberDays);
            ++$numberDays;


            //rate of car
            $car_sql = "SELECT * from cars where car_id=$car_id";
            $car_result = mysqli_query($conn, $car_sql);
            $car_row = mysqli_fetch_assoc($car_result);
            $rate = $car_row['rent_per_day'];
            $car_model=$car_row['model'];
            $agency_id = $car_row['agency_id'];
            $total_cost = $numberDays * $rate;

            //customer_id here
            $customer_sql = "SELECT * from customers where email='$customer_email'";
            $customer_result = mysqli_query($conn, $customer_sql);
            $customer_row = mysqli_fetch_assoc($customer_result);
            $customer_id = $customer_row['customer_id'];


            $sql = "INSERT into rentals(customer_id,car_id,start_date,end_date,total_cost,agency_id) VALUES ($customer_id,$car_id,'$start_date','$end_date',$total_cost,$agency_id)";
            try {
                $result = mysqli_query($conn, $sql);
                echo" <div class='alert alert-success' role='alert'>
                <h4 class='alert-heading'>Booking Confirmed!</h4>
                  <p> Your booking for details $car_model has been sent over the registered email address.</p>  
                  <hr>
                  <p>Thank you for choosing our services.</p>";
                echo'<input type="submit" name="book_car" class="btn btn-dark mb-4 p-2" value="View Booking" onclick="location.href =\'view_booking.php\'" >';
              echo"</div>";
            } catch (Exception $e) {
                //echo $e->getMessage();
                echo "<script> alert('Failed to book car') </script><br><br>";
            }
        }
    }
} else {
    //if user is not logged in.
    header('Location: ../index.php');
}

?>

<!-- Book Car Page -->
<!-- second child -->

<div class="row px-1">
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
        <!-- booking details to be displayed here -->
        <div class="container bg-light mb-2 p-2">
            <h2 class="text-center mt-4"><i class="fa-solid fa-car"></i> Booking Details</h2>
            <!-- form -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-outline mt-4 mb-2 w-50 m-auto">
                    <!-- car model -->
                    <label for="car_model" class="form-label">License No</label>
                    <input type="text" name="car_model" id="car_model" class="form-control" placeholder="Enter your license number" autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-2 w-50 m-auto">
                    <!-- vehicle company -->
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Enter car company" autocomplete="off" required="required">
                </div>

                <div class="form-outline mb-2 w-50 m-auto">
                    <!-- vehicle number -->
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Enter car number" autocomplete="off" required="required">
                </div>


                <div class="form-outline mt-3 mb-4 w-50  m-auto text-center">
                    <!-- submit button -->
                    <input type="submit" name="insert_car" class="btn btn-secondary mx-2 mb-4 p-2" value="Go Back" onclick=" location.href ='../index.php'">

                    <!-- submit button -->
                    <input type="submit" name="book_car" class="btn btn-dark mb-4 p-2" value="Book Car">
                </div>

        </div>
        </form>

    </div>

</div>




<?php include 'inc/footer.php' ?>