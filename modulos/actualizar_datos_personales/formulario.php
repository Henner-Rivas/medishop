<?php 
require_once("conexion.php");

$sql="SELECT `id_usuario`, `id_persona`,
`usuario`,
persona.identificacion,
persona.nombre,
persona.direccion,
persona.email,
persona.telefono,
persona.apellidos,
tipo_identificacion.nombre as tipo_identificacion,
CONCAT_WS(': ', d.nombre, municipio.nombre) AS municipio,
tipo_identificacion.idtipo_identificacion,
municipio.idmunicipio


FROM `usuario`  
JOIN persona on usuario.id_persona= persona.idpersona
JOIN tipo_identificacion on persona.idtipoidentificacion=tipo_identificacion.idtipo_identificacion
JOIN municipio on persona.idmunicipio_expedicion=municipio.idmunicipio
JOIN departamento d ON municipio.iddepartamento = d.iddepartamento


WHERE id_usuario='".$_SESSION['id_usuario']."'";

 $result=mysqli_query($conexion, $sql);
$mostrar = mysqli_fetch_array($result)
 ?>


<div class="right_col" role="main" id="actualizar">
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
                    <h2>Actualizar datos personales </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
 <div id="" class="content mt-5 mb-5" style="width:800px; margin:auto; ">

   
<form id="formulario" method="post">
 <input type="hidden" name="idpersona" id="idpersona" value="<?php echo $mostrar['idpersona']; ?>">
                        <h2 style="font-size:14px; font-weight:bold; text-align:center; padding:5px">DOCUMENTO DE IDENTIDAD </h2>
                          <div class="form-group row">
                            <label for="identificacion" class="col-sm-3 col-form-label">Identificación</label>
                            <div class="col-sm-9">
                                <input  disabled type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Número de identificación"  value="<?php echo $mostrar['identificacion']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idtipoidentificacion" class="col-sm-3 col-form-label">Tipo identificación</label>
                            <div class="col-sm-9">
                                <select   class="form-control " id="idtipoidentificacion" name="idtipoidentificacion"  >
                                    <option  value="<?php echo $mostrar['idtipo_identificacion']; ?>" ><?php echo $mostrar['tipo_identificacion']; ?></option>
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
                            <label for="municipio_id" class="col-sm-3 col-form-label">Municipio expedición </label>
                            <div class="col-sm-9">
                                <select  class="form-control " id="municipio_id" name="municipio_id" value="<?php echo $mostrar['municipio']; ?>">
                                    <option value="<?php echo $mostrar['idmunicipio']; ?>"><?php echo $mostrar['municipio']; ?></option>
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
                      
  <h2 style="font-size:14px; font-weight:bold; text-align:center; padding:5px">INFORMACIÓN PERSONAL
 </h2>
                        <div class="form-group row">
                            <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $mostrar['nombre']; ?>">
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="apellido" class="col-sm-3 col-form-label">Apellido</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="apellido" value="<?php echo $mostrar['apellidos']; ?>">
                            </div>
                        </div>

                

                       
                            <div class="form-group row">
                            <label for="direccion" class="col-sm-3 col-form-label">Direccion</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo $mostrar['direccion']; ?>">
                            </div>
                            </div>

                              <div class="form-group row">
                            <label for="usuario" class="col-sm-3 col-form-label">Nombre de usuario</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" value="<?php echo $mostrar['usuario']; ?>">
                            </div>
                        </div>
                          <h2 style="font-size:14px; font-weight:bold; text-align:center; padding:5px">INFORMACIÓN DE CONTACTO

 </h2>
                            <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $mostrar['email']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-sm-3 col-form-label">Telefono</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $mostrar['telefono']; ?>">
                            </div>
                        </div>
                    </form>
                    <hr />

                    <div class="form-group row mb-0">
                        <div id="div-pb" class="col-sm-12 text-center" style="display: none">
                            <img src="img/pb.gif" />
                        </div>

                        <div id="div-btn" class="col-sm-12 text-right">
                            <input type="button" class="btn btn-success" id="btn-modificar" value="Modificar">
                             <li class="btn btn-secondary" >
                      <a class="enlaceboton" href="?modulo=contenido1&accion=ver">
                        <span   >Regresar</span>
                      </a>
                    </li> 
                        </div>
                    </div>
        <!--  </div> -->
     </div>
</div>
</div>

</div>
</div>
</div>

 </div>
 <script>
     $("#btn-modificar").click(function() {
         $("#div-btn").hide();
         $("#div-pb").show();

         var p = $("#formulario").serialize();
         $.post("?modulo=actualizar_datos_personales&accion=modificar", p, function(respuesta) {
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

