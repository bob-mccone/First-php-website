<?php
    class Bootstrap{
        // Properties
        private $controller;
        private $action;
        private $request;

        // Constructor
        public function __construct($request){
            // Assigning $request that is comming in as request
            $this->request = $request;
            // If the requested controller doesn't exist
            if($this->request['controller'] == ""){
                // Show home controller
                $this->controller = 'home';
            } else {
                // Else we will display what ever the request is
                $this->controller = $this->request['controller'];
            }
            // If the requested action doesn't exist
            if($this->request['action'] == ""){
                // Show index action
                $this->action = 'index';
            } else {
                // Else set the action that is requested
                $this->action = $this->request['action'];
            }

            // Find out if we are actually setting these things
            //echo $this->controller;
        }

        // Create controller method, this is called from the index file
        public function createController(){
            // Check for the class
            if(class_exists($this->controller)){
                $parents = class_parents($this->controller);
                // Check extend
                if(in_array("Controller", $parents)){
                    if(method_exists($this->controller, $this->action)){
                        return new $this->controller($this->action, $this->request);
                    } else {
                        // Method does not exist
                        echo '<h1>Method does not exist</h1>';
                        return;
                    }
                } else {
                    // Base controller does not exist
                    echo '<h1>Base controller not found</h1>';
                    return;
                }
            } else {
                // Controller class does not exist
                echo '<h1>Controller class does not exist</h1>';
                return;
            }
        }
    }
?>