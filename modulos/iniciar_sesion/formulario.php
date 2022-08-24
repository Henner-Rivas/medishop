<?php if (isset($_SESSION['usuario']) == true) { ?>
     <div class="alert alert-danger mt-2" role="alert">
         Acceso denegado !!!
     </div>
 <?php
        return;
    } ?>
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
                    <h2>Iniciar sesiòn </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <div  style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    

             <form id="formulario" method="post" action="guardar.php">



                 <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="usuario" >                                        
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="clave" type="password" class="form-control" name="clave" placeholder="Contraseña" >
                            </div>

                 

                 <hr />
                 <div class="form-group row mb-0">
                     <div id="div-pb" class="col-sm-12 text-center" style="display: none">
                         <img src="img/pb.gif" />
                     </div>
                     <div id="div-btn" class="col-sm-12 text-right">
                         <button type="button" id="btn-iniciar" class="btn btn-lg btn-block btn-info">Iniciar</button>

                          
                     </div>

                 </div>

                 <div class="form-group">
                     <!--            <div class="col-md-12 control">
                                   
                                    <div style="float:right; font-size: 100%; position: relative; top:-10px;padding-top:18px;"><a href="?modulo=recuperar_clave&accion=ver">¿Se te olvid&oacute; tu contraseña?</a></div>

                                </div>
 -->
                                   <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        No tiene una cuenta! <a href="?modulo=crear-usuario&accion=ver">Registrate aquí</a>
                                    </div>
                                </div>
                            </div>    
                     </div>    
             </form>
         </div>
     </div>

</div>
</div>
</div>
</div>
 </div>
 <script>
     $("#btn-iniciar").click(function() {
         $("#div-btn").hide();
         $("#div-pb").show();

         var p = $("#formulario").serialize();
         $.post("?modulo=iniciar-sesion&accion=iniciar", p, function(respuesta) {
             $("#div-btn").show();
             $("#div-pb").hide();

             try {

                 var r = jQuery.parseJSON(respuesta);
                 if (r.error == false) {
                     window.location = "?modulo=contenido1&accion=ver";
                 } else {
                     $.notify({
                         message: r.msg
                     }, {
                         type: 'danger',
                         delay: 0
                     });
                 }


             } catch (error) {
                 $.notify({
                     message: error + "<br/></br>" + respuesta
                 }, {
                     type: 'danger',
                     delay: 0
                 });
             }



         });
     });
 </script>