
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
                    <h2>Municipios </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />        <div id="div-tabla">
            <div class="row">
                <div class="col-12">
               <div  class="col-sm-12 text-right">
    <button id="btn-buscar" class="btn btn-sm btn-primary ml-1 float-right">Buscar</button>
   <button id="btn-mostrar-formulario-agregar" class="btn btn-sm btn-success float-right">Agregar</button>
   </div>
                </div>
            </div>

            <div id="listado" style="max-heightx: 600px; overflow-y:auto;">

            </div>
        </div>

        <div id="div-formulario" class="container mt-4" style="max-width:700px; display: none">
            <div class="card">
                <div class="card-header">
                    <p class="entrada"></p>
                </div>

                <div class="card-body">
                    <form id="formulario" method="post">
                        <input type="hidden" name="idmunicipio" id="idmunicipio"/>
            

                        
                          <div class="form-group row">
                            <label for="departamento" class="col-sm-3 col-form-label">Departamento</label>
                            <div class="col-sm-8 seleccionaDepar" >
                                <select class="form-control " id="departamento" name="departamento">
                                    <option value="">(Seleccionar municipio de nacimiento)</option>
                                    <?php
                                    $sql2 = "
                SELECT iddepartamento,
  nombre
 FROM departamento

                        ORDER BY nombre";
                                    $rs2 = mysqli_query($conexion, $sql2);
                                    while ($rw1 = mysqli_fetch_assoc($rs2)) {

                                        echo "<option value='$rw1[iddepartamento]'>$rw1[nombre]</option>";
                                    }
                                    ?>
                                </select>
                      </div>
                       <div class="col-sm-8 agregarDepar" style="display: none">
                       <input type="text" class="form-control" id="departamento2" name="departamento2" placeholder="Departamento">
                   </div>
                            <div style=" display: inline-block;" >
                                        <button type="button" class="btn btn-sm btn-primary" id="btn-agregar2" style="float: right;">
                 <i class="far fa-plus-square"></i>
                        </button>
                       </div>
                           

                        </div>
                      
                  

                 
                               
                         
                          <div class="form-group row">
                            <label for="municipio" class="col-sm-3 col-form-label">Municipio</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio">
                            </div>
                        </div>

                        

                    </form>
                    <hr />

                    <div class="form-group row mb-0">
                        <div id="div-pb" class="col-sm-12 text-center" style="display: none">
                            <img src="img/pb.gif" />
                        </div>

                        <div id="div-btn" class="col-sm-12 text-right">
                            <input type="button" class="btn btn-success" id="btn-agregar" value="Guardar">
                            <input type="button" class="btn btn-success" id="btn-modificar" value="Modificar">
                            <input type="button" class="btn btn-secondary" id="btn-regresar" value="Regresar">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>



<script>

          var pagina_actual = 1;

      function mover_pagina(pagina) {
          if (pagina < 1) {
              return;
          }

          var cantidad_paginas = parseInt($("#cantidad_paginas").val());
          if (pagina > cantidad_paginas) {
              return;
          }


          pagina_actual = pagina;
          cargar_tabla();
      }

        function cargar_tabla() {
        var parametros = $("#form-filtro").serialize();
         parametros = parametros + "&pagina_actual=" + pagina_actual;

        $("#listado").html('<div class="text-center"><img src="img/pb.gif"/></div>');
        $("#listado").load("?modulo=municipio&accion=listar",parametros);
    }
   

    function modificar(id) {
        
       $("#div-tabla").hide();
        $("#div-formulario").show();
        $("#btn-agregar").hide();
        $("#btn-modificar").show();
            $(".entrada").text("Editar municipios ");


        //Limpiar el formulario
        $("#formulario").trigger("reset");
        var p = "id=" + id;
       $.get("?modulo=municipio&accion=asignar", p, function(respuesta) {
            

                                  

            var r = jQuery.parseJSON(respuesta);

            $("#idmunicipio").val(r.idmunicipio);
            $("#departamento").val(r.departamento);

                  $("#municipio").val(r.municipio);

            
    


        });
    }
    


    function eliminar(id) {

        if (confirm("¿Desea eliminar el registro?")) {
            var p = "idmunicipio=" + id;
            $.post("?modulo=municipio&accion=eliminar", p, function(respuesta) {
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
                        cargar_tabla();


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
        }
    }



    cargar_tabla();

    $("#btn-mostrar-formulario-agregar").click(function() {
        $("#div-tabla").hide();
        $("#div-formulario").show();

        //Limpiar el formulario
        $("#formulario").trigger("reset");
        $("#btn-agregar").show();
        $("#btn-modificar").hide();
                    $(".entrada").text("Agregar municipios");


    });

    $("#btn-agregar").click(function() {
        $.notifyClose();
        $("#div-pb").show();
        $("#div-btn").hide();


        var parametros = $("#formulario").serialize();
        $.post("?modulo=municipio&accion=agregar", parametros, function(respuesta) {
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
                    cargar_tabla();

                    $("#div-tabla").show();
                    $("#div-formulario").hide();


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


    $("#btn-modificar").click(function() {
        if (confirm("¿Desea modificar el registro?")) {
            $.notifyClose();
            $("#div-pb").show();
            $("#div-btn").hide();
            var parametros = $("#formulario").serialize();
            $.post("?modulo=municipio&accion=modificar", parametros, function(respuesta) {
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
                        cargar_tabla();

                        $("#div-tabla").show();
                        $("#div-formulario").hide();


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
        }
    });

    $("#btn-regresar").click(function() {
        $("#div-tabla").show();
        $("#div-formulario").hide();
    });




       $("#btn-buscar").click(function(){
      $("#tr-filtros").each(function() {
        displaying = $(this).css("display");
        if(displaying == "none") {
         $("#tr-filtros").show();

        } else {
      
     $("#tr-filtros").hide();
        }
      });
    });

          $("#btn-agregar2").click(function(){
      $(".agregarDepar").each(function() {
        displaying = $(this).css("display");
        if(displaying == "none") {
     $(".agregarDepar").show();
     $(".seleccionaDepar").hide();

        } else {
      
       $(".agregarDepar").hide();
     $(".seleccionaDepar").show();        }
      });
    });


</script>

