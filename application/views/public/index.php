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
            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <center><table>
                    <tr>
                        <td><img class="img-thumbnail" src="<?php echo base_url() ?>assets/img/IMPALA.jpg" width="100px" height="100px"></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><h1 align="center"><?php echo $tituloPantalla; ?></h1></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><img class="img-thumbnail" src="<?php echo base_url() ?>assets/img/logo.jpg" width="100px" height="100px"></td>
                    </tr>
                </table></center>
            </div>

        </div> <!-- /container -->
     

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
        
    </body>
</html>

