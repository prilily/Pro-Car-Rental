<?php include '../config/functions.php';?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- bootstrao CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- navbar -->
    <div class="container-fluid"> 
        <!-- first child -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light mt-2 mb-4">
        <div class="container">
        <a class="navbar-brand" href="agency_index.php"><i class="fa-solid fa-car"></i> PRO CAR RENTAL - AGENCY</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <?php if(isset($_SESSION['agency_username'])):?>
                    <?php echo  $_SESSION['agency_username'];?>
                    <button type='button' class='btn btn-outline-dark' onclick='location.href ="agency_logout.php"'> Logout</button>
                <?php else:?>
                    <button type='button' class='btn btn-outline-dark' onclick='location.href ="../customer/customer_login.php"'>Login as Customer</button>
                    <button type='button' class='btn btn-outline-dark' onclick='location.href ="agency_login.php"'>Login as Agency</button>
                <?php endif?>
            </li>        
            </ul>
        </div>
        </nav>
        <!-- second child -->
        <?php if(isset($_SESSION['agency_username'])):?>
            <div class="container" >
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <a class="nav-link" href="agency_index.php" >Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="car_list.php" >Car Listing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="new_car.php" >Add a New Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="booking_list.php" >Bookings</a>
                </li>
            </ul>

            
            </div>
        </div>
        <?php endif?>  