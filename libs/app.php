<?php

    require_once "controllers/errores.php";

    class App{

        function __construct(){
            $url = "";
    
            if (!empty($_GET["url"])){
                $url = $_GET["url"];
            }
    
            $url = rtrim($url, "/");
            $aurl = explode("/", $url);

            
            if (empty($aurl[0])){
                
                $archivoController = "controllers/inicio.php";
                require_once $archivoController;
                $controller = new Inicio;
                $controller->cargarModel("inicio");
                

            } else{

                $archivoController = "controllers/" . $aurl[0] . ".php";

                if (file_exists($archivoController)){

                    require_once $archivoController;

                    if (($aurl[0] == "catalogo" || $aurl[0] == "administrar") && count($aurl) > 1){
                        $controller = new $aurl[0](false);
                    } else{
                        $controller = new $aurl[0];
                    }

                    
                    $controller->cargarModel($aurl[0]);

                    if (isset($aurl[1])){

                        if (method_exists($controller, $aurl[1])){

                            switch (count($aurl)){

                                case 2: $controller->{$aurl[1]}();
                                break;

                                case 3: $controller->{$aurl[1]}($aurl[2]);
                                break;

                                case 4: $controller->{$aurl[1]}($aurl[2], $aurl[3]);
                                break;

                                case 5: $controller->{$aurl[1]}($aurl[2], $aurl[3], $aurl[4]);
                                break;

                                case 6: $controller->{$aurl[1]}($aurl[2], $aurl[3], $aurl[4], $aurl[5]);
                                break;
                            }
                            
                            
                        } 
                        
                    }

                } else{

                    $controller = new Errores();
                }

            } 
        }
    }

?>