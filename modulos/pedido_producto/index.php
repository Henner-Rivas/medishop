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
                    <h2>Pedido producto </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />            <div id="div-tabla">
            <div class="row">
                <div class="col-12">
               <div  class="col-sm-12 text-right">
    <button id="btn-buscar" class="btn btn-sm btn-primary ml-1 float-right">Buscar</button>
   <button id="btn-mostrar-formulario-agregar" class="btn btn-sm btn-success float-right">Agregar</button>
   </div>
                </div>
            </div>

            <div id="listado" style="max-height: 600px; overflow-y:auto;">

            </div>
        </div>

        <div id="div-formulario" class="container mt-4" style="max-width:700px; display: none">
            <div class="card">
                <div class="card-header">
                    <p class="entrada"></p>
                </div>

                <div class="card-body">
                    <form id="formulario" method="post">
                        <input type="hidden" name="idpedido_producto" id="idpedido_producto"/>
                       <div class="form-group row">
                            <label for="idproducto" class="col-sm-3 col-form-label">Producto</label>
                            <div class="col-sm-9">
                                <select class="form-control " id="idproducto" name="idproducto">
                                    <option value="">(Seleccionar el Producto)</option>
                                    <?php
                                    $sql1 = "SELECT
                                    producto.idproducto,
                                     concat_ws(': ', producto.codigo,producto.nombre) as producto
                                                         FROM producto ORDER by nombre";
                                    $rs1 = mysqli_query($conexion, $sql1);
                                    while ($rw1 = mysqli_fetch_assoc($rs1)) {

                                        echo "<option value='$rw1[idproducto]'>$rw1[producto]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha_vencimiento" class="col-sm-3 col-form-label">Fecha de vencimiento</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="fecha vencimiento">
                            </div>
                        </div>


                       <div class="form-group row">
                            <label for="idpedido" class="col-sm-3 col-form-label">Proveedor</label>
                            <div class="col-sm-9">
                                <select class="form-control " id="idpedido" name="idpedido">
                                    <option value="">(Seleccionar el proveedor)</option>
                                    <?php
                                    $sql1 = "SELECT 
                                     pedido.idpedido,
                                    concat_ws(' ', persona.nombre ,persona.apellidos ) as proveedor 

                                    FROM pedido JOIN proveedor on pedido.idproveedor= proveedor.idproveedor JOIN persona on proveedor.idpersona=persona.idpersona

                                  ";
                                    $rs1 = mysqli_query($conexion, $sql1);
                                    while ($rw1 = mysqli_fetch_assoc($rs1)) {

                                        echo "<option value='$rw1[idpedido]'>$rw1[proveedor]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Cantiad" class="col-sm-3 col-form-label">Cantiad</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantiad">
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
        $("#listado").load("?modulo=pedido_producto&accion=listar",parametros);
    }
   

    function modificar(id) {
        
       $("#div-tabla").hide();
        $("#div-formulario").show();
        $("#btn-agregar").hide();
        $("#btn-modificar").show();
            $(".entrada").text("Editar pedido ");


        //Limpiar el formulario
        $("#formulario").trigger("reset");
        var p = "id=" + id;
        $.get("?modulo=pedido_producto&accion=asignar", p, function(respuesta) {
            

                                  

            var r = jQuery.parseJSON(respuesta);

            $("#idpedido_producto").val(r.idpedido_producto);
             $("#fecha_vencimiento").val(r.fecha_vencimiento);
              $("#idproducto").val(r.idproducto);
               $("#idproveedor").val(r.idproveedor);
               $("#idpedido").val(r.idpedido);
            
                $("#cantidad").val(r.cantidad);



        });
    }
    


    function eliminar(id) {

        if (confirm("??Desea eliminar el registro?")) {
            var p = "idpedido_producto=" + id;
            $.post("?modulo=pedido_producto&accion=eliminar", p, function(respuesta) {
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
             $(".entrada").text("Registrar pedido");


    });

    $("#btn-agregar").click(function() {
        $.notifyClose();
        $("#div-pb").show();
        $("#div-btn").hide();


        var parametros = $("#formulario").serialize();
        $.post("?modulo=pedido_producto&accion=agregar", parametros, function(respuesta) {
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
        if (confirm("??Desea modificar el registro?")) {
            $.notifyClose();
            $("#div-pb").show();
            $("#div-btn").hide();
            var parametros = $("#formulario").serialize();
            $.post("?modulo=pedido_producto&accion=modificar", parametros, function(respuesta) {
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

