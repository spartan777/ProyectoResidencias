<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/IMPALA.jpg">

        <title><?php echo $titulo; ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilos.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" />
    </head>

    <body>

        <div class="container">

            <!-- Static navbar -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">Proyecto residencias</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li id="navHome" ><a href="<?php echo base_url(); ?>jefe_carrera"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Inicio</a></li>
                                                        
                            <li id="navCatedratico" class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Catedrático <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>jefe_carrera/catedratico"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Consultar</a></li>
                                    <li><a href="<?php echo base_url(); ?>jefe_carrera/registro_catedratico"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Agregar</a></li>
                                </ul>
                            </li>
                            
                            <li id="navGrupo" class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span>&nbsp;Grupos <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>jefe_carrera/grupos"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Consultar</a></li>
                                    <li><a href="<?php echo base_url(); ?>jefe_carrera/registro_grupo"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Agregar</a></li>
                                </ul>
                            </li>
                            
                            
                            <li id="navMateria" class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span>&nbsp;Materias <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>jefe_carrera/materias"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Consultar</a></li>
                                    <li><a href="<?php echo base_url(); ?>jefe_carrera/registro_materia"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Agregar</a></li>
                                </ul>
                            </li>
                            <li id="navAsignar"><a href="<?php echo base_url(); ?>jefe_carrera/select_catedratico"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;Asignar Horario</a></li>
                            
                            <li id="navRegistro"><a href="<?php echo base_url(); ?>welcome/cerrar_sesion"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Cerrar Sesión</a></li>
                            <li><a><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Usuario: <?php echo $this->session->userdata['nombre_usuario']; ?></a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </nav>

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <h1 align="center"><?php echo $tituloPantalla; ?></h1>
            </div>

        </div> <!-- /container -->
        <br>
        <br>

        <section class="main container">
            <div class="row">
                <section class="posts col-md-12">
                    <?php $this->load->view($contenido); ?>
                </section>
            </div>
        </section>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src= "<?php echo base_url(); ?>assets/js/jquery-2.2.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/messages_es.js"></script>
        <script src="<?php echo base_url() ?>assets/js/validateForm.js"></script>
        <script src="<?php echo base_url() ?>assets/js/funcionesModal.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
               document.getElementById("<?php echo $nav; ?>").className = "active";
               
            });
            
            function sumar(){
                var h_teo = parseInt(document.getElementById("horas_teoricas").value);
                var h_prac = parseInt(document.getElementById("horas_practicas").value);
                var creditos = h_teo + h_prac;
               document.getElementById("creditos").value=creditos;
            }
        </script>
    </body>
</html>

