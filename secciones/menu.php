            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                 <!-- clases de conecion se clea un ojeto para la conecio-->
                <h3><?php  
				require("class/safer.class.php");
				$obj = new Safer();
				
				
					$id_rol =$_SESSION["rol"]; 
					
					echo $obj->getNombreRol($id_rol);?></h3>
                
                
                <ul class="nav side-menu">
                  <!--<li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="indexdulce.html">Graficos</a></li>
                                        
                                    </ul>
                                </li>-->
                  
                  <?php
				  	
             //conecta a base de datis -->
                  	if ($obj->conecta()){
						//verficar modulos deacuerdo al rol
						$modulos = $obj->getModulosRol($id_rol);
						
						//modulos de los menus que puede aser el usuario
						while ($fila = sqlsrv_fetch_array($modulos))
						{
							 $id_modulo = $fila["id_modulo"];
							 $modulo = $fila["modulo"];
							 $estatus = $fila["estatus"];
							 
							 if ($estatus == 0)
								continue;
								
							 echo '<li><a><i class="fa fa-edit"></i> '.$modulo.'  <span class="fa fa-chevron-down"></span></a>';
							 
							 
							 echo '<ul class="nav child_menu">';
							 
							 //verificar menus deacuerdo al rol y modulo
							 $menus = $obj->getMenusRolMod($id_rol, $id_modulo);
							 
							 while ($fila = sqlsrv_fetch_array($menus))
							 {
								$id_menu = $fila["id_menu"];
							 	$menu = $fila["menu"];
								$ruta_aplicacion = $fila["ruta_aplicacion"];
								
								echo '<li><a href="'.$ruta_aplicacion.'">'.$menu.' </a></li>';
								
							 }
							 echo '</ul>';
							 echo '</li>';
							 
						
						}
								
						
					}
                  ?>
                                
                                
                                
                                
 <!--                 <li><a><i class="fa fa-edit"></i> Administrar/ Altas  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="usuarios.php">Usuarios </a></li>
                      <li><a href="areas.php">Areas</a></li>
                      <li><a href="departamento.php">Departamento</a></li>
                      <li><a href="puestos.php">Puestos</a></li>
                      <li><a href="aspectos.php">Aspectos</a></li>
                       <li><a href="comportamiento.php">Comportamiento</a></li>
                       <li><a href="observacion.php">Observaciones</a></li>
                       
               
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables_dynamic.html">Observaciones realizada</a></li>
                      <li><a href="tables_dynamic.html">Historico</a></li>
                      <li><a href="tables_dynamic.html">Reporte generl</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>-->
                 
                </ul>
              </div>
            

            </div>