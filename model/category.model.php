<?php
    // require "conexion.php";

    class ModeloCategorias{
        /*========================================
            C R E A R    C A T E G O R I A
        ========================================*/
        static public function mdlIngresarCategoria($tabla, $datos){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (categoria, fecha) VALUES (:categoria, CURRENT_TIME)");
            $stmt -> bindParam(":categoria", $datos, PDO::PARAM_STR);

            if($stmt->execute())
                return true;
            else
                return false;

            $stmt -> close();
            $stmt = null;

        }
        /*==========================================
            M O S T R A R    C A T E G O R I A
        ==========================================*/
        static public function mdlMostrarCategorias($tabla, $item, $valor){
        
            if($item != null){
                $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE $item LIKE :$item");
                $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
                $stmt -> execute();
                
                return $stmt -> fetch();

            }else{//Mostrar todo el contenido
                $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
                $stmt -> execute();
                
                return $stmt -> fetchAll();

            }
            $stmt -> close();
            $stmt = null;
        }
    
    }