
<html lang="es">
<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php $base_url?>/libreria/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php $base_url?>/libreria/assets/css/bootstrap-theme.min.css">
        <style>
            body { padding-top: 40px; }
        </style>
        <script src="<?php $base_url?>/libreria/assets/js/jquery-1.11.1.js"></script>
        <script src="<?php $base_url?>/libreria/assets/js/bootstrap.min.js"></script>
         <script src="<?php $base_url?>/libreria/assets/js/jquery.min.js"></script>
         <script  src="<?php $base_url?>/libreria/assets/js/noty/packaged/jquery.noty.packaged.min.js"></script>
        <script src="<?php $base_url?>/libreria/assets/js/ventas/ventas.js"></script>
        <title>Sistema de Libreria</title>
</head>
<body >
    
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?php echo base_url() ?>" ><span class="glyphicon  glyphicon-book  "></span> SIS-LIB</a>
        </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                      <!--li ><a href="<?php echo base_url() ?>">Inicio</a></li-->
                        <li class="active"><?php echo "<a href='" . base_url() . "index.php/controlador_venta/index/".$Codigo_Empleado."'> Venta</a>" ?></li>
                        <li><?php echo "<a href='" . base_url() . "index.php/controlador_apartado/index/".$Codigo_Empleado."'> Apartado</a>" ?></li>
                        <li><?php echo "<a href='" . base_url() . "index.php/controlador_inventario/index/".$Codigo_Empleado."'> Libros</a>" ?></li>
                        <li><?php echo "<a href='" . base_url() . "index.php/controlador_clientes/index/".$Codigo_Empleado."'> Clientes</a>" ?></li>
                        <?php if($Usuario=="admin"){
                             echo "<li><a href='" . base_url() . "index.php/controlador_empleados/index/".$Codigo_Empleado."'> Empleados</a></li>";
                        }?>
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $Nombre; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li id="codigo_empleado_login" style="display:none"><center><?php echo $Codigo_Empleado; ?></center></li>
                                <li><center>Usuario: <?php echo $Usuario; ?></center></li>
                                <li><a href="<?php echo base_url() ?>"><span class="glyphicon  glyphicon-off  "></span> Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase" role="main">
       <?php  date_default_timezone_set('America/Mexico_City');?>
<div class="panel panel-default">
                        <div class="panel-body">
                            <div class="page-header">
                                <h1>Venta</h1>
                            </div>
                            <span class="label label-default">Encabezado Venta</span>
                            <div style="border-color: #666; border-width: 1px; border-style: solid; width: 70%; -webkit-border-radius:16px;" >
                                    <div class="form-group" style="margin-top: 10px; margin-left: 10px">
                                       <div class="input-group"> <span class="input-group-addon">Folio</span>
                                           <input id="folio" name="folio" type="text" placeholder="Folio" autocomplete="on" readonly value="<?php echo $Folio?>">
                                       </div>  
                                    </div>                               
                                    <div class="form-group" style="margin-left: 10px; ">
                                        <div class="input-group"> <span class="input-group-addon">Fecha</span>
                                            <input name="fecha" type="text" placeholder="Fecha" autocomplete="on" value="<?php echo date("d/m/Y");?>" readonly>
                                         </div>
                                    </div>
                                    <div class="form-group" style="margin-left: 10px; ">
                                         <div class="input-group"> <span class="input-group-addon">Hora</span>
                                            <input name="hora" type="text" placeholder="Hora" autocomplete="on" value="<?php echo date("h:i:s A");?>" readonly>
                                          </div>
                                    </div>
                                    <div class="form-group"  style="margin-left: 10px; ">
                                            <div class="input-group"> <span class="input-group-addon">Código empleado</span>
                                                <input id='empleado' name="empleado" type="text" placeholder="Código empleado" autocomplete="on" readonly value="<?php echo $Codigo_Empleado;?>" >
                                            </div>
                                        <div>
                                            <h2><?php echo "Usuario: ".$Usuario?></h2>
                                            <h2><?php echo "Nombre: ".$Nombre?></h2>
                                        </div>
                                    </div>
                                    <div class="form-group"  style="margin-left: 10px; ">
                                           <div class="input-group"> <span class="input-group-addon">Código cliente</span>
                                               <input name="cliente" id="cliente" type="text" placeholder="Código cliente" autocomplete="on" class="<?php echo base_url();?>" >
                                               <a id="buscar_cliente" class=" btn btn-warning btn-xs" href="javascript:buscar_cliente();" >
                                                  <strong> <span class="glyphicon glyphicon-search"> </span> Buscar</strong>
                                                </a>
                                          </div>
                                        <div id="resultado_cliente"></div>
                                    </div>
                                <div class="form-group" style="margin-left: 10px; " >
                                            <div class="input-group"> <span class="input-group-addon">Código libro</span>
                                                <input id="libro" name="libro" type="text" placeholder="Nombre libro" autocomplete="on"  class="<?php echo base_url();?>">
                                                <a class=" btn btn-warning btn-xs" href="javascript:buscar_libro();">
                                                     <strong> <span class="glyphicon glyphicon-search"> </span> Buscar</strong>
                                                </a>
                                            </div>
                                            <div id="resultado_libro"></div>
                                    </div>
                                <div class="form-group" style="margin-left: 10px; ">
                                    <div id="resultado_apartado"></div>
                                </div>
                                
                            </div>
                            <div style="text-align: right">
                                <a class="btn-info btn-lg" href=<?php echo base_URL().'/index.php/controlador_venta/lista_ventas/'.$Codigo_Empleado?>>
                            <span class="glyphicon glyphicon-list-alt"></span> Todas las Ventas
                            </a>
                            </div>
                            <br>
                            <span class="label label-default">Listado de Libros</span>
                            <table id="tabla_venta" class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Existencias</th>
                                        <th>Cantidad</th>
                                        <th>Monto</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                </tbody>
                            </table>

                           <div class="form-group"  style="margin-left: 10px; ">
                               <div class="col-sm-3">
                                    <a class="btn-success btn-lg" href="javascript:realizar_venta();">
                                    <span class="glyphicon glyphicon-usd"></span> Realizar Venta
                                    </a>
                                </div>
                               <div class="col-sm-6">
                                   <a class="btn-danger btn-lg" href=<?php echo base_URL().'/index.php/controlador_venta/index/'.$Codigo_Empleado?>>
                                     <span class="glyphicon glyphicon-remove"></span> Cancelar
                                    </a>
                               </div>
                                    <div class="input-group" > <span class="input-group-addon">IVA</span>
                                              <input name="iva" id='iva' type="text" placeholder="IVA" autocomplete="on" readonly >
                                     </div>
                                     
                              </div>
                            <div class="col-sm-9"></div>
                                <div class="form-group"  style="margin-left: 10px; ">
                                    <div class="input-group"> <span class="input-group-addon">Total</span>
                                              <input name="total" id='total' type="text" placeholder="Total" autocomplete="on" readonly >
                                     </div>
                              </div>
                        </div>
                  </div>
<p class="footer"><center>© 2014 Universidad Veracruzana. Todos los Derechos Reservados</center></p>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form method="post" action="" id="eliminar">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Eliminar</h4>
      </div>
      <div class="modal-body">
        ¿Está seguro que desea eliminar este cliente?
      </div>
      <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>  Cerrar</button>
          <button class="btn btn-danger" type="submit" ><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
      </div>
       </form>
    </div>
  </div>
</div>
</body>
</html>
