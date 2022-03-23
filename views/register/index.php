<!DOCTYPE html>

<?php
    
    include "views/header.php";
?>


<html lang="en">
 
    <body>
        <div class="contenedor">

            <form action="<?php echo constant('URL');?>register/registrarUsuario" id="login" method="POST">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario..." >
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Ingrese su email...">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña...">
                <label for="password">Reingrese contraseña:</label>
                <input type="password" id="repassword" name="repassword" placeholder="Reingrese su contraseña...">

                <!-- Codigo para seleccionar el rol de un nuevo usuario a registrar
                <select name="tipoUser" id="tipoUser">

                    <?php
                        /*
                        $bd = new Database();

                        $con = $bd->conexion();

                        $sql = "SELECT * FROM roles";

                        $resultadoRol = $con->query($sql);
                        
                        if ($resultadoRol){
                           
                           foreach($resultadoRol as $row){
                                echo "<option value=$row[rol_id]>$row[rol]</option>";
                            }

                            
                        }*/
                    ?>

                </select> -->
                
                <button type="submit">Registrar</button>
            </form>

            
        </div>

        <?php
            include "views/footer.php";
        ?>
    </body>

</html>