<?php

    class Inicio extends controller{

        function __construct(){

            parent::__construct();
            $this->view->render("inicio");

            
        }

    }

?>