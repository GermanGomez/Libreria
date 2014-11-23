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
function buscar_cliente(){
    var valor=document.getElementById("cliente").value;
    var base_url=document.getElementById("cliente").getAttribute('class');
    var noty;
    if(valor!== ''){
        $.ajax({
            type: "POST",
            url: base_url+'index.php/controlador_clientes/buscar_cliente_por_nombre',
            data: 'busqueda='+valor,
            datatype: 'html',
            cache: false,
            beforeSend: function(){
                          noty=show_noty('center','information','Buscando cliente',0,true);
             },
             error: function(){
                  show_noty('center','error','Error en la búsqueda',1500,true);
            },
            success: function(data){
               
                $("#resultado_cliente").empty();
                $("#resultado_cliente").append(data);
                 noty.close();
            }
        });
    }else{
            $("#resultado_cliente").empty();
            show_noty('center','warning','No se pueden buscar clientes sin datos',1500,true);
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

function seleccionar_cliente(fila){
    var codigo =document.getElementById('tabla_cliente').rows[fila].cells[0].innerHTML;
    var nombre=document.getElementById('tabla_cliente').rows[fila].cells[1].innerHTML;
    var correo=document.getElementById('tabla_cliente').rows[fila].cells[2].innerHTML;
    document.getElementById("cliente").value=codigo;
    document.getElementById("cliente").readOnly=true;
    document.getElementById("buscar_cliente").href='javascript:cambiar_cliente()';
    document.getElementById("buscar_cliente").className='btn btn-info btn-xs';
    document.getElementById("buscar_cliente").innerHTML="<strong> <span  class='indicator glyphicon glyphicon-pencil'> </span> Cambiar Usuario</strong>";
    document.getElementById("buscar_cliente").style="display:none";
    $('#resultado_cliente').empty();
    $('#resultado_cliente').append("<h2 id=nombre_cliente> Nombre: "+nombre+"</h2>");
    buscar_apartado_cliente();
}

function cambiar_cliente(){
    $('#resultado_cliente').empty();
    $("#resultado_apartado").empty();
    document.getElementById("cliente").readOnly=false;
     document.getElementById("cliente").value="";
    document.getElementById("buscar_cliente").href='javascript:buscar_cliente()';
    document.getElementById("buscar_cliente").className='btn btn-warning btn-xs';
    document.getElementById("buscar_cliente").innerHTML="<strong> <span  class='indicator glyphicon glyphicon-search'> </span> Buscar</strong>";
    
}


function buscar_apartado_cliente(){
    var base_url=document.getElementById("cliente").getAttribute('class');
    var codigo_cliente=document.getElementById("cliente").value;
    var noty;
     $.ajax({
            type: "POST",
            url: base_url+'index.php/controlador_apartado/buscar_apartados_detalle_por_cliente',
            data: {busqueda:codigo_cliente},
            datatype: 'html',
            cache: false,
            beforeSend: function(){
                          noty=show_noty('center','information','Buscando apartados cliente',0,true);
             },
             error: function(){
                  show_noty('center','error','Error en la búsqueda',3000,true);
            },
            success: function(data){
                $("#resultado_apartado").empty();
                $("#resultado_apartado").append(data);
                 noty.close();
            }
        });
}
function agregar_libro(codigo){
        if(findRow(codigo)){
            show_noty('center','error','Este libro ya esta agregado en la lista de libros por apartar',2000,true);
        }else{
            deleteRow('tabla_libro',codigo,true);
        }      
}

 function borrarFilaTablaApartado(codigo){
          calcular_monto_total();
     activa_apartado(codigo);
     deleteRow('tabla_venta',codigo,false);

 }
 function activa_apartado(codigo){
             try {
            var table = document.getElementById('tabla_detalle');
            var rowCount = table.rows.length;
 
            for(var i=1; i<rowCount; i++) {
                var row = table.rows[i];
                var code = row.cells[0].innerHTML;
                if(null != code && code == codigo) {
                    document.getElementById('btn_apartado_'+codigo).style.display="";
                }
              }
            }catch(e) {
                show_noty('topRight','error',""+e,1500,true);
            }
 }
 function deleteRow(tableID,codigo,bandera) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=1; i<rowCount; i++) {
                var row = table.rows[i];
                var code = row.cells[0].innerHTML;
                
                if(null != code && code == codigo) {
                        if(bandera){
                            addRow(row,codigo);
                        }
                        table.deleteRow(i);
                        return;
                        rowCount--;
                        i--;
                }
 
 
            }
            }catch(e) {
                show_noty('topRight','error',e,1500,true);
            }
      }
      
   function findRow(codigo){
        try {
            var table = document.getElementById('tabla_venta');
            var rowCount = table.rows.length;
 
            for(var i=1; i<rowCount; i++) {
                var row = table.rows[i];
                var code = row.cells[0].innerHTML;
                if(null != code && code == codigo) {
                    return true;
                }
              }
            return false;
            }catch(e) {
                show_noty('topRight','error',""+e,1500,true);
            }
      }
      function addRow(fila,codigo) {
                    var tabla_apartado=document.getElementById('tabla_venta').getElementsByTagName('tbody')[0];;
                    var fila_apartado=tabla_apartado.insertRow(tabla_apartado.rows.length);
                    fila_apartado.appendChild(fila.cells[0]);
                    fila_apartado.appendChild(fila.cells[0]);
                    fila_apartado.appendChild(fila.cells[0]);
                    fila_apartado.appendChild(fila.cells[0]);
                    fila.cells[0].style.display="";
                    fila_apartado.appendChild(fila.cells[0]);
                    var cell=fila_apartado.insertCell(5);
                    cell.innerHTML="<input readonly id='monto_"+codigo+"' type='text' size='10'>";
                    fila_apartado.appendChild(cell);
                    fila.cells[0].innerHTML="<a class=' btn btn-danger' href='javascript:borrarFilaTablaApartado("+codigo+")'><span class='glyphicon glyphicon-minus-sign'>";
                    fila_apartado.appendChild(fila.cells[0]);
      }
      
