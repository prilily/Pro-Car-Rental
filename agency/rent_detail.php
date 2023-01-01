<?php include 'inc/header.php';
?>

<?php
if(isset($_SESSION['agency_username'])){
    // fetch page when agency is logged in
   // get car_id here and other details
    $booking_id=$_GET['booking_id'];
    getRentDetails($booking_id);
}else {
    //if page is accessed without user logged in.
    header('Location: ../index.php');
}
?>

<!-- second child -->
<?php include 'inc/footer.php';?>


