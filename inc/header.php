<!-- COMMON HEADER FOR ALL HOME PAGE -->
<?php include 'config/functions.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <!-- bootstrao CSS link -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome link -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>


    <!-- navbar -->
    <div class="container-fluid bg-light">
        <!-- first child -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
            <div class="container">
                <a class="navbar-brand" href="./index.php"><i class="fa-solid fa-car"></i> PRO CAR RENTAL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="inc/about.php" >About</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="inc/faq.php" >FAQs</a>
                    </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['username'])) : ?>
                                <!-- if user is logged in display logout button in NAVBAR -->
                                <button type='button' class='btn btn-outline-dark' onclick='location.href ="customer/index.php"'>View Profile</button>
                                <button type='button' class='btn btn-outline-dark' onclick='location.href ="customer/customer_logout.php"'>Logout</button>
                            <?php else : ?>
                                <!-- if user is not logged in display login button in NAVBAR -->
                                <button type='button' class='btn btn-outline-dark' onclick='location.href ="customer/customer_login.php"'>Login as Customer</button>
                                <button type='button' class='btn btn-outline-dark' onclick='location.href ="agency/agency_login.php"'>Login as Agency</button>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
                            </div>           