$(document).ready(function () {
    recargarCliente();
    recargarPedido();
    $('#lista-id').on("change", function () {
        recargarCliente();
        
    })
})

// ---------------Ajax------------------
function recargarCliente() {
    $.ajax({
        type: "POST",
        url: "./datos.php",
        data: "cliente=" + $('#lista-id').val(),
        dataType: 'json',
        success: function (response) {
            if($('#nombre') == "undefined"){
                $('#nombre').val("");
            }
            $('#nombre').val(response.nombre +' '+ response.apellidos);
            $('#pedidos').val(response.pedido);
            $('#telefono').val(response.telefono);
            $('#direccion').val(response.direccion);
            

        }
    })
}
 // ----------------- Recargar Pedido -------------------
function recargarPedido() {

    // El onclick funciona
    $("#nuevo-pedido").on("click", function (e) {
        e.preventDefault();
        
        datos = {
            id: $('#lista-id').val(),
            pedido: $('#pedido').val(),
            direccion: $('#direccion').val()
        
        }
        console.log(datos);
        
        $.ajax({
            data: datos,
            type: "POST",
            url: "lista.php",
            success: (response) => {
                respuesta = JSON.parse(response);
                // con el metodo Object.keys(arrayJson).length puedes obtener la longuitud del array de un objeto json.
                tabla = $('#datos-tabla');
                            tabla.append(`
                            <tr id="${respuesta[Object.keys(respuesta).length-1].id}">
                            <th scope="row">${respuesta[Object.keys(respuesta).length-1].id}</th>
                            <td>${respuesta[Object.keys(respuesta).length-1].id_cliente}</td>
                            <td>${respuesta[Object.keys(respuesta).length-1].producto}</td>
                            <td>${respuesta[Object.keys(respuesta).length-1].direccion}</td>
                          </tr>`);
                        
                   
                    

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
              }
        })
    })

}