<?php
	@session_start();
	if(!isset($_SESSION["usuario"])) { 
		header('Location: index.php');
		exit();
	}
	require ("class/safer.class.php");
	$obj = new Safer();
	
?>
<!DOCTYPE html>
<html lang="en">
	<?php require("secciones/head.php"); ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        

        <?php require ("secciones/lateral.php");?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">


            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Catalogo <small>Usuarios</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Nuevo</button>
                        
						<!--agregar usuario-->
                          <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
        
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  
                                  <!--form-->
                                  <form class="" action="" method="post" novalidate>
                                        <span class="section">Información personal</span>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Nombre<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Apellidos<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class='optional' name="occupation" data-validate-length-range="5,15" type="text" /></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Numero de empreado<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class='optional' name="occupation" data-validate-length-range="5,15" type="text" /></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">email<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" name="email" class='email' required="required" type="email" /></div>
                                        </div>
                                        
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Genero</label>
											<div class="col-md-6 col-sm-6 ">
												<div id="gender" class="btn-group" data-toggle="buttons">
													<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
														<input type="radio" name="gender" value="male" class="join-btn"> &nbsp; Masculino &nbsp;
													</label>
													<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
														<input type="radio" name="gender" value="female" class="join-btn"> Femenino
													</label>
												</div>
											</div>
										</div>
                                        
                                        <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Departmento</label>
											<div class="col-md-6 col-sm-6 ">
                                            	<select id="departamento" class="form-control">
                                            	<?php
                                                	if ($obj->conecta())
													{
														$datos = $obj->getDepartamentos();
														while ($fila = sqlsrv_fetch_array($datos))
														{
															echo $id = $fila["id_departamento"];
															echo  $campo = $fila["nombre_departamento"];
															
															echo "<option value=".$id.">".$campo."</option>";
														}
													}
                                                ?>
                                            	</select>
                                            
												
											</div>
										</div>
                                        
                                        <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Puesto</label>
											<div class="col-md-6 col-sm-6 ">
												<select id="departamento" class="form-control">
                                            	</select>
											</div>
										</div>
                                        
                                        <!--<div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Privilegio</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control">
													<option>Choose option</option>
													<option>Option one</option>
													<option>Option two</option>
													<option>Option three</option>
													<option>Option four</option>
												</select>
											</div>
										</div>-->
                                        
                                        
                                        
                                      <div class="field item form-group">
											<label class="col-form-label col-md-3 col-sm-3  label-align">Contraseña <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6">
												<input class="form-control" type="password" id="password1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />
												
												<span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
													<i id="slash" class="fa fa-eye-slash"></i>
													<i id="eye" class="fa fa-eye"></i>
												</span>
											</div>
										</div>
                                        
                                        
                                         <div class="field item form-group">
											<label class="col-form-label col-md-3 col-sm-3  label-align">Confirmar Contraseña <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6">
												<input class="form-control" type="password" id="password1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" required />
												
												<span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
													<i id="slash" class="fa fa-eye-slash"></i>
													<i id="eye" class="fa fa-eye"></i>
												</span>
											</div>
										</div>
                                        
                                    </form>
                                  
                                  
                                  
                                  
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  <button type="button" class="btn btn-primary">Guardar</button>
                                </div>
        
                              </div>
                            </div>
                          </div>                        
                        <!--agregar usuario-->                        
                        
                        
                        
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Apellidos</th>
                          <th>Num_empleado</th>
                          <th>correo</th>
                          <th>pw</th>
                          <th>sexo</th>
                          <th>puesto</th>
                          <th>área</th>
                          <th>departamento</th>
                          <th>Rol</th>
                        <!--  <th>Estado</th>-->
                          <th>Opciones</th>
                        </tr>
                      </thead>


                      <tbody>
                      
                      
                      <?php
						if ($obj->conecta())
						{
							$datos = $obj->getUsuarios();
							while ($fila = sqlsrv_fetch_array($datos))
							{
								/*$id_usuario = $fila["id_usuario"];
								$nombre = $fila["nombre"];
								$apellidos = $fila["apellidos"];
								$num_empleado = $fila["num_empleado"];
								$email = $fila["email"];
								$contra = $fila["contrasena"];
								$sexo = $fila["sexo"];
								$id_puesto = $fila["id_puesto"];
								$puesto = $obj->getPuesto($id_puesto);
								$id_area = $fila["id_area"];
								$area = $obj->getArea($id_area);
								$id_departamento = $fila["id_departamento"];
								$depa = $obj->getDepartamento($id_departamento);
								
								$id_rol = $fila["id_rol"];
								$rol = $obj->getDepartamento($id_rol);
								
								echo "<tr>";
								echo "<td>$nombre</td>
								  <td>$apellidos</td>
								  <td>$num_empleado</td>
								  <td>$email</td>
								  <td>$contra</td>
								  <td>$sexo</td>
								  <td>$puesto</td>
								  <td>$area</td>
								  <td>$depa</td>
								  <td>$rol</td>";
								  
								  echo "<td>";
								  echo "<button class='btn btn-round btn-info'>Editar</button>";
								  echo "<button class='btn btn-round btn-danger'>Eliminar</button>";
								  echo "</td>";
								echo "</tr>";*/
								
							}
						}

                      ?>
                      
                        

                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>

              

              

              

              

              
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php require("secciones/footer.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>