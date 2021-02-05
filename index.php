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

    //Define an order route
    $f3->route('GET /order', function() {
        // Display a view
        $view = new Template();
        echo $view->render("views/pet-order.html");
    });

    //Define an order2 route
    $f3->route('POST /order2', function() {
        //var_dump($_POST);

        // Add data from form1 to Session array
        if (isset($_POST['pet'])) {
            $_SESSION['pet'] = $_POST['pet'];
        }
        if (isset($_POST['color'])) {
            $_SESSION['color'] = $_POST['color'];
        }

        // Display a view
        $view = new Template();
        echo $view->render("views/pet-order2.html");
    });

    //Define a summary route
    $f3->route('POST /summary', function() {
        //var_dump($_POST);
        //echo "<br>";

        // Add data from form2 to Session array
        if (!empty($_POST['name'])) {
            $_SESSION['name'] = $_POST['name'];
        }

        //var_dump($_SESSION);

        // Display a view
        $view = new Template();
        echo $view->render("views/summary.html");
    });
    $f3->route('GET|POST /order', function($f3) {
        //Check if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Validate the data
            if (empty($_POST['pet'])) {
//                ...
            } else {
//                ...
            }
        }
        $colors = getColors();
        $f3->set('color', $colors);
        $view = new Template();
        echo $view->render('view/pet-order.html');
    });
    //Run fat free
    $f3->run();