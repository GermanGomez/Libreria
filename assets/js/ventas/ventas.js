/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*$(document).on("click", ".eliminar", function () {
     var controlador = $(this).data('id');
     document.getElementById('eliminar').action=controlador ;
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});*/

function buscar_libro(){
    var valor=document.getElementById("libro").value;
    var base_url=document.getElementById("libro").getAttribute('class');
    var noty;
    if(valor!== ''){
        $.ajax({
            type: "POST",
            url: base_url+'index.php/controlador_inventario/buscar_libro',
            data: 'busqueda='+valor,
            datatype: 'html',
            cache: false,
            beforeSend: function(){
                          noty=show_noty('center','information','Buscando libros',0,true);
             },
             error: function(){
                  show_noty('topRight','error','Error en la búsqueda',1500,true);
            },
            success: function(data){
               
                $("#resultado_libro").empty();
                $("#resultado_libro").append(data);
                 noty.close();
            }
        });
    }else{
            $("#resultado_libro").empty();
            show_noty('topRight','warning','No se pueden buscar libros sin datos',1500,true);
    }
    /*return false;*/

}

function buscar_apartado(){
    var valor=document.getElementById("apartado").value;
    var base_url=document.getElementById("libro").getAttribute('class');
    var noty;
    if(valor!== ''){
        $.ajax({
            type: "POST",
            url: base_url+'index.php/controlador_inventario/buscar_libro',
            data: 'busqueda='+valor,
            datatype: 'html',
            cache: false,
            beforeSend: function(){
                          noty=show_noty('center','information','Buscando libros apartados',0,true);
             },
             error: function(){
                  show_noty('topRight','error','Error en la búsqueda',1500,true);
            },
            success: function(data){
               
                $("#resultado_apartado").empty();
                $("#resultado_apartado").append(data);
                 noty.close();
            }
        });
    }else{
            $("#resultado_apartado").empty();
            show_noty('topRight','warning','No se pueden buscar libros sin datos',1500,true);
    }
}


function show_noty(orientacion,tipo,mensaje,tiempo,kill){
         return noty({layout: orientacion,	
                  type: tipo,
	text: mensaje,
	dismissQueue: true, 
	animation: {
		open: {height: 'toggle'},
		close: {height: 'toggle'},
		easing: 'swing',
		speed: 500 
		},
		timeout: tiempo,
                                    killer: kill
                                                                    });     
}