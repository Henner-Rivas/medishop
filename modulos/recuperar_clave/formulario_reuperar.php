
		
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
                    			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="formulario" class="form-horizontal" role="form" action="" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="email" required>                                        
							</div>
						
							 <div class="form-group row mb-0">
                     <div id="div-pb" class="col-sm-12 text-center" style="display: none">
                         <img src="img/pb.gif" />
                     </div>
                     <div id="div-btn" class="col-sm-12 text-right">
									<button id="btn-recupera" type="button" class="btn btn-success">Recuperar</a>

                          
                     </div>

                 </div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
										No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
									</div>
								</div>
							</div>    
						</form>
					</div>                     
				</div>  
			</div>
		</div>
	 <script>
     $("#btn-recupera").click(function() {
         $("#div-btn").hide();
         $("#div-pb").show();

         var p = $("#formulario").serialize();
         $.post("?modulo=recuperar_clave&accion=recupera", p, function(respuesta) {
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