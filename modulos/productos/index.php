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
                    <h2>Productos </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />             <div id="div-tabla">
            <div class="row">
                <div class="col-12">
               <div  class="col-sm-12 text-right">
 <input type="submit" class="btn btn-sm btn-primary ml-1 float-right" id="btn-buscar" value="Buscar">

   <button id="btn-mostrar-formulario-agregar" class="btn btn-sm btn-success float-right">Agregar</button>
   </div>
                </div>
            </div>

           <div id="listado" style="max-height:500px; overflow-y:auto;">

            </div>
        </div>

        <div id="div-formulario" class="container mt-4" style="max-width:750px; display: none">
            <div class="card">
                <div class="card-header">
                    <p class="entrada"></p>
                    
                </div>

                <div class="card-body">
                    <form id="formulario" method="post">
                        <input type="hidden" name="idproducto" id="idproducto" />

                        <div class="form-group row">
                            <label for="nombre" class="col-sm-3 col-form-label">Nombre producto</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre producto">

                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="codigo" class="col-sm-3 col-form-label">codigo producto</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="codigo producto">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descripcion" class="col-sm-3 col-form-label">Descripcion</label>
                            <div class="col-sm-9">
                             <textarea class="form-control" id="descripcion" rows="2" id="descripcion" name="descripcion" placeholder="Descripcion"></textarea>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unidad_medida" class="col-sm-3 col-form-label">Unidad de medida</label>
                            <div class="col-sm-9">
                                <select class="form-control " id="unidad_medida" name="unidad_medida">
                                    <option value="">(Seleccionar la Unidad de medida)</option>
                                    <?php
                                    $sql1 = "SELECT * FROM `unidad_medida`ORDER BY nombre";
                                    $rs1 = mysqli_query($conexion, $sql1);
                                    while ($rw1 = mysqli_fetch_assoc($rs1)) {

                                        echo "<option value='$rw1[idunidad_medida]'>$rw1[nombre]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="via_administracion" class="col-sm-3 col-form-label">Via de admistracion</label>
                            <div class="col-sm-9">
                                <select class="form-control " id="via_administracion" name="via_administracion">
                                    <option value="">(Seleccionar la via de admistracion)</option>
                                    <?php
                                    $sql1 = "SELECT * FROM `via_administracion`ORDER BY nombre";
                                    $rs1 = mysqli_query($conexion, $sql1);
                                    while ($rw1 = mysqli_fetch_assoc($rs1)) {

                                        echo "<option value='$rw1[idvia_administracion]'>$rw1[nombre]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="presentacion" class="col-sm-3 col-form-label">Presentacion</label>
                            <div class="col-sm-9">
                                <select class="form-control " id="presentacion" name="presentacion">
                                    <option value="">(Seleccionar la Presentacion)</option>
                                    <?php
                                    $sql1 = "SELECT * FROM `presentacion`ORDER BY nombre";
                                    $rs1 = mysqli_query($conexion, $sql1);
                                    while ($rw1 = mysqli_fetch_assoc($rs1)) {

                                        echo "<option value='$rw1[idpresentacion]'>$rw1[nombre]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="iva" class="col-sm-3 col-form-label">Iva</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="iva" name="iva" placeholder="Iva">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="valor_unitario" class="col-sm-3 col-form-label">Precio unitario</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" placeholder="valor unitario">
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
        $("#listado").load("?modulo=producto&accion=listar",parametros);
    }
   

    function modificar(id) {
        
       $("#div-tabla").hide();
        $("#div-formulario").show();
        $("#btn-agregar").hide();
        $("#btn-modificar").show();
            $(".entrada").text("Editar producto ");


        //Limpiar el formulario
        $("#formulario").trigger("reset");
        var p = "id=" + id;
        $.get("?modulo=producto&accion=asignar", p, function(respuesta) {
            

                                  

            var r = jQuery.parseJSON(respuesta);
           $("#idproducto").val(r.idproducto);
            $("#codigo").val(r.codigo);
            $("#nombre").val(r.nombre);
            $("#descripcion").val(r.descripcion);
            $("#unidad_medida").val(r.idunidad_medida);
            $("#via_administracion").val(r.idvia_administracion);
            $("#presentacion").val(r.idpresentacion);
            $("#iva").val(r.iva);
           $("#valor_unitario").val(r.valor_unitario);
    


        });
    }
    


    function eliminar(id) {

        if (confirm("¿Desea eliminar el registro?")) {
            var p = "idproducto=" + id;
            $.post("?modulo=producto&accion=eliminar", p, function(respuesta) {
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
                    $(".entrada").text("Registrar producto");


    });

    $("#btn-agregar").click(function() {
        $.notifyClose();
        $("#div-pb").show();
        $("#div-btn").hide();


        var parametros = $("#formulario").serialize();
        $.post("?modulo=producto&accion=agregar", parametros, function(respuesta) {
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
            $.post("?modulo=producto&accion=modificar", parametros, function(respuesta) {
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

</script>

