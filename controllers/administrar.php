<?php

    class Administrar extends controller{

        private $mostrar = true;

        function __construct($_mostrar = true){

            parent::__construct();

            $mostrar = $_mostrar;

            if ($mostrar){
                $this->view->render("administrar");
            }
            
        }

        function usuarios($cant = 0){

            header('Content-Type: application/json');
            echo json_encode($this->model->getUsuarios($cant));
        }

        function modificarUser($aSelects){

            $aSelects = explode(",", $aSelects);

            $aIdUser = array();
            $aIdRol = array();
            $aIds = array();
           
            echo var_dump($aSelects); 

            for ($i = 0; $i<count($aSelects); $i++){

                $aIds = explode(".", $aSelects[$i]);

                array_push($aIdUser, $aIds[0]);
                array_push($aIdRol, $aIds[1]);
                
            }

            echo "users: " . var_dump($aIdUser) . " roles: " . var_dump($aIdRol);
           
            $this->model->editUsers($aIdUser, $aIdRol);
        }

        function eliminarUser($xid){

            $this->model->deleteUser($xid);
        }
    }
    
?>