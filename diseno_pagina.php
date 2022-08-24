
<!doctype html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

     <link href="lib/bootstrap/estilos.css" rel="stylesheet">

     <link href="lib/estilos.css" rel="stylesheet">
   

        <script src="lib/jquery/js/jquery-3.4.1.min.js"></script>
    <script src="lib/bootstrap/js/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap-notify.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="lib/fontawesome/css/all.min.css">

  

 
    <!-- Bootstrap -->
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
<!--     <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    iCheck
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->
    
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <link href="build/css/custom.min.css" rel="stylesheet">

    <title>Medishop</title>

</head>
 <body class="nav-md" style="border: 0;">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">     




        <section>
            <?php
            require("menu.php");
            ?>
        </section>


            <section>
            <?php
           require("encabezado.php");
            ?>
        </section> 

            <section >
       <?php
            if ($permiso_acceso == true) {
                require_once($ruta_archivo);
            } else {
            ?>
           
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />   
          <div class="alert alert-danger mt-2" style="left: 110px;" role="alert">
                    Acceso denegado !!!
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>

               
            <?php
            }
            ?>
        </section>

        <section>
            <?php
            require("pie.php")
            ?>

        </section>
    </div>
</div>
</div>
</div>

</body>


    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="build/js/custom.min.js"></script> 


</html>