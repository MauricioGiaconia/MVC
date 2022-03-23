<?php

    class CatalogoModel extends Model{

        function __construct(){

            parent::__construct();
        }

        function getCatalogo($inicio, $campo, $orden, $xcategoria){

            session_start();

            $cant_x_pag = 2;

            $bd = $this->db->conexion();

            $resultadoRol = "";
            $consulta = "";
            $catalogo = "";
            $aCatalogo = [];
            $admin = 0;
            
            if (array_key_exists("rol", $_SESSION)){
        
                $resultadoRol = $bd->prepare("SELECT rol
                                            FROM roles
                                            WHERE rol_id = " . $_SESSION['rol'] . "");
                $resultadoRol->execute();
                $rol = $resultadoRol->fetch(PDO::FETCH_OBJ);

                if ($rol->rol == "admin"){
                    $admin = 1;
                } else{
                    $admin = 0;
                }

            } 
            

            $consulta = "SELECT pro.id_producto as id, pro.nombre, pro.descripcion, pro.precio, (SELECT cat.nombre
                                                                                                    FROM categorias as cat
                                                                                                    WHERE cat.id_categoria = pro.categoria) as namecat, $admin as 'admini'
                        FROM productos as pro
                        ORDER BY $campo $orden";

            if (!empty($xcategoria)){
                $consulta .= " WHERE pro.categoria = $xcategoria";
            }

            $consulta .= " LIMIT $inicio, $cant_x_pag";
                    
            $catalogo = $bd->prepare($consulta);
            $catalogo->execute();

            $consultaCantidad = "SELECT count(*) AS 'cantidad' FROM productos";
            $cantidadProductos = $bd->prepare($consultaCantidad);
            $cantidadProductos->execute();
            $aCant = $cantidadProductos->fetch();
            $paginas = ceil($aCant["cantidad"] / $cant_x_pag);
            
            $consultaCategorias = "SELECT id_categoria FROM categorias";
            $categorias = $bd;

          
            $aCatalogo = ["resultado" => $catalogo->fetchAll(PDO::FETCH_OBJ), "cantidad" => $paginas, "cantxpag" => $cant_x_pag];

                
            return $aCatalogo;

            
        }

        function deleteItem($xid){

            $bd = $this->db->conexion();

            $consultaComentarios = "DELETE FROM comentarios WHERE id_prod = $xid";
            $sql = $bd->prepare($consultaComentarios);
            $sql->execute();

            $consulta = "DELETE FROM productos 
                        WHERE id_producto = $xid";

            $sql = $bd->prepare($consulta);
            $sql->execute();

        }

        function getProducto($xid){

            $bd = $this->db->conexion();

            $consulta = "SELECT pro.id_producto as id, pro.nombre, pro.descripcion, pro.precio, (SELECT cat.nombre
                                                                                                    FROM categorias as cat
                                                                                                    WHERE cat.id_categoria = pro.categoria) as namecat
                            FROM productos as pro
                            WHERE pro.id_producto = $xid";

            $producto = $bd->prepare($consulta);
            $producto->execute();

            $aProducto = $producto->fetchAll(PDO::FETCH_OBJ);

            return $aProducto;
        }

        function getComentarios($xidprod, $xcampo, $xorden, $inicio){

            $bd = $this->db->conexion();

            $cant_x_pag = 2;

            $comentarioConsulta = "SELECT com.id, com.comentario, com.puntaje, (SELECT u.usuario
                                                                                FROM usuarios as u
                                                                                WHERE com.id_user = u.user_id) AS nomuser, com.fecha
                                    FROM comentarios as com
                                    WHERE com.id_prod = $xidprod
                                    ORDER BY $xcampo $xorden
                                    LIMIT $inicio, $cant_x_pag";

            $comentarios = $bd->prepare($comentarioConsulta);
            $comentarios->execute();

            $aComentarios = $comentarios->fetchAll(PDO::FETCH_OBJ);

            session_start();

            $aUserLoggeado = array();

            if(!array_key_exists('logged', $_SESSION) || !$_SESSION['logged']){
        
                $aUserLoggeado = ["loggeado" => false];
        
            } else{
                
                $aUserLoggeado = ["user_id" => $_SESSION["id"], "user" => $_SESSION["usuario"], "rol" => $_SESSION["rol"], "loggeado" => $_SESSION["logged"]];
            }


            $consultaCantidad = "SELECT count(*) AS 'cantidad' FROM comentarios WHERE id_prod = $xidprod";
            $cantidadComentarios = $bd->prepare($consultaCantidad);
            $cantidadComentarios->execute();
            $aCant = $cantidadComentarios->fetch();
            $paginas = ceil($aCant["cantidad"] / $cant_x_pag);

            $aResultado = ["comentarios" => $aComentarios, "cantidad" => $paginas, "cant_x_pag" => $cant_x_pag, "user" => $aUserLoggeado];

            return $aResultado;

        }

        function subirComentario($xaData){

            $bd = $this->db->conexion();

            
            $consulta = "INSERT INTO comentarios(comentario, puntaje, id_user, id_prod, fecha)
                         SELECT '$xaData[comentario]', $xaData[puntaje], $xaData[user], $xaData[producto], CURRENT_TIMESTAMP";
         
            $bd->exec($consulta);
        }

        function deleteComentario($xid){

            $bd = $this->db->conexion();
            $consulta = "DELETE FROM comentarios WHERE id = $xid";

            $sql = $bd->prepare($consulta);
            $sql->execute();
        }
    }

?>