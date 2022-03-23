<?php


    class Administrarmodel extends Model{

        function __construct(){
            parent::__construct();
        }

        function getUsuarios($inicio){

            $bd = $this->db->conexion();
            $cant_x_pag = 2;

            session_start();

            $idActual = $_SESSION['id'];

            $consulta = "SELECT user.user_id, user.usuario, user.email, (SELECT rol
                                                                        FROM roles as urol
                                                                        WHERE user.rol = urol.rol_id) AS user_rol, (SELECT rol_id
                                                                                                                        FROM roles as urol
                                                                                                                        WHERE user.rol = urol.rol_id) AS rid
                        FROM usuarios as user
                        WHERE user.user_id != $idActual
                        LIMIT $inicio, $cant_x_pag";
            $resultado = $bd->prepare($consulta); 
            $resultado->execute();

            $roles = "SELECT * FROM roles";
            $resultadoRoles = $bd->prepare($roles);
            $resultadoRoles->execute();
            
            $consultaCantidad = "SELECT count(*) AS 'cantidad' FROM usuarios AS u WHERE u.user_id != $idActual";
            $cantidadUsers = $bd->prepare($consultaCantidad);
            $cantidadUsers->execute();
            $aCant = $cantidadUsers->fetch();
            $paginas = ceil($aCant["cantidad"] / $cant_x_pag);

            $aUsuarios = ["resultado" => $resultado->fetchAll(PDO::FETCH_OBJ), "cantidad" => $paginas, "cantxpag" => $cant_x_pag, "roles" => $resultadoRoles->fetchAll(PDO::FETCH_OBJ)];

            return $aUsuarios;
        }

        function deleteUser($xid){

            $bd = $this->db->conexion();

            $consulta = "DELETE FROM usuarios as u WHERE u.user_id = $xid";

            $sql = $bd->prepare($consulta);
            $sql->execute();

        }

        function editUsers($aIdUsers, $aIdRoles){

            $bd = $this->db->conexion();

            for ($i = 0; $i<count($aIdUsers); $i++){

                $consulta = "UPDATE usuarios AS u
                            SET u.rol = $aIdUsers[$i] 
                            WHERE u.user_id = $aIdRoles[$i]";
                $sql = $bd->prepare($consulta);
                $sql->execute();            

            }
        }

        
    }

?>