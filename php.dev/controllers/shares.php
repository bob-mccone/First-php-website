<?php
    // Shares class extend controller class
    class Shares extends Controller{
        // Index function for shares
        protected function Index(){
            $viewmodel = new ShareModel();
            $this->ReturnView($viewmodel->Index(), true);
        }

        // Add function for shares
        protected function add(){
            // Stopping users trying to add a share via url if they are not logged in
            if(!isset($_SESSION['is_logged_in'])){
                // If they are not logged in then they just redirected back to the shares page
                header('Location: '.ROOT_URL.'shares');
            }
            $viewmodel = new ShareModel();
            $this->ReturnView($viewmodel->add(), true);
        }
    }
?>