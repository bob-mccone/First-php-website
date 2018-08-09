<?php
    class Messages{
        // Static function
        public static function setMsg($text, $type){
            if($type == 'error'){
                $_SESSION['errorMsg'] = $text;
            } else {
                $_SESSION['successMsg'] = $text;
            }
        }

        // Function for displaying error messages
        public static function display(){
            // checking to see if they are already set, error message
            if(isset($_SESSION['errorMsg'])){
                // error message display
                echo '<div class="alert alert-danger">'.$_SESSION['errorMsg'].'</div>';
                // Unset the error message once we output it
                unset($_SESSION['errorMsg']);
            }

            // checking to see if they are already set, success message
            if(isset($_SESSION['successMsg'])){
                // error message display
                echo '<div class="alert alert-success">'.$_SESSION['successMsg'].'</div>';
                // Unset the error message once we output it
                unset($_SESSION['successMsg']);
            }
        }
    }
?>