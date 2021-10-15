<?php
    include 'config.php';
    include 'tabla.php';
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

            if(!empty($_POST["usuario"]) && !empty($_POST["password"]) && !empty($_POST["email"])){

                $usuario = $_POST["usuario"];
                $email = $_POST["email"];
                $contra = password_hash($_POST["password"], PASSWORD_BCRYPT);

                $query = mysqli_query($db_connection, "SELECT rol 
                                                        FROM usuarios
                                                        WHERE usuario = '$usuario' AND email = '$email' AND passw = '$contra'");

                if ($query){
                    $row = mysqli_fetch_row($query);
                    echo "<pre>". $row['rol'] . " </pre>";
                    header("Location: http://example.com/tabla.php?rol=");
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
                <button type="submit">Login</button>
            </form>

            <button><a href="register.php">Registrar</a></button>
        </div>

    </body>

</html>