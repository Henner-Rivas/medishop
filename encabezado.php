        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
             
                <img src="img/medishop.png" style="width: 160px"  >
           
              <ul class=" navbar-right" >
                                              <?php if (isset($_SESSION['usuario']) == true) { ?>

                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="img/foto.png" alt=""><?php echo isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : "" ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right"><br>
                     <li >
                      <a href="?modulo=actualizar_datos_personales&accion=ver"><i class="fas fa-pen"></i>
                        <span   >Mis datos pesonales</span>
                      </a>
                    </li> 

               <!--      
                     <li >
                      <button type="button"  style="border: 0;" id="edit-personales">&nbsp;&nbsp;&nbsp;Mis datos pesonales  </button>
                        
                    </li> -->
                       <li>
                      <a href="?modulo=actualizar_clave&accion=ver"><i class="fas fa-key"></i>
                        <span>Cambiar clave</span>
                      </a>
                    </li>
                    <li><a href="?modulo=cerrar-sesion&accion=ver"><i class="fa fa-sign-out "></i>   <span>Cerrar sesiòn </span>

                     </a>
                        

                   </li>
                  </ul>
                </li>

             <!--    <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li> -->

        
                   
             
                                                                           <?php } ?>

                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>