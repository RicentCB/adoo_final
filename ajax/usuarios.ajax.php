<?php

    require_once "../controller/users.controller.php";
    require_once "../model/users.model.php";
    class ajaxUsuarios{
        /*=======================================================
            E D I T A R   U S U A R I O
        =======================================================*/
        public $idUsuario;

        public function ajaxEditarUsuario(){

            $item = "id_usuario";
            $valor = $this->idUsuario;
            $respuesta = ControllerUsers::ctrShowUser($item, $valor);

            echo json_encode($respuesta);
        }
        /*=======================================================
            A C T I V A R / D E S A C T I V A R    U S U A R I O
        =======================================================*/

        public $activarUsuario;
        public $activarId;

        public function ajaxActivarUsuario(){
            $tabla = "usuarios";
            
            $item1 = "estado";
            $valor1 = $this->activarUsuario;

            $item2 = "id_usuario";
            $valor2 = $this->activarId;

            $respuesta = ModelUsers::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
        }
        /*=======================================================
            E V I T A R   D O B L E    U S U A R I O
        =======================================================*/
        public $validarUsuario;
        public function ajaxValidarUsuario(){
            $item = "usuario";
            $valor = $this->validarUsuario;

            $ans = ControllerUsers::ctrShowUser($item, $valor);

            echo json_encode($ans);
        }
    }
/*----------------------------------------------
    E D I T A R   U S U A R I O
----------------------------------------------*/
if(isset($_POST["idUsuario"])){
    $editUser = new ajaxUsuarios();
    $editUser -> idUsuario = $_POST["idUsuario"];
    $editUser -> ajaxEditarUsuario();
    
}
/*----------------------------------------------
    DES/A C T I V A R   U S U A R I O
----------------------------------------------*/
if(isset($_POST["activarUsuario"])){
    $activarUsuario = new ajaxUsuarios();
    $activarUsuario -> activarUsuario = $_POST["activarUsuario"];
    $activarUsuario -> activarId = $_POST["activarId"];
    $activarUsuario -> ajaxActivarUsuario();
}
/*----------------------------------------------
    E V I T A R   D O B L E   U S U A R I O
----------------------------------------------*/
if(isset($_POST["validarUsuario"])){
    $validaUsuario = new ajaxUsuarios();
    $validaUsuario -> validarUsuario = $_POST["validarUsuario"];
    $validaUsuario -> ajaxValidarUsuario();
}