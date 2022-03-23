<?php


    class Registermodel extends Model{

        function __construct(){
            parent::__construct();
        }

        function registrarUser($aDatos){

            $conexion = $this->db->conexion();

            $consulta = "SELECT usuario, email
                            FROM usuarios
                            WHERE email = '$aDatos[email]' OR usuario = '$aDatos[user]'";

            $resultado = $conexion->prepare($consulta);

            $resultado->execute();

            $aResultado = $resultado->fetchAll(PDO::FETCH_OBJ);

            $existe = false;

            if (count($aResultado) > 0){
                         
                $existe = true;

                foreach($aResultado as $usuarioE){

                    if ($usuarioE->usuario == $aDatos["user"]){
                        echo "Usuario existente, elija otro";
                        echo "<br>";
                    } else if ($usuarioE->email == $aDatos["email"]){
                        echo "Email existente, ingrese otro";
                        echo "<br>";
                        
                    }
                }

            }
            
            if(!$existe){

                $contraHash = password_hash($aDatos['password'], PASSWORD_BCRYPT);

                $sql = "INSERT INTO usuarios(usuario, email, passw, rol) 
                        SELECT '$aDatos[user]', '$aDatos[email]', '$contraHash', (SELECT rol_id
                                                                                    FROM  roles AS r WHERE r.rol = 'usuario')
                        WHERE NOT EXISTS (SELECT email
                                        FROM usuarios
                                        WHERE email = '$aDatos[email]' OR usuario = '$aDatos[user]')";

                $conexion->exec($sql);

                include_once ("loginmodel.php");

                $login = new Loginmodel();

                $login->logear($aDatos);

            } else{
                //Agregar cartel de usuario existente
            }
            
            
            

        }
        
    }

?>