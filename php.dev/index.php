<?php
    // Start session, need this if using session, this will run for every page as the index file is part of them
    session_start();
    
    // Include config file
    require('config.php');

    // Include the messages file
    require('classes/Messages.php');
    // Include bootstrap file
    require('classes/Bootstrap.php');
    // Include the controller file
    require('classes/Controller.php');
    // Include the model file
    require('classes/Model.php');

    // Include home controller file
    require('controllers/home.php');
    // Include shares controller file
    require('controllers/shares.php');
    // Include users controller file
    require('controllers/users.php');

    // Include home model file
    require('models/home.php');
    // Include share model file
    require('models/share.php');
    // Include user model file
    require('models/user.php');

    // Create a variable called bootstrap, the request is coming in as the _GET super global
    $bootstrap = new Bootstrap($_GET);
    // Controller variable
    $controller = $bootstrap->createController();
    // If the controller is there
    if($controller){
        // Call the execute action method
        $controller->executeAction();
    }
?>