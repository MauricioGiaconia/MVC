<?php

  

    class Login extends controller{

        function __construct(){

            parent::__construct();
            
            $this->view->render("login");

        }

        function logearUsuario(){

            if (!empty($_POST["usuario"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
                
                $usuario = $_POST["usuario"];
                $email = $_POST["email"];
                $contra = $_POST["password"];   

                $aDatos = array("user" => $usuario,
                                "email" => $email,
                                "password" => $contra);
                    
                $this->model->logear($aDatos);

            }
            

        }

    }
?>