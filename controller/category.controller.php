<?php
    class ControladorCategorias{
        static public function ctrCrearCategoria(){
            if(isset($_POST["nuevaCategoria"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ ]+$/', $_POST["nuevaCategoria"])){
                    $tabla = "categorias";
                    $datos = $_POST["nuevaCategoria"];
                    $ans = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);
                    if($ans){
                        echo '<script>
                            swal({
                                type: "success",
                                title: "La categoria se ha guardado correctamenta",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result) => {
                                if(result.value){
                                    window.location = "category";
                                }
                            })
                        </script>';
                    }
                }else{
                    echo '<script>
                            swal({
                                type: "error",
                                title: "La categoria no puede ir vacia o llevar caracteres especiales",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result) => {
                                if(result.value){
                                    window.location = "category";
                                }
                            })
                        </script>';
                }
            }
        }
        /*===========================================
            M O S T R A R   C A T E G O R I A S
        ===========================================*/
        static public function ctrMostrarCategorias($item, $valor){
            $tabla = "categorias";
            $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
            
            return $respuesta; 
        }
    }