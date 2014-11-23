
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
        <script src="<?php $base_url?>/libreria/assets/js/empleados/eliminar_empleado.js"></script>
        <title>Sistema de Librerias</title>
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
            <a class="navbar-brand" href="#" ><span class="glyphicon  glyphicon-book  "></span> SIS-LIB</a>
        </div>
                        <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                      <!--li ><a href="<?php echo base_url() ?>">Inicio</a></li-->
                        <li><?php echo "<a href='" . base_url() . "index.php/controlador_venta/index/".$Codigo_Empleado."'> Venta</a>" ?></li>
                        <li><?php echo "<a href='" . base_url() . "index.php/controlador_apartado/index/".$Codigo_Empleado."'> Apartado</a>" ?></li>
                        <li ><?php echo "<a href='" . base_url() . "index.php/controlador_inventario/index/".$Codigo_Empleado."'> Libros</a>" ?></li>
                        <li ><?php echo "<a href='" . base_url() . "index.php/controlador_clientes/index/".$Codigo_Empleado."'> Clientes</a>" ?></li>
                        <?php if($Usuario_Empleado=="admin"){
                             echo "<li class='active'><a href='" . base_url() . "index.php/controlador_empleados/index/".$Codigo_Empleado."'> Empleados</a></li>";
                        }?>
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $Nombre_Empleado; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li id="codigo_empleado_login" style="display:none"><center><?php echo $Codigo_Empleado; ?></center></li>
                                <li><center>Usuario: <?php echo $Usuario_Empleado; ?></center></li>
                                <li><a href="<?php echo base_url() ?>"><span class="glyphicon  glyphicon-off  "></span> Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase" role="main">
        <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="page-header">
                                <h1>Empleados</h1>
                            </div>
                            <form  method="post" role="search" action="<?php echo base_url()."index.php/controlador_empleados/buscar_empleado/";?>">
                            <div  >
                                    <input type="hidden" value="<?php echo $Codigo_Empleado; ?>" name="codigo_sesion" id="codigo_sesion">
                                   <span class="label label-default">Búsqueda de empleados</span>
                                   <div class="form-group">
                                   <div class="input-group">
                                        
                                       
                                       <div class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></div>
                                        <input type="text" placeholder="Búsqueda" autocomplete="on" name="busqueda">
                                        <button class="btn-warning btn-default">
                                            <span class="glyphicon glyphicon-search"></span> Buscar
                                        </button>
                                    </div>
                            </div>
                            </div>
                            </form>
                            <span class="label label-default">Listado de empleados</span>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Correo</th>
                                        <th>Usuario</th>
                                        <th>Contraseña</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($empleados){
                                            foreach ($empleados->result() as $empleado){
                                                echo "<tr>".
                                                        "<td>".$empleado->Codigo."</td>".
                                                        "<td>".$empleado->Nombre."</td>".
                                                        "<td>".$empleado->Telefono."</td>".
                                                        "<td>".$empleado->Direccion."</td>".
                                                        "<td>".$empleado->Correo."</td>".
                                                        "<td>".$empleado->Usuario."</td>".
                                                        "<td>".$empleado->Contrasenia."</td>".
                                                        "<td  style='text-align: match-parent'> 
                                                            <a class='btn-primary btn-xs' href=". base_url()."index.php/controlador_empleados/editar_empleado/".$empleado->ID."/".$Codigo_Empleado.">
                                                                <span class='glyphicon glyphicon-edit'></span> Editar
                                                            </a>
                                                            <button data-id=". base_url()."index.php/controlador_empleados/eliminar_empleado/".$empleado->ID."/".$Codigo_Empleado."  class='eliminar btn-danger btn-xs' data-toggle='modal' data-target='#myModal'>
                                                                 <span class='glyphicon glyphicon-trash'></span> Eliminar
                                                            </button>
                                                         </td>
                                                         </tr>";
                                            }
                                        
                                        
                                        }
                                        
                                        ?>
                                </tbody>
                            </table>
                            <a class="btn-success btn-lg" href=<?php echo base_URL().'/index.php/controlador_empleados/agregar_empleado/'.$Codigo_Empleado?>>
                            <span class="glyphicon glyphicon-plus"></span> Agregar Empleado
                            </a>
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
        ¿Está seguro que desea eliminar este empleado?
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