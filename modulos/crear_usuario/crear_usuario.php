<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
             

            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registrate </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
             <form id="formulario" method="post" >
                 <div id="" class="content mt-5 mb-5" style="width:750px; margin:auto; ">


                 <div class="form-group row">
                            <label for="tipo_identificacion_id" class="col-sm-3 col-form-label">Tipo identificación</label>
                            <div class="col-sm-9">
                                <select class="form-control " id="tipo_identificacion_id" name="tipo_identificacion_id">
                                    <option value="">(Seleccionar tipo de identificación)</option>
                                    <?php
                                    $sql1 = "SELECT * FROM tipo_identificacion ORDER BY nombre";
                                    $rs1 = mysqli_query($conexion, $sql1);
                                    while ($rw1 = mysqli_fetch_assoc($rs1)) {

                                        echo "<option value='$rw1[idtipo_identificacion]'>$rw1[nombre]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                       <div class="form-group row">
                     <label for="usuario" class="col-sm-3 col-form-label">identificacion</label>
                     <div class="col-sm-9">
                         <input type="text" class="form-control" id="identificacion" name="identificacion">
                     </div>
                 </div>

                     <div class="form-group row">
                            <label for="municipio_id" class="col-sm-3 col-form-label">Municipio nacim</label>
                            <div class="col-sm-9">
                                <select class="form-control " id="municipio_id" name="municipio_id">
                                    <option value="">(Seleccionar municipio de nacimiento)</option>
                                    <?php
                                    $sql2 = "SELECT 
                            m.idmunicipio,
                            CONCAT_WS(': ', d.nombre, m.nombre) AS nombre
                        FROM
                            municipio m
                                JOIN
                            departamento d ON m.iddepartamento = d.iddepartamento
                        ORDER BY nombre";
                                    $rs2 = mysqli_query($conexion, $sql2);
                                    while ($rw1 = mysqli_fetch_assoc($rs2)) {

                                        echo "<option value='$rw1[idmunicipio]'>$rw1[nombre]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="apellido" class="col-sm-3 col-form-label">Apellido</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="apellido">
                            </div>
                        </div>

                

                       
                            <div class="form-group row">
                            <label for="direccion" class="col-sm-3 col-form-label">Direccion</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-sm-3 col-form-label">Telefono</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="id_cargo" class="col-sm-3 col-form-label">Cargo</label>
                            <div class="col-sm-9">
                                <select class="form-control " id="idcargo" name="idcargo">
                                    <option value="">(Seleccionar el cargo)</option>
                                    <?php
                                    $sql1 = "SELECT * FROM cargo ORDER BY nombre";
                                    $rs1 = mysqli_query($conexion, $sql1);
                                    while ($rw1 = mysqli_fetch_assoc($rs1)) {

                                        echo "<option value='$rw1[idcargo]'>$rw1[nombre]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                 <div class="form-group row">
                     <label for="usuario" class="col-sm-3 col-form-label">Usuario</label>
                     <div class="col-sm-9">
                         <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                     </div>
                 </div>

                 <div class="form-group row">
                     <label for="clave" class="col-sm-3 col-form-label">Clave</label>
                     <div class="col-sm-9">
                         <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="clave" class="col-sm-3 col-form-label">Repita Clave</label>
                     <div class="col-sm-9">
                         <input type="password" class="form-control" id="clave2" name="clave2" placeholder="Clave">
                     </div>
                 </div>

                 <hr />
          
                        <div class="form-group row mb-0">
                        <div id="div-pb" class="col-sm-12 text-center" style="display: none">
                            <img src="img/pb.gif" />
                        </div>

                        <div id="div-btn" class="col-sm-12 text-right">
                        <button type="button" id="btn-crear" class="btn btn-success" >Crear</button>

                             <li class="btn btn-secondary" style="border: 1;">
                      <a href="?modulo=contenido1&accion=ver">
                        <span   >Regresar</span>
                      </a>
                    </li> 
                        </div>
                    </div>
             </form>
       </div>
                </div>
              </div>
            </div>
     
    </body>


<script>
   




    $("#btn-crear").click(function() {
        $.notifyClose();
        $("#div-pb").show();
        $("#div-btn").hide();


        var parametros = $("#formulario").serialize();
        $.post("?modulo=crear-usuario&accion=agregar", parametros, function(respuesta) {
            $("#div-pb").hide();
            $("#div-btn").show();

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

</html> -->