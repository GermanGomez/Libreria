
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
          <ul class="nav navbar-nav">
            <!--li ><a href="<?php echo base_url() ?>">Inicio</a></li-->
            <li><?php  echo "<a href='".base_url()."index.php/controlador_venta/'> Venta</a>"?></li>
            <li><?php  echo "<a href='".base_url()."index.php/controlador_apartado/'> Apartado</a>"?></li>
            <li><?php  echo "<a href='".base_url()."index.php/controlador_inventario/'> Libros</a>"?></li>
            <li ><?php  echo "<a href='".base_url()."index.php/controlador_clientes/'> Clientes</a>"?></li>
            <li class="active"><?php  echo "<a href='".base_url()."index.php/controlador_proveedores/'> Proveedores</a>"?></li>
            <li><?php  echo "<a href='".base_url()."index.php/controlador_empleados/'> Empleados</a>"?></li>
          </ul>
                <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">admin <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url() ?>">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
          <!--form class="navbar-form navbar-right" role="search" action="<?php echo base_url()."index.php/controlador_inicio/iniciar_sesion"?>"  method="post">
             
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
                <a class="btn-link">
                    <span class="glyphicon glyphicon-log-pencil"></span>
                    Registrarse
                </a>
            </form-->
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase" role="main">
<div class="panel panel-default">
<div class="panel-body">
    <form class="form-horizontal"  method="post" role="search" action="<?php echo $Controlador;?>">
        <div class="page-header">
            <h1><?php echo $Titulo ?> </h1>
             <?php echo validation_errors("<div class='alert alert-danger' role='alert'>","</div>");?>
        </div>
        <span class="label label-default">Datos del Registro</span>
        <div id="eseste" style="border-color: #666; border-width: 1px; border-style: solid; width: 50%; -webkit-border-radius:16px;" >
            <div style="margin-top:20px">
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Código: </label>
                  <div class="col-sm-9">
                        <input name="codigo" placeholder="Código del proveedor" type="text" class="form-control" value=<?php echo $Codigo; ?>>
                  </div>
                 </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Nombre: </label>
                  <div class="col-sm-9">
                        <input name="nombre" placeholder="Nombre del proveedor" type="text" class="form-control" value=<?php echo $Nombre_Empresa; ?>>
                  </div>
                 </div>
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Teléfono: </label>
                  <div class="col-sm-9">
                        <input name="telefono" placeholder="Teléfono de proveedor" type="text" class="form-control" value=<?php echo $Telefono; ?>>
                  </div>
                 </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Correo: </label>
                  <div class="col-sm-9">
                      <input name="correo" placeholder="Correo del proveedor @" type="email" class="form-control" value=<?php echo $Correo; ?>>
                  </div>
                 </div>
                   <div class="form-group">
                  <label class="col-sm-2 control-label">Agemte de Ventas: </label>
                  <div class="col-sm-9">
                        <input name="agente" placeholder="Agente de Ventas" type="text" class="form-control" value=<?php echo $Agente_Ventas; ?>>
                  </div>
                 </div>
                 
                <div class="form-group">
                    <div class="col-sm-4" style="margin-left: 20px;">
                     <!--button class="btn-success  btn-lg" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Agregar</button-->
                       <?php echo $Boton; ?>    
                    </div>
                    <div class="col-sm-4"style="margin-left: 10px; margin-top: 10px">
                        <a class="btn-danger  btn-lg" href=<?php echo base_url()."/index.php/controlador_proveedores/"?>><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</a>
                    </div>
                </div>
                 
            </div>
           
        </div>
</form>
</div>
</div>
   
<p class="footer"><center>© 2014 Universidad Veracruzana. Todos los Derechos Reservados</center></p>
</div>

</body>
</html>