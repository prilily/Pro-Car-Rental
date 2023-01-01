<?php include 'inc/header.php';?>

<body>
    <div class="background">
        <img src="images/bg-index.png" alt="">
    </div>

    <!-- second child -->

    <div class="row px-1 bg-light">
        <div class="col-md-1"></div>
        <div class="col-md-10 mt-3">
        <div class="card">
    <div class="card-header"> 
    <p class="mb-0 text-center" style="font-size:2vw">FIND YOUR INFINITI</p>

    </div>
            <!-- car listings -->
            <div class="row mb-3">
            </div>
            <div class="row px-4">
                
                    <!-- fetching car details -->
                        <?php
                        getAllCars();
                        ?>
                </div>  
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>


    <?php include 'inc/footer.php' ?>