function actualizar_montos(codigo){
    //alert(document.getElementById("existencias_"+codigo).value);
    var input=Number($('#existencias_'+codigo).val());
    if(input==""){show_noty('center','error','La cantidad de venta no puede estar vacia o ser un valor no numerico',2000,true); 
        $('#monto_'+codigo).val("");
        calcular_monto_total();
        return;}
    if(input>Number($('#existencias_libro_'+codigo).html())){
        show_noty('center','error','La cantidad de venta no puede ser mayor a la existencia',2000,true);
        $('#monto_'+codigo).val("");
        calcular_monto_total();
        return;}
    if(input==0){
        show_noty('center','error','La cantidad de venta no puede ser 0',2000,true);
        $('#monto_'+codigo).val("");
        calcular_monto_total();
        return;
    }
    $('#monto_'+codigo).val(Number($('#precio_'+codigo).html())*input);
    calcular_monto_total();
}

function calcular_monto_total(){
        var monto_total=0;
        try {
            var table = document.getElementById('tabla_venta');
            var rowCount = table.rows.length;
            for(var i=1; i<rowCount; i++) {
                var row = table.rows[i];
                var code = Number(row.cells[5].childNodes[0].value);
                if(!isNaN(code) && code!="" ) {
                     monto_total+=code;
                }
              }
              $('#iva').val(monto_total*0.16);
              $('#total').val(monto_total);
            return false;
            }catch(e) {
                show_noty('topRight','error',""+e,1500,true);
            }
}

