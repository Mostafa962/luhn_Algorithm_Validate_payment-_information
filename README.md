## Table of contents
* [General info](#general-info)
* [Requirements](#requirements)
* [Technologies](#technologies)
* [Installation](#installation)
* [Inputs](#inputs)
* [Resources](#resources)

## General info
This project is an API to validate payment information.

## Requirements
* PHP: 8.0
* Apache2 Web Server
* Composer Dependency Management
* Postman API Platform  

## Technologies
Project is created with:
* PHP: 8.0

## Installation
* Download :
    Download the whole project from the attached link.
* Switch to the Server directory:
    - Linux(ubuntu) : switch to /var/www/html directory than paste the whole project here.
    - Windows : if you have XAMPP server, switch to c://xampp/htdocs folder then paste the whole project here.
* Extraction :
    - extract the zip file.
* Start the local development server in postman:
    - open postman
    - import payment_api.postman_collection.json file from the downloaded folder. 
* Enjoy :)

## Inputs
* payment_method : 
    This input is The payment method, It's value must be "phone" in case customer choose phone number as a pyment method, or "credit_card" if he choose credit card as a a pamynet method.

* phone_number :
    must be one of mobile phone numbers in Egypt for the 4 major Service providers:
    Etisalat, Vodafone, Orange or WE. 

* card_number :
    CC number : credit card number based on Luhn's algorithm.

* expiration_date :
    expiration date : muse be in fotmat : MM-YY or MM/MM.
* cvv2 :
    CVV2 : Card Verification Value 2.
* email :
    Email : Must be in mail format.
    
## Resources
* https://en.wikipedia.org/wiki/Luhn_algorithm