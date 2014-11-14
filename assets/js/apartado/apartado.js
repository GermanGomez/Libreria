/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function buscar_libro(){
    var valor=document.getElementById("libro").value;
    var base_url=document.getElementById("libro").getAttribute('class');
    var noty;
    if(valor!== ''){
        $.ajax({
            type: "POST",
            url: base_url+'index.php/controlador_inventario/buscar_libro_por_nombre',
            data: 'busqueda='+valor,
            datatype: 'html',
            cache: false,
            beforeSend: function(){
                          noty=show_noty('center','information','Buscando libros',0,true);
             },
             error: function(){
                  show_noty('center','error','Error en la búsqueda',1500,true);
            },
            success: function(data){
               
                $("#resultado_libro").empty();
                $("#resultado_libro").append(data);
                 noty.close();
            }
        });
    }else{
            $("#resultado_libro").empty();
            show_noty('center','warning','No se pueden buscar libros sin datos',1500,true);
    }
    /*return false;*/

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
    $('#resultado_cliente').empty();
    $('#resultado_cliente').append("<h2 id=nombre_cliente>"+nombre+"</h2>");
    
}

function cambiar_cliente(){
    $('#resultado_cliente').empty();
    document.getElementById("cliente").readOnly=false;
     document.getElementById("cliente").value="";
    document.getElementById("buscar_cliente").href='javascript:buscar_cliente()';
    document.getElementById("buscar_cliente").className='btn btn-warning btn-xs';
    document.getElementById("buscar_cliente").innerHTML="<strong> <span  class='indicator glyphicon glyphicon-search'> </span> Buscar</strong>";
}

function agregar_libro(codigo){
    
    if(findRow(codigo)){
        show_noty('center','error','Este libro ya esta agregado en la lista de libros por apartar',2000,true);
    }else{
        deleteRow('tabla_libro',codigo,true);
    }
       
}

 function borrarFilaTablaApartado(codigo){
     deleteRow('tabla_apartado',codigo,false);
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
            var table = document.getElementById('tabla_apartado');
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
                    var tabla_apartado=document.getElementById('tabla_apartado');
                    var fila_apartado=tabla_apartado.insertRow(tabla_apartado.rows.length);
                    var cell1=fila_apartado.insertCell(0);
                    cell1.appendChild(document.createTextNode(fila.cells[0].innerHTML));
                    var cell2=fila_apartado.insertCell(1);
                    cell2.appendChild(document.createTextNode(fila.cells[1].innerHTML));
                    var cell3=fila_apartado.insertCell(2);
                    cell3.appendChild(document.createTextNode(fila.cells[2].innerHTML));
                    var cell4=fila_apartado.insertCell(3);
                    cell4.appendChild(document.createTextNode(fila.cells[3].innerHTML));
                    fila.cells[4].style.display="";
                    fila_apartado.appendChild(fila.cells[4]);
                    fila.cells[4].innerHTML="<a class=' btn btn-danger' href='javascript:borrarFilaTablaApartado("+codigo+")'><span class='glyphicon glyphicon-minus-sign'>";
                    fila_apartado.appendChild(fila.cells[4]);

        }
        
function apartar_libro(){
    var base_url=document.getElementById("cliente").getAttribute('class');
    var table=document.getElementById("tabla_apartado");
    var noty;
    var validacion_cliente=validar_cliente();
    var validacion_tabla=validar_tabla_apartado(table);
    var validacion_cantidad=validar_cantidad(table)
        if(   validacion_cliente &&  validacion_tabla && validacion_cantidad){
            $.ajax({
                type: "POST",
                url: base_url+'index.php/controlador_apartado/registrar_apartado',
                data: {codigo_cliente:document.getElementById("cliente").value, 
                          codigo_empleado:document.getElementById("empleado").value,
                          folio:document.getElementById("folio").value,},
                datatype: 'html',
                cache: false,
                beforeSend: function(){
                              noty=show_noty('center','information','Buscando cliente',0,true);
                 },
                 error: function(){
                      show_noty('center','error','Error en la búsqueda',1500,true);
                },
                success: function(data){

                     noty.close();
                }
            });
            alert('entro');
        }
  }
  function validar_tabla_apartado(table){
      if(table.rows.length>1){
          return true;
      }
      show_noty('center','error','No ha agregado libros para apartar',3000,false);
      return false;
  }
  function validar_cliente(){
      if($('#nombre_cliente').length>0){
          return true;
      }
      show_noty('center','error','No ha seleccionado un cliente que desee apartar libros',3000,false);
      return false;
  }
  function validar_cantidad(table){
      var bandera=true;
      if(table.rows.length>1){
          for(var i=1;i<table.rows.length;i++){
              var fila=table.rows[i];
              var cantidad=fila.cells[4].childNodes[0].value;
              var existencia=fila.cells[3].innerHTML;
              if(cantidad<=0){
                   show_noty('center','error','El libro '+fila.cells[1].innerHTML+' no se puede apartar con una cantidad de cero o estar en blanco',3000,false);
                  bandera= false;
              }
              if(cantidad>existencia){
                  show_noty('center','error','El libro '+fila.cells[1].innerHTML+' no puede apartar una cantidad mayor a la existencia',3000,false);
                  bandera= false;
              }
          }
      }
      return bandera;
  }