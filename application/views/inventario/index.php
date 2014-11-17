<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php $base_url ?>/libreria/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php $base_url ?>/libreria/assets/css/bootstrap-theme.min.css">
        <style>
            body { padding-top: 40px; }
        </style>
        <script src="<?php $base_url ?>/libreria/assets/js/jquery-1.11.1.js"></script>
        <script src="<?php $base_url ?>/libreria/assets/js/bootstrap.min.js"></script>
        <script src="<?php $base_url ?>/libreria/assets/js/inventario/eliminar_inventario.js"></script>
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
                    <a class="navbar-brand" href="#" ><span class="glyphicon  glyphicon-book  "></span> SIS-LIB</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                      <!--li ><a href="<?php echo base_url() ?>">Inicio</a></li-->
                        <li><?php echo "<a href='" . base_url() . "index.php/controlador_venta/'> Venta</a>" ?></li>
                        <li><?php echo "<a href='" . base_url() . "index.php/controlador_apartado/'> Apartado</a>" ?></li>
                        <li class="active"><?php echo "<a href='" . base_url() . "index.php/controlador_inventario/index/".$Codigo_Empleado."'> Libros</a>" ?></li>
                        <li ><?php echo "<a href='" . base_url() . "index.php/controlador_clientes/'> Clientes</a>" ?></li>
                        <?php if($Usuario=="admin"){
                             echo "<li><a href='" . base_url() . "index.php/controlador_empleados/'> Empleados</a></li>";
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
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h1>Catalogo de Libros</h1>
                    </div>
                    <form  method="post" role="search" action="<?php echo base_url() . "index.php/controlador_inventario/buscar_inventario/"; ?>">
                        <div  >
                            <input type="hidden" value="<?php echo $Codigo_Empleado; ?>" name="codigo_sesion">
                            <span class="label label-default">Búsqueda de Libros</span>
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
                    <span class="label label-default">Catalogo de Libros</span>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="active">
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Editorial</th>
                                <th>Autor</th>
                                <th>Edicion</th>
                                <th>Año</th>
                                <th>Pais</th>
                                <th>Costo</th>
                                <th>Precio Venta</th>
                                <th>Existencias</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($inventarios) {
                                foreach ($inventarios->result() as $inventario) {
                                    echo "<tr>" .
                                    "<td>" . $inventario->Codigo . "</td>" .
                                    "<td>" . $inventario->Nombre . "</td>" .
                                    "<td>" . $inventario->Editorial . "</td>" .
                                    "<td>" . $inventario->Autor . "</td>" .
                                    "<td>" . $inventario->Edicion . "</td>" .
                                    "<td>" . $inventario->Anio . "</td>" .
                                    "<td>" . $inventario->Pais . "</td>" .
                                    "<td>" . $inventario->Costo . "</td>" .
                                    "<td>" . $inventario->Precio_Venta . "</td>" .
                                    "<td>" . $inventario->Existencias . "</td>" .
                                    "<td  style='text-align: match-parent'> 
                                                            <a class='btn-primary btn-xs' href=" . base_url() . "index.php/controlador_inventario/editar_inventario/".$Codigo_Empleado."/" . $inventario->ID . ">
                                                                <span class='glyphicon glyphicon-edit'></span> Editar
                                                            </a>
                                                            <button data-id=" . base_url() . "index.php/controlador_inventario/eliminar_inventario/".$Codigo_Empleado."/" . $inventario->ID . "  class='eliminar btn-danger btn-xs' data-toggle='modal' data-target='#myModal'>
                                                                 <span class='glyphicon glyphicon-trash'></span> Eliminar
                                                            </button>
                                                         </td>
                                                         </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <a class="btn-success btn-lg" href=<?php echo base_URL() . '/index.php/controlador_inventario/agregar_inventario/'.$Codigo_Empleado ?>>
                        <span class="glyphicon glyphicon-plus"></span> Nuevo Libro
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
                        ¿Está seguro que desea eliminar este Libro?
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