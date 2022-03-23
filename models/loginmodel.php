<?php


    class Loginmodel extends Model{

        function __construct(){
            parent::__construct();
        }

        function logear($aDatos){

            $conexion = $this->db->conexion();

            $consulta = "SELECT * 
                        FROM usuarios
                        WHERE usuario = ? AND email = ?";

            $resultado = $conexion->prepare($consulta);

            $resultado->execute(array($aDatos["user"], $aDatos["email"]));
            $user = $resultado->fetch(PDO::FETCH_OBJ);

            echo password_verify($aDatos["password"], ($user->passw));

            if ($user && password_verify($aDatos["password"], ($user->passw))){
      
                $_SESSION["id"] = $user->user_id;
                $_SESSION["usuario"] = $usuario;
                $_SESSION["email"] = $email;
                $_SESSION["rol"] = $user->rol;
                $_SESSION["logged"] = true;

                header("Location: " . constant("URL"));

            } else{

                

            }
            
            

        }
        
    }

?>