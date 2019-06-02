$(document).ready(function () {
    /*=====================================================
        S U B I R    F O T O
    =====================================================*/
    $(document).on("click", '#btnAddUser', function(e){
        $('.nuevaFoto').val("");
        $(".img-previsualizar").attr("src", "view/img/usuarios/default/anonymous.png");
    })

    $(document).on("change", '.nuevaFoto', function(){

        var imagen = this.files[0];

        /* --------------------------------------------------------------------
            Validar Formato de Imagen con PNG o JPEG, con peso maximo de 2MB
        ---------------------------------------------------------------------*/

        if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){    //Imagen con archivo diferente
            $('.nuevaFoto').val("");    //Limpiamos Input
            //Alerta de Error
            swal({
                title: "Error al subir la imagen",
                text: "¡Imagen solo en formato JPEG o PNG!",
                type: "error",
                confirmButtonText: "Cerrar"
            })
        }else if(imagen["size"] > 2097152){ //Imagen superior a 2MB
            $('.nuevaFoto').val("");    //Limpiamos Input
            //Alerta de Error
            swal({
                title: "Error al subir la imagen",
                text: "¡Imagen maximo de 2MB!",
                type: "error",
                confirmButtonText: "Cerrar"
            })
        }else{
            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on("load",function(event){
                var rutaImagen = event.target.result;
                $(".img-previsualizar").attr("src", rutaImagen);
            });
        }
    });

    /*=====================================================
        E D I T A R   U S U A R I O
    =====================================================*/
    $(document).on("click",'.btnEditarUsuario',function(){
        var idUser = $(this).attr("idUser");

        var datos = new FormData();
        datos.append("idUsuario", idUser);
        
        $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json", //Tipo de dato como respuesta
            success: function(response){
                $('div#modalEditUser input#editarNombre').val(response["nombre"]);
                $('div#modalEditUser input#editarUsuario').val(response["usuario"]);
                $('div#modalEditUser #editarPerfil').val(response["perfil"]);
                $('div#modalEditUser #passwordActual').val(response["password"]);
                $('div#modalEditUser #fotoActual').val(response["foto"]);

                if(response["foto"] != null){
                    $('img.img-previsualizar').attr("src", response["foto"]);
                }else{
                    $('img.img-previsualizar').attr("src", "view/img/usuarios/default/anonymous.png");
                }
            }
        })
    });
    /*=====================================================
        A C T I V A R   U S U A R I O
    =====================================================*/
    $(document).on("click", '.btn.btn-xs.btn-activar-usuario', function(){
        var idUser = $(this).attr("idUsuario");
        var proximoEdoUsuario = $(this).attr("edoUsuario");

        var datos = new FormData();
        datos.append("activarId", idUser);
        datos.append("activarUsuario", proximoEdoUsuario);

        $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(ans){
                location.reload();
            }
        });
    });
    /*=====================================================
        E V I T A R   D O B L E   U S U A R I O
    =====================================================*/
    $(document).on("change",'input[type="text"]#nuevoUsuario', function(){

        $(this).parent().parent().find('.alert').remove();
        var nombreUsuario = $(this).val();

        var datos = new FormData();
        datos.append("validarUsuario", nombreUsuario);

        $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "post",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(ans){
                if(ans){
                    $('input[type="text"]#nuevoUsuario').parent().after('<div class="alert alert-warning"> Este usuario ya esta registrado</div>');
                    $('input[type="text"]#nuevoUsuario').val("");
                }
            }
        })
    });
    /*=====================================================
        E L I M I N A R   U S U A R I O
    =====================================================*/
    $(document).on("click", '.btnEliminarUsuario', function(){
        console.log("asda");

        var idUsuario = $(this).attr("idUsuario");
        var fotoUsuario = $(this).attr("fotoUsuario");
        var usuario = $(this).attr("usuario");

        swal({
          title: '¿Está seguro de borrar el usuario?',
          text: "¡Si no lo está puede cancelar la accíón!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar usuario!'
        }).then(function(result){
          if(result.value)
            window.location = "index.php?ruta=users&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
      
        });
    });
});