# e-commerce-project

This is a sample application that demonstrates an E-commerce website using the MEAN stack. The application loads 
products from a MySQL database and displays them. Users can select to display products in a single category. Users can 
click on any product to get more information including pricing, reviews and rating. Users can select items and 
add them to their shopping cart, built on PHP, JS and HTML with a lightweight Admin Panel.

The purpose of this repository it's for education and test. But the code it's being coded in a proper way.

## Setup:

1. git clone https://github.com/Akposieyefa/e-commerce-project.git or download as zip.
2. Create a new database `clothmax_db` in MySQL.
3. Run the SQL query in `sql/clothmax_db.sql`.
4. Open the file `config/Connection.php` and change the Server name, Username, Password and Database name (Optional).

Demo Admin - email: 'admin@clothmax.com' pass - '12345'.

## Features

<b>Products Features</b>

| Feature  |  Coded?       | Description  |
|----------|:-------------:|:-------------|
| Add a Product | &#10004; | Ability of Add a Product on the System |
| List Products | &#10004; | Ability of List Products |
| Edit a Product | &#10004; | Ability of Edit a Product |
| Delete a Product | &#10004; | Ability of Delete a Product |

<b>Purchase Features</b>

| Feature  |  Coded?       | Description  |
|----------|:-------------:|:-------------|
| Create a Cart | &#10004; | Ability of Create a new Cart |
| See Cart | &#10004; | Ability to see the Cart and it items |
| Remove a Cart | &#10004; | Ability of Remove a Cart |
| Add Item | &#10004; | Ability of add a new Item on the Cart |
| Remove a Item | &#10004; | Ability of Remove a Item from the Cart |
| Checkout | &#10004; | Ability to Checkout |

## Deploy

<a href="https://fastwaycourier.services/clothmax/">Visit</a>

## Dependencies

* Autoloader | To better organize the classes, PHP `namespace` is used.

## Tech Stack

* Bootstrap4
* PHP
* MySQL
* JQuery

## Plugins

* Select2-bootstrap4
* Elegant-icons
* Font-awesome
* Maginific-popups
* Owl-carousel
* SweetAlert
* DataTable
* Popper
* tempusdominus-bootstrap-4