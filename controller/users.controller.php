<?php

    class ControllerUsers{
		/*===========================================
			I N G R E S O   D E   U S U A R I O S
		===========================================*/
		static public function ctrLoginUser(){ 
			if(isset($_POST["ingUser"])){
				//Intento de Logeo
				if((preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUser"]))
				 && (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"]))){
						$tabla = "usuarios";	//Nombre de la Tabla

						$item = "usuario";		//Columna a Verficar
						$valor = $_POST["ingUser"];

						//Encriptar contraseña
						$crPassword = crypt($_POST["ingPassword"], '$2a$08$abb55asfrga85df8g42g8fDDAS58olf973adfacmY28n05$');

						$respuesta = ModelUsers::mdlMostrarUsuarios($tabla, $item, $valor);

						if($respuesta["usuario"] == $_POST["ingUser"]
							&& $respuesta["password"] == $crPassword){
								if($respuesta["estado"] == '1'){
									//Coincide 
									$_SESSION["login"] = true;
									//Creamos variables de Sesion
									$_SESSION["user"] = $respuesta;
									//Capturar Fecha y Hora de Login
									date_default_timezone_set('America/Mexico_City');
									$fechaActual = date('Y-m-d H:i:s');
									//
									$item1 = "ultimo_login";
									$valor1 = $fechaActual;
									$item2 = "id_usuario";
									$valor2 = $respuesta["id_usuario"];

									$ultimoLogin = ModelUsers::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

									if($ultimoLogin)	//Redireccionando
										echo '<script>location.reload(true);</script>';
								}else{
									echo '<br><div class="alert alert-danger">El usuario no esta activado</div>';
								}
							
						}else{
							echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
						}
					}
			}
		}
		/*===========================================
			R E G I S T R O  D E   U S U A R I O S
		===========================================*/
		static public function ctrCreateUser(){
			if(isset($_POST["nuevoUsuario"])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) &&
					preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoUsuario"]) &&
					preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoPassword"])){

					/*========================================
						V A L I D A R    I M A G E N
					========================================*/
					
					$ruta = NULL;

					if(isset($_FILES["nuevaFoto"]["tmp_name"]) && $_FILES["nuevaFoto"]["tmp_name"] != ""){
						list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
						
						$nuevoAncho = 500;
						$nuevoAlto = 500;

						/*---------------------------------------------
							CREAR DIRECTORIO DONDE SE GUARDA LA FOTO
						---------------------------------------------*/
						$directorio = "view/img/usuarios/".$_POST["nuevoUsuario"];
						mkdir($directorio, 0755);

						/*---------------------------------------------
							DE ACUERDO AL TIPO DE IMAGEN ACCIONES
						---------------------------------------------*/
						$rand = mt_rand(100, 999);

						//------------------ IMAGEN JPEG ------------------
						if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
							//Guardamos Imagen en el Directorio
							$ruta = "view/img/usuarios/".$_POST["nuevoUsuario"]."/".$rand.".jpeg";
							
							$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

						}
						if($_FILES["nuevaFoto"]["type"] == "image/png"){
							//Guardamos Imagen en el Directorio
							$ruta = "view/img/usuarios/".$_POST["nuevoUsuario"]."/".$rand.".png";
							
							$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagepng($destino, $ruta);

						}

					}
					
					$tabla = "usuarios";

					$crPassword = crypt($_POST["nuevoPassword"], '$2a$08$abb55asfrga85df8g42g8fDDAS58olf973adfacmY28n05$');
					$datos = array(
						"nombre"=>$_POST["nuevoNombre"],
						"usuario" => $_POST["nuevoUsuario"],
						"password" => $crPassword,
						"perfil" => $_POST["nuevoPerfil"],
						"ruta" => $ruta);

					$respuesta = ModelUsers::mdlAddUser($tabla, $datos);

					if($respuesta){
						echo '<script>
									swal({
										type: "success",
										title: "El usuario se ha guardado correctamente",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then((result=>{
										if(result.value){
											window.location = "users"
										}
									}))
								</script>';
					}else{
						echo '<script>
									swal({
										type: "error",
										title: "Error al añadir usuario",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then((result=>{
										if(result.value){
											window.location = "users"
										}
									}))
								</script>';
					}
					
				}else{
					echo '<script>
									swal({
										type: "error",
										title: "El usuario no puede ir vacio ni llevar caracteres especiales",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then((result=>{
										if(result.value){
											window.location = "users"
										}
									}))
								</script>';
				} 
				
			}
		}
		/*===========================================
			M O S T R A R   U S U A R I O S
		===========================================*/
		static public function ctrShowUser($item, $valor){
			$tabla = "usuarios";

			$ans = ModelUsers::mdlMostrarUsuarios($tabla, $item, $valor);

			return $ans;
		}
		/*===========================================
			E D I T A R   U S U A R I O
		===========================================*/
		static public function ctrEditUser(){
			if(isset($_POST["editarUsuario"])){
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombre"]) ){

					/*==========================================================
						V A L I D A R   I M A G E N
					==========================================================*/
					$ruta = $_POST["fotoActual"];
					if(isset($_FILES["editarFoto"]["tmp_name"]) && $_FILES["editarFoto"]["tmp_name"] != ""){
						list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
						
						$nuevoAncho = 500;
						$nuevoAlto = 500;

						/*---------------------------------------------
							CREAR DIRECTORIO DONDE SE GUARDA LA FOTO
						---------------------------------------------*/
						$directorio = "view/img/usuarios/".$_POST["editarUsuario"];
						
						/*--------------------------------------------
							PREGUNTAR SI EXISTE FOTO EN LA DB
						--------------------------------------------*/
						if(!empty($_POST["fotoActual"])){
							unlink($_POST["fotoActual"]);
						}else{//Creamos Directorio
							mkdir($directorio, 0755);
						}

						/*---------------------------------------------
							DE ACUERDO AL TIPO DE IMAGEN ACCIONES
						---------------------------------------------*/
						$rand = mt_rand(100, 999);

						//------------------ IMAGEN JPEG ------------------
						if($_FILES["editarFoto"]["type"] == "image/jpeg"){
							//Guardamos Imagen en el Directorio
							$ruta = "view/img/usuarios/".$_POST["editarUsuario"]."/".$rand.".jpeg";
							
							$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagejpeg($destino, $ruta);

						}
						if($_FILES["editarFoto"]["type"] == "image/png"){
							//Guardamos Imagen en el Directorio
							$ruta = "view/img/usuarios/".$_POST["editarUsuario"]."/".$rand.".png";
							
							$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
							imagepng($destino, $ruta);

						}
					}

					
					//Posible Cambio de Contraseña
					$crPassword  = "";
					if($_POST["editarPassword"] != ""){
						if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["editarPassword"])){
							$crPassword = crypt($_POST["editarPassword"], '$2a$08$abb55asfrga85df8g42g8fDDAS58olf973adfacmY28n05$');
						}else{
							echo '<script>
									swal({
										type: "warning",
										title: "La contraseña no puede llevar caracteres especiales",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then((result=>{
										if(result.value){
											window.location = "users"
										}
									}))
								</script>';
						}
					}else{	//Editar Password viene vacio, no se modificara contraseña
						$crPassword = $_POST["passwordActual"];
					}
					$tabla = "usuarios";
					$datos = array(
						"nombre"=>$_POST["editarNombre"],
						"usuario" => $_POST["editarUsuario"],
						"password" => $crPassword,
						"perfil" => $_POST["editarPerfil"],
						"foto" => $ruta);
					
					$respuesta = ModelUsers::mdlEditarUsuario($tabla, $datos);

					if($respuesta){//Usuario guardado con exito
						echo '<script>
									swal({
										type: "success",
										title: "Usuario guardado con exito",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then((result=>{
										if(result.value){
											window.location = "users"
										}
									}))
								</script>';
					}else{//Error al guardar usuario
						echo '<script>
									swal({
										type: "error",
										title: "Error al guardar usuario '.$respuesta.'",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then((result=>{
										if(result.value){
											window.location = "users"
										}
									}))
								</script>';
					}
				}else{//Nombre no valido
					echo '<script>
									swal({
										type: "warning",
										title: "Nombre no puede ir vacio o llevar caracteres especiales",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then((result=>{
										if(result.value){
											window.location = "users"
										}
									}))
								</script>';
				}
			}
		}
		/*===========================================
			B O R R A R   U S U A R I O
		===========================================*/
		static public function ctrBorrarUsuario(){
			if(isset($_GET["idUsuario"])){
	
				$tabla ="usuarios";
				$datos = $_GET["idUsuario"];
	
				if($_GET["fotoUsuario"] != ""){
					unlink($_GET["fotoUsuario"]);
					rmdir('vistas/img/usuarios/'.$_GET["usuario"]);
				}
	
				$respuesta = ModelUsers::mdlBorrarUsuario($tabla, $datos);
	
				if($respuesta){
					echo'<script>
					swal({
							type: "success",
							title: "El usuario ha sido borrado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
									if (result.value) 
										window.location = "users";
								})
					</script>';
				}		
			}
		}
  }