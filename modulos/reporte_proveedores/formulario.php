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
                    <h2>Reporte lista proveedores </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />             <div id="div-tabla">
     <div class="container mt-4" style="max-width:700px">
        <div class="card">
          

            <div class="card-body">
                <form id="formulario" method="post" target="_blank" action="?modulo=reporte_proveedor&accion=descarga">

<div class="form-group row">
                            <label for="identificacion" class="col-sm-3 col-form-label">Identificacion</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificacion">

                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="formato" class="col-sm-3 col-form-label">Formato</label>
                        <div class="col-sm-9">
                            <select class="form-control " id="formato" name="formato" required>
                                <option value="">(Seleccionar formato de salida)</option>
                                <option value="html">Ver en linea</option>
                                <option value="pdf">Archivo PDF</option>
                                <option value="excel">Microsoft Excel</option>
                                <option value="word">Microsoft Word</option>

                            </select>
                        </div>
                    </div>


                    <hr />

                    <div class="form-group row mb-0">

                        <div id="div-btn" class="col-sm-12 text-right">
                            <input type="submit" class="btn btn-secondary" id="btn-desca" value="Generar">
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>