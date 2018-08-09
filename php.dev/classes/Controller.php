<?php
    // Abstract class, this is the base controller class where the other controllers will extend from this one
    abstract class Controller{
        // Properties
        protected $request;
        protected $action;

        // Constructor
        public function __construct($action, $request){
            // Assigning our properties
            $this->action = $action;
            $this->request = $request;
        }

        // Execute action
        public function executeAction(){
            return $this->{$this->action}();
        }

        // Return our view
        protected function returnView($viewmodel, $fullview){
            // Variable called view, name view the same as your classes
            $view = 'views/'. get_class($this). '/' . $this->action. '.php';
            // Check to see if it is a full view
            if($fullview){
                // Load our main layout
                require('views/main.php');
            } else {
                // Else load individual view
                require($view);
            }
        }
    }
?>