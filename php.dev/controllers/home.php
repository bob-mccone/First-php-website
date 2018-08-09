<?php
    // Home class extends the controller class
    class Home extends Controller{
        // Index function for home
        protected function Index(){
            $viewmodel = new HomeModel();
            $this->ReturnView($viewmodel->Index(), true);
        }
    }
?>