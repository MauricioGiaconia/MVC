<?php
    include_once 'libs/funciones.php';
?>

<!DOCTYPE html>

<?php
    
    session_start();

    if (isset($_POST['desloggear'])){
    
        cerrarSesion();
    }

    if(!array_key_exists('logged', $_SESSION)){
        
        $_SESSION['logged'] = false;

    }

?>


<html lang="en">

    <head>

        <title>Trabajo practico especial web dos - Giaconia</title>
        <link rel = "stylesheet" type = "text/css" href = "<?php echo constant("URL");?>css/style.css">
        <meta charset = "UTF-8">
        
    </head>

    <body>

        <header class="header">
            <nav class="naveg">

                <ul>
                    <li>
                        <a href="<?php echo constant("URL");?>inicio">Inicio</a>
                    </li>

                    <li>
                        <a href="<?php echo constant("URL");?>catalogo">Catalogo</a>
                    </li>
                    
                    <li>
                        <a href="<?php echo constant("URL");?>consulta">Consulta</a>
                    </li>
                    

                    <?php
                        if ($_SESSION['logged']){

                            if ($_SESSION["rol"] == 1){
                                echo "<li>
                                    <a href=" . constant('URL') ."administrar>Administrar</a>
                                </li>";
                            }

                            echo "<li>
                                    <form method='post' class='form-inline'>
                                        <input type='submit' name='desloggear' value='Cerrar sesion'/>
                                    </form>
                                </li>";

                            

                        } else{

                            echo "
                            <li>
                                <a href=" . constant("URL") ."login>Iniciar sesion</a>
                            </li>
                            <li>
                                <a href=" . constant("URL") . "register>Registrate!</a>
                            </li>";

                        }
                    ?>
                </ul>

            </nav>
        </header>

      


    </body>

</html>