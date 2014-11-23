/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).on("click", ".eliminar", function () {
     var controlador = $(this).data('id');
     document.getElementById('eliminar').action=controlador ;
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});

function editar_existencia(codigo,existencia){
    var tabla_inventario=document.getElementById("tabla_inventario");
    var rowCount = tabla_inventario.rows.length;
 
            for(var i=1; i<rowCount; i++) {
                var row = tabla_inventario.rows[i];
                var code = row.cells[0].innerHTML;    
                if(null != code && code == codigo) {
                    activar_edicion(row,codigo,existencia);
                   
                }
            }
}

function activar_edicion(row,codigo,existencias){
    row.cells[9].innerHTML="<input id='txt_existencias_"+codigo+"' type='number'  min="+existencias+" max=999 value='"+existencias+"' style= 'width:50px; height:22px'> "+
    "<a id='btn_existencias_"+codigo+"' class='btn-success btn-xs' href='javascript:guardar_existencia("+codigo+ ")'>"+
                            "<span class='glyphicon glyphicon-upload'></span></a>";
    
}

function guardar_existencia(codigo){
    var nueva_existencia=$('#txt_existencias_'+codigo).val();
    var empleado=$('#codigo_sesion').val();
    var base_url=document.getElementById("edit_ext").getAttribute('class');
    var noty;
    if(validaciones_existencia(codigo)){
        
        $.ajax({
            type: "POST",
            url: base_url+'index.php/controlador_inventario/editar_existencia/',
            data: {codigo_libro:codigo,nueva_existencia:nueva_existencia,codigo_empleado:empleado},
            datatype: 'html',
            cache: false,
            beforeSend: function(){
                          noty=show_noty('center','information','Actualizando existenicias',0,true);
             },
             error: function(){
                  show_noty('center','error','Error en la actualización',1500,true);
            },
            success: function(data){
                 noty.close();
                 location.reload(); 
            }
        });
    }
}
function validaciones_existencia(codigo){
    var bandera=true;
    if(Number($('#txt_existencias_'+codigo).val())<Number($('#txt_existencias_'+codigo).attr('min')) && $('#txt_existencias_'+codigo).val()!=''){
       show_noty('center','error','La nueva existencia no puede ser menor a la actual',3000,false);
       bandera=false;
    }
    if(Number($('#txt_existencias_'+codigo).val())>999){
        show_noty('center','error','La nueva existencia no puede ser mayor a 999',3000,false);
        bandera=false;
    }
    if($('#txt_existencias_'+codigo).val()==''){
        show_noty('center','error','La nueva existencia no puede estar vacia o ser un valor no númerico',3000,false);
        bandera=false;
    }
    return bandera;
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