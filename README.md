Car Rental Agency
A real-life system for car rental agencies and their customers.

Features
Two types of users: Customers and Car Rental Agencies
Registration pages for both types of users
Login pages for both types of users
Add new cars page for Car Rental Agencies to add details of cars available for rental (model, number, seating capacity, rent per day)
Edit details of a particular car for Car Rental Agencies
Available cars to rent page for all users to view details of available cars and rent them (model, number, seating capacity, rent per day, input for number of days and start date to rent)
View booked cars page for Car Rental Agencies to see list of customers who have booked their cars
Technologies
Front-end: HTML/CSS/JS with Bootstrap
Backend: core PHP or PHP CodeIgniter framework with MySQL database
Focus
Neat and simple design
Good database architecture
Good coding practices (readable, modular code)
DATABASE SCHEMA


![](images/db-schema.png)

This class diagram shows :
Customers --* Rentals
CarRentalAgency --* Cars
Rentals --* Cars
Rentals --* CarRentalAgency



FILE STRUCTURE
```bash
├──── index.php   		[ landing page of the website ]        
├── config	   			[ utility functions folder ]
│   ├── database.php   			[ manages the connection with the database ]
│   └── functions.php				[ utility functions ]
 |
├── inc				[ includes folder - to contain common code for pages ]
│   ├── about.php   				[ about page of the website ]
│   ├── faq.php   				[ faq page of the website ]
│   ├── footer.php				[ common Html code for website footer ]
│   ├── header.php	   			[ common code for website header(navbar etc)]
│   ├── script.js
│   └── style.css
├── images				[ folder to contain images for the website]
 |
├── customer			[ folder for customer pages ]
│   ├── book_car.php			[ page for customers to book a car ]
│   ├── customer_login.php			[ customer login page ]	
│   ├── customer_logout.php		[ customer logout page (to destroy session) ]
│   ├── inc				[ includes folder to contain common code for pages ]
│   │   ├── footer.php
│   │   └── header.php
│   ├── index.php				[ landing page for customers after login ]
│   ├── registration.php			[ customer registration page ]
│   └── view_booking.php			[ page to view all bookings by a customer ]
 |			
├── agency				[ folder for agency pages ]
│   ├── agency_index.php			[ landing page for the agency after login ]
│   ├── agency_login.php			[ agency login page ]
│   ├── agency_logout.php			[ agency logout page]
│   ├── agency_registration.php		[ agency registration page]
│   ├── booking_list.php			[ page to view all car rental bookings for an agency]
│   ├── car_booking_details.php		[ page to view rent details about a particular car]
│   ├── car_details.php			[ page to view and edit details about a car]
│   ├── car_list.php				[ page to view all cars for rent by an agency]
│   ├── inc				[ includes folder to contain common code for pages ]
│   │   ├── footer.php
│   │   ├── header.php
│   ├── new_car.php				[ page to register a new car]
│   └── rent_detail.php                                 [ page to view details about a particular booking]


```
