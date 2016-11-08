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
                            <li id="navInicio" ><a href="<?php echo base_url(); ?>">Inicio</a></li>
                            <li id="navIniciarSesion"><a href="<?php echo base_url(); ?>welcome">Inicio de Sesión</a></li>
                            <li id="navRegistro"><a href="<?php echo base_url(); ?>welcome/registro">Registrate</a></li>
                        </ul>
                        </li>
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
        <script type="text/javascript">
        $(document).ready(function(){
           document.getElementById("<?php echo $nav; ?>").className = "active"; 
        });
    </script>
    </body>
</html>

