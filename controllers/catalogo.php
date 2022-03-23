<?php

    class Catalogo extends controller{

        private $mostrar = true;

        function __construct($_mostrar = true){

            parent::__construct();

            $mostrar = $_mostrar;
            
            if ($mostrar){
                $this->view->render("catalogo");
            }
            
        }

        function mostrarCatalogo($xinicio, $campo, $orden, $categoria = ""){

            header('Content-Type: application/json');
            echo json_encode($this->model->getCatalogo($xinicio, $campo, $orden, $categoria));   
        }

        function eliminarProducto($xid){

            $this->model->deleteItem($xid);
        }

        function verProducto($xid){

        
            header('Content-Type: application/json');
            echo json_encode($this->model->getProducto($xid));

        }

        function traerComentarios($xidProd, $xcampo, $xorden, $inicio = 0){

            header('Content-Type: application/json');
            echo json_encode($this->model->getComentarios($xidProd, $xcampo, $xorden, $inicio));
        }

        function publicarComentario(){

            header('Content-Type: application/json');

            $xaData = json_decode(file_get_contents("php://input"), true);
        
            $this->model->subirComentario($xaData);
        }
        
        function eliminarComentario($xid){
            header('Content-Type: application/json');

            
        
            $this->model->deleteComentario($xid);
        }
    }
?>