function seleccionar_libro(codigo){
    
     if(findRow(codigo)){
          try {
            var table = document.getElementById('tabla_detalle');
            var rowCount = table.rows.length;
            for(var i=1; i<rowCount; i++) {
                var row = table.rows[i];
                var code = row.cells[0].innerHTML;
                if(null != code && code == codigo) {   
                   if((Number(row.cells[2].innerHTML) + Number(document.getElementById('existencias_'+codigo).value))
                           >Number(document.getElementById('existencias_libro_'+codigo).innerHTML)){
                        show_noty('center','error',"No se puede agregar los libros apartados si en conjunto con los seleccionados para la compra superan las existencias actuales",7000,true);
                    }else{
                        $('#existencias_'+codigo).val(Number(row.cells[2].innerHTML) + Number(document.getElementById('existencias_'+codigo).value));
                        actualizar_montos(codigo);
                        document.getElementById('btn_apartado_'+codigo).style="display:none";
                    }
                }
              }
            }catch(e) {
                show_noty('topRight','error',""+e,1500,true);
            }
     }else{
            show_noty('center','warning',"Es necesario primero buscar el libro y agregarlo a la venta para agregar la cantidad apartada",7000,true);
     }
}
function validaciones_venta(){
    var bandera=true;
    if($('#nombre_cliente').length>0){
        
    }else{
        show_noty('center','error','No ha seleccionado un cliente que desee apartar libros',3000,false);
        bandera=false;
    }
    if(document.getElementById("tabla_venta").rows.length==1){
        show_noty('center','error',"No se puede realizar una venta si no ha seleccionado al menos un libro para ser vendido",3000,false);
        bandera=false;
    }
            try {
            var table = document.getElementById('tabla_venta');
            var rowCount = table.rows.length;
            for(var i=1; i<rowCount; i++) {
                var row = table.rows[i];
                var code = Number(row.cells[5].childNodes[0].value);
                if(code!="" ) {
                     if(Number(code)>Number(row.cells[4].innerHTML)){
                         show_noty('center','error',"El libro "+row.cells[1].innerHTML+" debe tener una cantidad menor o igual a la existencia actual para ser vendido",3000,false);
                         bandera=false;
                    }
                }else{
                    bandera=false;
                    show_noty('center','error',"El libro "+row.cells[1].innerHTML+" debe tener un valor númerico valido mayor a cero para ser vendido",3000,false);
                }
              }
            }catch(e) {
                show_noty('topRight','error',""+e,1500,true);
            }
    return bandera;
}

function realizar_venta(){
    var base_url=document.getElementById("cliente").getAttribute('class');
    if(validaciones_venta()){
            var noty;
        $.ajax({
            type: "POST",
            url: base_url+'index.php/controlador_venta/realizar_venta',
            data: {cliente:$('#cliente').val(),folio:$('#folio').val(),empleado:$('#empleado').val(),total:$('#total').val(),tabla_venta:tabla_venta_toJSON()},
            datatype: 'html',
            cache: false,
            beforeSend: function(){
                          noty=show_noty('center','information','Buscando apartados cliente',0,true);
             },
             error: function(){
                  show_noty('center','error','Error en la búsqueda',3000,true);
            },
            success: function(data){
                 noty.close();
                 show_noty('top','success',"Venta realizada con exito",1500,false);
                 window.location.assign(base_url+"index.php/controlador_venta/index/"+document.getElementById("empleado").value);
            }
        });
    }
}

function tabla_venta_toJSON(){
          try {
            var table = document.getElementById('tabla_venta');
            var rowCount = table.rows.length;
            var arreglo=[];
            for(var i=1; i<rowCount; i++) {
                var row = table.rows[i];
                var code = row.cells[0].innerHTML;
                 arreglo[i-1]={codigo_libro:row.cells[0].innerHTML,nombre_libro: row.cells[1].innerHTML,
                     precio_unitario:row.cells[2].innerHTML,existencias:row.cells[3].innerHTML,
                     cantidad:row.cells[4].childNodes[0].value,monto:row.cells[5].childNodes[0].value};
              }
            }catch(e) {
                show_noty('topRight','error',""+e,1500,true);
            }
            return arreglo;
  }