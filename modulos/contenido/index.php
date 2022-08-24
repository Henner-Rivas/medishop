<script src="lib/tinymce/tinymce.min.js"></script>


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
                    <h2>Contenidos </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />          <div id="div-tabla">
            <div class="row">
                <div class="col-12">
               <div  class="col-sm-12 text-right"> 
                 <button id="btn-buscar" class="btn btn-sm btn-primary ml-1 float-right">Buscar</button>
   <button class="btn btn-success btnAgregar right" type="button" id="btn-mostrar-formulario-agregar">
<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
  <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
</svg>

          </button>
   </div>
                </div>
            </div>
         <div id="listado" style="max-heightx: 500px; overflow-y:auto;">

         </div>
     </div>

     <div id="div-formulario" class="container mt-12" style="  display: none">
         <div class="card">
             <div class="card-header">
                 Agregar contenido
             </div>

             <div class="card-body">
                 <form id="formulario" method="post">
                     <input type="hidden" name="contenido_id" id="contenido_id" />

                     <div class="form-group row">
                         <label for="titulo" class="col-sm-3 col-form-label">Titulo</label>
                         <div class="col-sm-9">
                             <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="modulo" class="col-sm-3 col-form-label">Modulo</label>
                         <div class="col-sm-9">
                             <input type="text" class="form-control" id="modulo" name="modulo" placeholder="Modulo">
                         </div>
                     </div>
                     <!-- 
                      <div class="form-group row">
                          <label for="contenido" class="col-sm-12 col-form-label">Contenido</label>

                      </div> -->
                     <div class="form-group row">
                         <div class="col-sm-10">
                             <textarea disabled type="text" class="form-control" id="contenido" name="contenido" placeholder="Contenido" rows="20"></textarea>
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


 <script>
     tinymce.init({
  selector: 'textarea',  // change this value according to your HTML

  language: 'es',
  width: 1040,
    height: 400,

    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image | print preview media fullpage | ' +
      'forecolor backcolor emoticons | help',
    menu: {
      favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'css/content.css'
  }); </script>


 </script>


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
         $("#listado").load("?modulo=contenido&accion=listar", parametros);
     }

     function modificar(id) {
         $("#div-tabla").hide();
         $("#div-formulario").show();
         $("#btn-agregar").hide();
         $("#btn-modificar").show();

         //Limpiar el formulario
         $("#formulario").trigger("reset");

         var p = "id=" + id;
         $.get("?modulo=contenido&accion=asignar", p, function(respuesta) {
             var r = jQuery.parseJSON(respuesta);
             $("#contenido_id").val(r.contenido_id);
             $("#modulo").val(r.modulo);
             $("#titulo").val(r.titulo);
             //$("#contenido").val(r.contenido);
             tinyMCE.get('contenido').setContent(r.contenido);
         });
     }


     function eliminar(id) {

         if (confirm("¿Desea eliminar el registro?")) {
             var p = "contenido_id=" + id;
             $.post("?modulo=contenido&accion=eliminar", p, function(respuesta) {

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

     });

     $("#btn-agregar").click(function() {
         $.notifyClose();
         $("#div-pb").show();
         $("#div-btn").hide();
         var parametros = $("#formulario").serialize();

         var contenido = tinyMCE.get('contenido').getContent();
         parametros = parametros + "&contenido=" + encodeURIComponent(contenido);

         $.post("?modulo=contenido&accion=agregar", parametros, function(respuesta) {
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
             var contenido = tinyMCE.get('contenido').getContent();
             parametros = parametros + "&contenido=" + encodeURIComponent(contenido);


             $.post("?modulo=contenido&accion=modificar", parametros, function(respuesta) {
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