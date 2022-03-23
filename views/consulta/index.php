
<!DOCTYPE html>



<html lang="en">

    <?php
        
        include "views/header.php";

    ?>

    <body>

        
        <div id="contenedor">

            <?php

                if (!$_SESSION['logged']){
                    echo "<p> ¿Quieres hacer una consulta? <a href=login> Inicia sesion </a> o <a href=registro> registrate! </a> </p>";
                } else{

            ?>
                <!-- Desconozco si esto es una mala practica o no -->

                <form id="formConsulta" method="POST">
                    <label for="consulta">Consulta: </label>
                    <br>
                    <textarea id="areaConsulta" class="consulta" name="consulta" rows="10" cols="50" placeholder="Escribe tu consulta..."></textarea>
                    
                </form>

                <script src="scripts/appFunciones.js">
                
                </script>

            <?php
                }
            ?>
        </div>


        <?php
            require "views/footer.php";
        ?>
    </body>

</html>