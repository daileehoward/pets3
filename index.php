<?php
    /*
     * Authors: Tiffany Ferderer and Dailee Howard
     * Date: February 5th, 2021
     * File: index.php
     */

    //This is my CONTROLLER page

    // Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Start a session
    session_start();

    //Require the auto autoload file
    require_once('vendor/autoload.php');
    require_once ('model/data-layer.php');

    //Create an instance of the Base class
    $f3 = Base::instance();
    $f3->set('Debug',3);

    //Define a default route (home page)
    $f3->route('GET /', function() {
        // Display a view
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/pet-home.html');
    });


    $f3->route('GET|POST /order', function($f3) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Validate the data
            if (empty($_POST['typeOfPet'])) {
                //...
            } else {
                //...
            }
        }

        //if it doesnt work with conditional
        $f3->set('colors', getColors());

            $view = new Template();
            echo $view->render('views/pet-order.html');

    });

    $f3->route('GET|POST /order2', function($f3){
        //echo "Order Page 2";

        //add data from order page to session array
        if(isset($_POST['typePet'])){
            $_SESSION['typePet'] = $_POST['typePet'];
        }
        if(isset($_POST['color'])){
            $_SESSION['color'] = $_POST['color'];
        }

        $f3 ->set('sizes', getSizes());
        $f3 ->set('accessories', getAccessories());

        //display a view
        $view = new Template();
        echo $view->render('views/pet-order2.html');
    });

    //Define a summary route
    $f3->route('POST /summary', function() {

        //echo "<br>";
        if(isset($_POST['size'])){
            $_SESSION['size'] = $_POST['size'];
        }
        if(isset($_POST['accessory'])){
            $_SESSION['accessory'] = $_POST['accessory'];
        }
        // Add data from form2 to Session array
        if (isset($_POST['name'])) {
            $_SESSION['name'] = $_POST['name'];
        }
        

        // Display a view
        $view = new Template();
        echo $view->render("views/summary.html");
    });
    //Run fat free
    $f3->run();