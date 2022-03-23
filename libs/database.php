<?php

    class Database{

        private $host;
        private $db;
        private $user;
        private $password;
        private $charset;

        function __construct(){

            $this->host = constant("HOST");
            $this->db  = constant("DBNAME");
            $this->user = constant("USER");
            $this->password = constant("PASSWORD");
            $this->charset = constant("CHARSET");

        }

        function conexion(){

            try{

                $pdo = new PDO("mysql:host=" . $this->host . "; dbname=". $this->db ."; charset=" . $this->charset . "", $this->user, $this->password);

                return $pdo;
        
                } catch(Exception $e){
        
                    echo ("Error: " . $e->GetMessage());
        
            }
        
            
        }
    }

?>