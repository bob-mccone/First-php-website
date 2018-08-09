<?php
    // Users class extend controller class
    class Users extends Controller{
        // Register
        protected function register(){
            // Assign the view model
            $viewmodel = new UserModel();
            // Return the register view with the main layout template by writing true
            $this->returnView($viewmodel->register(), true);
        }

        // Login
        protected function login(){
            // Assign the view model
            $viewmodel = new UserModel();
            // Return the login view with the main layout template by writing true
            $this->returnView($viewmodel->login(), true);
        }

        // Logout
        protected function logout(){
            // Unsetting the session
            unset($_SESSION['is_logged_in']);
            // Unsetting the user data
            unset($_SESSION['user-data']);
            // Just to be safe we will kill all session variables
            session_destroy();
            // Redirect user
            header('Location: '.ROOT_URL);
        }
    }
?>