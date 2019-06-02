<?php
    require "conexion.php";
    
    class ModelUsers{
        /*=========================================
          M O S T R A R    U S U A R I O S
        =========================================*/
        static public function mdlMostrarUsuarios($tabla, $item, $valor){
            if($item != NULL){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item LIKE :$item "); 
                $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
                $stmt -> execute();
                
                return $stmt -> fetch();
            }else{
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla"); 
                $stmt -> execute();
                
                return $stmt -> fetchAll();
            }
                

            $stmt -> NULL;
        }
        /*=========================================
          A G R E G A R   U S U A R I O S
        =========================================*/
        static public function mdlAddUser($tabla, $data){
            $sql = "INSERT INTO $tabla (nombre, usuario, password, perfil, foto, estado, ultimo_login, fecha_reg) ";
            $sql .= " VALUES (:nombre, :usuario, :password, :perfil, :foto, '0', CURRENT_DATE, CURRENT_TIME)";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":usuario", $data["usuario"], PDO::PARAM_STR);
            $stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
            $stmt -> bindParam(":perfil", $data["perfil"], PDO::PARAM_STR);
            $stmt -> bindParam(":foto", $data["ruta"], PDO::PARAM_STR);

            if($stmt -> execute()){
                return true;
            }else{
                return false;
            }

            $stmt -> close();
            $stmt -> NULL;
        }
        /*=========================================
          E D I T A R   U S U A R I O S
        =========================================*/
        static public function mdlEditarUsuario($tabla, $data){

            $sql = "UPDATE $tabla SET `nombre` = :nombre, perfil = :perfil, password = :password, foto = :foto ";
            $sql .= " WHERE `usuario` LIKE :usuario";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
            $stmt -> bindParam(":usuario", $data["usuario"], PDO::PARAM_STR);
            $stmt -> bindParam(":perfil", $data["perfil"], PDO::PARAM_STR);
            $stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
            $stmt -> bindParam(":foto", $data["foto"], PDO::PARAM_STR);

            if($stmt -> execute()){
                return true;
            }else{
                return false;
            }

            $stmt -> close();
            $stmt -> null;
        }
        /*=========================================
          A C T I V A R   U S U A R I O 
        =========================================*/
        static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

            $sql = "UPDATE $tabla SET `$item1` = :$item1 WHERE `$item2` LIKE :$item2 ";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
            $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

            if($stmt -> execute()){
                return true;
            }else{
                return false;
            }

            $stmt -> close();
            $stmt -> null;
        }
        /*=========================================
          B O R R A R   U S U A R I O 
        =========================================*/
        static public function mdlBorrarUsuario($tabla, $datos){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id");
            $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
            if($stmt -> execute())
                return true;
            else
                return false;	
    
            $stmt -> close();
            $stmt = null;
    
        }
    }