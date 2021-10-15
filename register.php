<?php
    include 'config.php';
?>

<!DOCTYPE html>


<html lang="en">

    <head>

        <title>Trabajo practico especial web dos - Giaconia</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <meta charset = "UTF-8">
        
    </head>
    
    <body>

        <?php

            if(!empty($_POST["usuario"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["repassword"]) && !empty($_POST["tipoUser"])){

                $usuario = $_POST["usuario"];
                $email = $_POST["email"];
                $contra = $_POST["password"];
                $recontra = $_POST["repassword"];
                $rol = $_POST["tipoUser"];

                if($contra === $recontra){
                    $contra = password_hash($contra, PASSWORD_BCRYPT);
                    mysqli_query($db_connection, "INSERT INTO usuarios(usuario, email, passw, rol) 
                                                    VALUES ('$usuario', '$email', '$contra', $rol)");


                
                }

            } 
            
        ?>

        <div id="contenedor-formulario">

            <form action="" id="login" method="POST">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario..." >
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Ingrese su email...">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña...">
                <label for="password">Reingrese contraseña:</label>
                <input type="password" id="repassword" name="repassword" placeholder="Reingrese su contraseña...">

                <select name="tipoUser" id="tipoUser">

                    <?php
                        $selRol = mysqli_query($db_connection, "SELECT *
                                                                FROM roles");

                        if ($selRol){
                           
                           while($row = mysqli_fetch_assoc($selRol)){
                                echo "<option value=$row[rol_id]>$row[rol]</option>";
                            }

                            
                        }
                    ?>

                </select>
                <button type="submit">Registrar</button>
            </form>

            
        </div>

    </body>

</html>