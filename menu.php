   <div class="navbar nav_title" style="border:0;">


   <!--  <div class="profile clearfix ">
                <img src="img/medishop.png" style="width: 160px;text-align: center;"  >
</div> -->
  <!--             <a href="?modulo=contenido1&accion=ver" class="site_title"></i> <span>MEDISHOP</span>                                 
</a> -->
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="img/foto.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>
                  
<?php echo isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : "" ?>
                    
  
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a  href="?modulo=contenido1&accion=ver"  ><i class="fa fa-home"></i> Inicio </a>
                
                  </li>
                                       <?php if (isset($_SESSION['usuario']) == true) { ?>

                  <li><a href="?modulo=contenido&accion=ver"><i class="fa fa-edit"></i>  Contenidos</a>
                    
                  </li>
                                                       <?php } ?>

                  <li><a><i class="fa fa-desktop"> </i> Quienes somos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?modulo=mision&accion=ver">Misiòn</a></li>

                 
                      <li><a href="?modulo=vision&accion=ver">Visiòn</a></li>
                      <li><a href="?modulo=objetivo&accion=ver">objetivo</a></li>
                     
                    </ul>
                  </li>
                    <li><a><i class='fa fa-user'></i>

 Datos personas<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                                            <li><a href="?modulo=departamentos&accion=ver" >Departamentos</a></li>

                       <li><a href="?modulo=municipio&accion=ver">Municipios</a></li>
                      <li><a href="?modulo=persona&accion=ver">Persona</a></li>
                         <li><a href="?modulo=empleado&accion=ver">Empleado</a></li>
                      <li><a href="?modulo=proveedor&accion=ver">Proveedores</a></li>
                   
                                             <li><a href="?modulo=usuario&accion=ver">Usuarios</a></li>
                                                                   <li><a href="?modulo=cargo&accion=ver">Cargo</a></li>



                    </ul>
                  </li>
                         <li><a><i class='fa fa-cart-plus'></i>

Datos productos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
             

  <li><a href="?modulo=via_administracion&accion=ver">Via de administración </a></li>
                        <li><a href="?modulo=presentacion&accion=ver">Presentaciòn</a></li>
                      <li><a href="?modulo=unidad_medida&accion=ver">Unidades de medidad</a></li>
                      <li><a href="?modulo=producto&accion=ver">Productos</a></li>

                    </ul>
                  </li>

         
                      <?php if (isset($_SESSION['usuario']) == true) { ?>
                  <li><a><i class="fa fa-table"></i> Administración <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">


                      <li><a href="?modulo=producto_salida&accion=ver"> Producto salida</a></li>

                 
          
                    
                            <li><a href="?modulo=pedido_producto&accion=ver">Pedidos de productos</a></li>
                      <li><a href="?modulo=pedido&accion=ver">Pedidos</a></li>
                      <li><a href="?modulo=permiso-cargo&accion=ver">Permisos</a></li>
                      <li><a href="?modulo=reporte_productos&accion=ver">Reportes de productos</a></li>
                      <li><a href="?modulo=producto_reporte_vencimiento&accion=ver">Producto reporte vencimiento</a></li>
                      <li><a href="?modulo=reporte_vencimiento&accion=ver">Reporte vencimiento</a></li>
                   
                      <li><a href="?modulo=salida&accion=ver">Salidas</a></li>

                    </ul>
                  </li>
                   <?php } ?>
                     <?php if (isset($_SESSION['usuario']) == true) { ?>
                  <li><a><i class="fa fa-bar-chart-o"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?modulo=reporte_lista_producto&accion=ver">Reporte lista producto</a></li>
                      <li><a href="?modulo=reporte_empleado&accion=ver">Reporte empleados</a></li>
                     <li><a href="?modulo=reporte_proveedor&accion=ver">Reporte proveedores</a></li>
                        <li><a href="?modulo=reportes_pedidos&accion=ver">Reporte pedido</a></li>

                     <li>.</li>

                      <li><a href="?modulo=reporte_persona_municipio&accion=ver">Reporte municipio</a></li>
                      <li><a href="?modulo=reportes_producto_salida&accion=ver">Productos mas vendidos</a></li>
                      <li><a href="?modulo=reporte_producto_presentacion&accion=ver">Reporte producto </a></li>
                      <li><a href="?modulo=reporte_producto_por_vencer&accion=ver">Reporte de vencimiento</a></li>


                    </ul>
                  </li>
                                                       <?php } ?>

             

                     <?php if (isset($_SESSION['usuario']) == false) { ?>
            <li class="nav-item">
                <a href="?modulo=iniciar-sesion&accion=ver"><i class="fas fa-sign-in-alt"></i>Iniciar sesión</a>
            </li>
        <?php } ?>

              <?php if (isset($_SESSION['usuario']) == false) { ?>
                      <li><a href="?modulo=crear-usuario&accion=ver">Crear usuario</a></li>
                         <?php } ?>
                </ul>


              </div>
             

            </div>


          </div>
        </div>
