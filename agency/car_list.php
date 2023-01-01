<?php include 'inc/header.php';
if(isset($_SESSION['agency_username'])){
    // fetch page when agency is logged in
}else {
    //if page is accessed without user logged in.
    header('Location: ../index.php');
}
?>

<!-- load the cars for sepecific agency here  using getcars function but pass agency  here-->
<!-- second child -->

<div class="row px-1" >
        <div class="col-md-1"></div>
        <div class="col-md-10 mt-3">
        <div class="card">
        <div class="card-header"> 
        <p class="mb-0 text-center" style="font-size:2vw">AVAILABLE CAR FOR RENTALS FROM YOUR AGENCY</p>

        </div>
            <!-- car listings -->
            <div class="row px-4">
                <!-- fetching car details -->
                <?php
                $agency_email=$_SESSION['agency_username'];
                //get agency id from email
                $agency_sql="SELECT agency_id from car_rental_agencies where email='$agency_email'";
                $agency_result=mysqli_query($conn,$agency_sql);
                $agency_row=mysqli_fetch_assoc($agency_result);
                $agency_id=$agency_row['agency_id']; 
                    getAgencyCars($agency_id);
                ?>

            </div>
        </div>
        <div class="col-md-1"></div>
</div>
</div>

<?php include 'inc/footer.php';?>
