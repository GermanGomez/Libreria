<!DOCTYPE html>
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
                    <a class="navbar-brand" href="<?php echo base_url() ?>" ><span class="glyphicon  glyphicon-book  "></span> SIS-LIB</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--ul class="nav navbar-nav">
                       <li class="active"><a href="<?php echo base_url() ?>">Inicio</a></li>
                      <li><?php echo "<a href='" . base_url() . "index.php/controlador_venta/'> Venta</a>" ?></li>
                      <li><?php echo "<a href='" . base_url() . "index.php/controlador_apartado/'> Apartado</a>" ?></li>
                      <li><?php echo "<a href='" . base_url() . "index.php/controlador_inventario/'> Libros</a>" ?></li>
                      <li><?php echo "<a href='" . base_url() . "index.php/controlador_clientes/'> Clientes</a>" ?></li>
                      <li><?php echo "<a href='" . base_url() . "index.php/controlador_proveedores/'> Proveedores</a>" ?></li>
                      <li><?php echo "<a href='" . base_url() . "index.php/controlador_empleados/'> Empleados</a>" ?></li>
                    </ul-->

                    <form class="navbar-form navbar-right" role="search" action="<?php echo base_url() . "index.php/controlador_inicio/iniciar_sesion" ?>"  method="post">

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <input name="usuario" type="text" class="form-control" placeholder="Usuario" autocomplete="on" size="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon  glyphicon-asterisk "></span></div>
                                <input name="contrasenia" type="password" class="form-control" placeholder="Contraseña" size="10" >
                            </div>

                        </div>
                        <button type="submit" class="btn-primary btn-sm">
                            <span class="glyphicon glyphicon-log-in"></span>
                            Iniciar Sesión</button>
                    </form>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container theme-showcase" role="main">

            <div class="panel panel-default">
                <?php echo validation_errors("<div class='alert alert-danger' role='alert'>","</div>");?>  
                <div class="panel-body">
                    <div class="jumbotron">
                        <h1>Sistema de Administracion Libreria</h1>
                        <p>Este sistema esta dedicado a la Gestion, Venta y Apartado de libros de la libreria "LIBRERIA "</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h3>Misión</h3>
                                    <p>Brindar un servicio de calidad, a un precio justo,
                                        comprometidos con la satisfaccion de nuestros clientes. </p>

                                </div>
                            </div>                                     
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h3>Visión</h3>
                                    <p>Ser una libreria competitiva y lider  en nuestro mercado, con amplia
                                        participación, con nuestros clintes atendiendo sus necesidades.</p>

                                </div>
                            </div>                                     
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h3>Empleado del Mes</h3>
                                    <p>Juan Carlos </p>

                                </div>
                            </div>                                     
                        </div>
                    </div>
                </div>
            </div>
            <p class="footer"><center>© 2014 Universidad Veracruzana. Todos los Derechos Reservados</center></p>
    </div>

</body>
</html>