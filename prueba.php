
<!doctype html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link href="lib/estilos.css" rel="stylesheet">
     <link  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="lib/jquery/js/jquery-3.4.1.min.js"></script>
    <script src="lib/bootstrap/js/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap-notify.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <title>Medishop</title>
 <style>
    /*Codigos universales de la pagina*/
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
    }
    /*Codigo opcional - Fondo de la pagina*/
 
    /*---*/
    body, .modal{
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal{
        position: fixed;
        top: 0;
        left: 0;
        background: rgba(0,0,0,0.5);
        transition: all 500ms ease;
        opacity: 0;
        visibility: hidden;
    }
    #btn-modal:checked ~ .modal{
        opacity: 1;
        visibility: visible;
    } 
    .contenedor{
        width: 400px;
        height: 300px;
        margin: auto;
        background: #fff;
        box-shadow: 1px 7px 25px rgba(0,0,0,0.6);
        transition: all 500ms ease;
        position: relative;
        transform: translateY(-30%);
    }
    #btn-modal:checked ~ .modal .contenedor{
        transform: translateY(0%);
    } 
    .contenedor header{
        padding: 10px;
        background: #db8046;
        color: #fff;
    }
    .contenedor label{
        position: absolute;
        top: 10px;
        right: 10px;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
    }
    #btn-modal{
        display: none;
    }
    .lbl-modal{
        background: #fff;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
    }
    @media only screen and (min-width:320px) and (max-width:768px){
        .contenedor{
            width: 95%;
        }
    }
    </style>

</head>
 <body >
  <label for="btn-modal" class="lbl-modal">Abrir Modal</label>
  <div class="modal">
    <div class="contenedor">
      <header>¡Bienvenidos!</header>
      <label for="btn-modal">X</label>
      <div class="contenido">
        <!-- Agrega algun mensaje  -->
      </div>
    </div>
  </div>
</body>


    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="build/js/custom.min.js"></script> 


</html>