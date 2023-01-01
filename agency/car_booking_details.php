<?php include 'inc/header.php';
?>

<?php
if(isset($_SESSION['agency_username'])){
   // get car_id here and other details when agency is logged in
    $car_id=$_GET['car_id'];
    getCarBookings($car_id);
}else {
        //if page is accessed without user logged in.
        header('Location: ../index.php');
    }
?>

<!-- second child -->
<?php include 'inc/footer.php';?>


