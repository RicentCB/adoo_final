<?php
    class Conexion{

        static public function conectar(){

            $serv = "localhost";
            $db = "posexample";
            $user = "root";
            $pass = "";
    
            $link = new PDO("mysql:host=".$serv.";dbname=".$db."",
                        $user,
                        $pass);
    
            $link->exec("set names utf8");
    
            return $link;
    
        }
    
    }