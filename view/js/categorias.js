$(document).ready(function(){
    /*========================================
        E D I T A R    C A T E G O R I A
    ========================================*/
    $('.btn.btnEditarCategoria').click(function(){
        var idCategoria = $(this).attr("idCategoria");

        var datos = new FormData();
        datos.append("idCategoria", idCategoria);

        $.ajax({
            url: "ajax/categorias.ajax.php",
            method: "post",
            data: datos,
            cahce: false,
            contentType: false,
            processData: false,
            dataType: "json",
            sucess: function(ans){
                console.log(ans);
            }
        })
    })
});