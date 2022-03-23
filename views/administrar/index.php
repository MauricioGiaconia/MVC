
<!DOCTYPE html>



<html lang="en">

    <?php
        
        include "views/header.php";

    ?>

    <body>

        
        <div class="contenedor">

            <?php

                if ($_SESSION['rol'] != 1 || !$_SESSION['rol']){
                    echo "<p> No eres un administrador! </p>";
                } else{

            ?>
                <!-- Desconozco si esto es una mala practica o no -->

                <script src="scripts/appAdministrador.js">

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