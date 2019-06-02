<?php
    require_once "../controller/category.controller.php";
    require_once "../model/category.model.php";

    class AjaxCategorias{
        /*========================================
            E D I T A R    C A T E G O R I A
        ========================================*/
        public $idCategoria;
        public function ajaxEditarCategoria(){
            $item = "id_categoria";
            $valor = $this->idCategoria;

            $ans = ControladorCategorias::ctrMostrarCategorias($item, $valor);
            echo json_encode($ans);

        }
    }
/*----------------------------------------
    E D I T A R    C A T E G O R I A
----------------------------------------*/   
if(isset($_POST["idCategoria"])){
    $categoria = new AjaxCategorias();
    $categoria -> idCategoria = $_POST["idCategoria"];
    $categoria -> ajaxEditarCategoria();

}