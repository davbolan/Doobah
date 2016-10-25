$(document).ready(function(){
    // Evento que se ejecuta al seleccionar un pais
    $("#tema").click(function(){
        // Hacemos una peticion ajax al archivo selects_ajax.php pasando
        // como parametro el pais seleccionado en el formulario
        // Esperamos recibir un json con dos valores:
        //  result [0|1]
        //  contenido => codigo html a poner en el <select> de la ciudad
        $.post("./php/dameSubtaxonomias.php", {tema:$(this).val()}, function(data){
            $("#taxonomia").html(data.contenido)
            if(data.result==1)
            {
                $("#taxonomia").removeAttr('disabled');
            }else{
                $("#taxonomia").attr('disabled','disabled');
            }
        }, "json");
    });
    
    // Evento que se ejecuta al enviar el formulario
    // Revisamos que tenga seleccionado un pais y una ciudad
    $("#form1").submit(function(){
        if($("#pais").val()!="0" && $("#ciudad").val()!="0")
        {
            // Hay selecconado un pais y ciudad
            $(".error").html("").hide();
            return true;
        }else{
            // Falta seleccionar un pais o una ciudad o los dos
            $(".error").html("Selecciona un pais y una ciudad").show();
            return false;
        }
    });
});
