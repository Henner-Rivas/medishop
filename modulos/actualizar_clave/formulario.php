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
                    <h2>Cambiar clave </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
 <div id="" class="content mt-5 mb-5" style="width:500px; margin:auto; ">

   

             <form id="formulario" method="post" action="">

             <div class="form-group row">
                     <label for="clave" class="col-sm-3 col-form-label">Clave actual</label>
                     <div class="col-sm-9">
                         <input type="password" class="form-control" id="clave0" name="clave0" placeholder="Clave actual">
                     </div>
                 </div>

                 <div class="form-group row">
                     <label for="clave" class="col-sm-3 col-form-label">Nueva clave</label>
                     <div class="col-sm-9">
                         <input type="password" class="form-control" id="clave1" name="clave1" placeholder="Clave">
                     </div>
                 </div>
                   <div class="form-group row">
                     <label for="clave" class="col-sm-3 col-form-label"> nueva clave</label>
                     <div class="col-sm-9">
                         <input type="password" class="form-control" id="clave2" name="clave2" placeholder="Repita nueva clave">
                     </div>
                 </div>

                 <hr />

          

                  <div class="form-group row mb-0">
                        <div id="div-pb" class="col-sm-12 text-center" style="display: none">
                            <img src="img/pb.gif" />
                        </div>

                        <div id="div-btn" class="col-sm-12 text-right">

                                                     <button type="button" id="btn-actualizar" class="btn btn-success">Cambiar</button>

                             <li class="btn btn-secondary" >
                      <a class="enlaceboton" href="?modulo=contenido1&accion=ver">
                        <span   >Regresar</span>
                      </a>
                    </li> 
                        </div>
                    </div>
         </div>
             </form>
         </div>
     </div>


 </div>
 <script>
     $("#btn-actualizar").click(function() {
         $("#div-btn").hide();
         $("#div-pb").show();

         var p = $("#formulario").serialize();
         $.post("?modulo=actualizar_clave&accion=cambiar", p, function(respuesta) {
             $("#div-btn").show();
             $("#div-pb").hide();

             try {
                var r = jQuery.parseJSON(respuesta);


                if (r.error == true) {
                    $.notify({
                        message: r.msg
                    }, {
                        type: 'danger',
                        delay: 0
                    });
                } else {

                 


                    $.notify({
                        message: r.msg
                    }, {
                        type: 'success',
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