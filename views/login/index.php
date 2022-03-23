<!DOCTYPE html>

<?php
    //include 'config/configBD.php';
    require "views/header.php";
?>

<html lang="en">

    <body>

        <div class="contenedor">

            <?php
            
                if (!$_SESSION["logged"]){

            ?>
                <form action="<?php echo constant('URL');?>login/logearUsuario" id="login" method="POST">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario..." >
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Ingrese su email...">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña...">
                    <button type="submit">Login</button>
                </form>
            <?php
                }else{
                    header("Location: " . constant("URL"));
                }
            ?>


            
            <p>¿No tienes cuenta? Registrate!</p>
            <button><a href="register.php">Registrar</a></button>
        </div>

        <?php require "views/footer.php"; ?>

    </body>

</html>