<?php

  

    class Register extends controller{

        function __construct(){

            parent::__construct();
            
            $this->view->render("register");

        }

        function registrarUsuario(){
   
            if(!empty($_POST["usuario"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["repassword"]) /*&& !empty($_POST["tipoUser"])*/){

                $usuario = $_POST["usuario"];
                $email = $_POST["email"];
                $contra = $_POST["password"];
                $recontra = $_POST["repassword"];
                //$rol = $_POST["tipoUser"]; 

                if($contra === $recontra){

                    $aDatos = array( "user" => $usuario,
                                "email" => $email,
                                "password" => $contra
                    );

                    $this->model->registrarUser($aDatos);
                    
                } else{
                    //Agregar cartel de password no coincide
                }
            }

        }
    }
?>