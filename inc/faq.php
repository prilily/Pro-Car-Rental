<!-- COMMON HEADER FOR ALL HOME PAGE -->
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
                <a class="navbar-brand" href="../index.php"><i class="fa-solid fa-car"></i> PRO CAR RENTAL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="about.php" >About</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="faq.php" >FAQs</a>
                    </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['username'])) : ?>
                                <!-- if user is logged in display logout button in NAVBAR -->
                                <button type='button' class='btn btn-outline-dark' onclick='location.href ="../customer/index.php"'>View Profile</button>
                                <button type='button' class='btn btn-outline-dark' onclick='location.href ="../customer/customer_logout.php"'>Logout</button>
                            <?php else : ?>
                                <!-- if user is not logged in display login button in NAVBAR -->
                                <button type='button' class='btn btn-outline-dark' onclick='location.href ="../customer/customer_login.php"'>Login as Customer</button>
                                <button type='button' class='btn btn-outline-dark' onclick='location.href ="../agency/agency_login.php"'>Login as Agency</button>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
                            </div>           
<body>
    <!-- About header -->
    <div class="card mx-4 mb-4 p-2">
    <div class="card-header">
    <div class="container d-flex align-items-center justify-content-center " >
            <ul class="nav mb-8">
                <li class="nav-item mt-4 p-8" >
                    <h3 class="text-center" style="font-size:3vw">FAQs - Pro Car Rentals  <i class="fa-solid fa-car"></i></h3>
                </li>
            </ul>      
    </div>
    <div class="container d-flex align-items-center justify-content-center " >
            <ul class="nav mb-8">
                <li class="nav-item mt-4 p-8" >
                <p>Here are some common questions about our car rental website:</p>
                </li>
            </ul>        
    </div>
                            </div>
    <!-- second child FAQs -->

    <!-- faq 1 -->
    <div class="card mt-4 mb-2 w-50 m-auto">
    <div class="card-header" id="headingOne">
      <h4 class="mb-0">
        How do I register as a customer?
      </h4>
    </div>

    <div id="c1">
      <div class="card-body">
      To register as a customer, click on the "Registration" button on the top menu and follow the prompts to create a new account. You will need to provide your email address, a password, and some personal information.      </div>
    </div>
  </div>


    <!-- faq 2 -->
  <div class="card mt-4 mb-2 w-50 m-auto">
    <div class="card-header" id="headingOne">
      <h4 class="mb-0">
        How do I rent a car from your agency?
      </h4>
    </div>

    <div id="c2" >
      <div class="card-body">
      To rent a car from our agency, you will need to create an account on our website and log in. From there, you can browse the available cars and select the one that you would like to rent. Once you have chosen a car, you will be able to choose the rental dates and finalize the booking.
    </div>
  </div>
</div>

    <!-- faq 3 -->
    <div class="card mt-4 mb-2 w-50 m-auto">
    <div class="card-header" id="headingOne">
      <h4 class="mb-0">
        How do I register as a car rental agency?
      </h4>
    </div>

    <div id="c3" >
      <div class="card-body">
      To register as a car rental agency, click on the "Registration" button on the top menu and select the "Agency" registration option. Follow the prompts to create a new account and provide your agency's information.
    </div>
  </div>
</div>

<!-- faq 4 -->
<div class="card mt-4 mb-2 w-50 m-auto">
    <div class="card-header" id="headingOne">
      <h4 class="mb-0">
        How do I add a new car for rent?
      </h4>
    </div>

    <div id="c4" >
      <div class="card-body">
      Only car rental agencies can add new cars for rent. To do so, log in to your agency account and click on the "Add new car" button on the top menu. Fill in the required information about the car, such as the model, vehicle number, seating capacity, and rent per day.
    </div>
  </div>
</div>

    <!-- faq 5 -->
    <div class="card mt-4 mb-2 w-50 m-auto">
    <div class="card-header" id="headingOne">
      <h4 class="mb-0">
        How much does it cost to rent a car?
      </h4>
    </div>

    <div id="c5">
      <div class="card-body">
      The cost of renting a car from our agency will depend on the type of car you choose and the length of your rental period. The rental rate for each car is listed on its product page, and you can see the total cost of your rental by using the rental calculator on the website.
    </div>
  </div>
</div>
 </div>

<?php include 'footer.php' ?>