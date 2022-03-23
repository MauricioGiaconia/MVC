<?php

    class Controller{

        function __construct(){

            $this->view = new View();
        }

        function cargarModel($nombre){
            $url = "models/" . $nombre . "model.php";

            if (file_exists($url)){

                require $url;
 
                $modelName = $nombre . "model";
                $this->model = new $modelName();
                
            }
        }

    }
?>