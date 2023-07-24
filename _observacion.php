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
  <?php require('secciones/head.php');?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require("secciones/lateral.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registro de: <small>Observaciónes</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Nuevo</button>
                        
						<!--agregar usuario-->
                          <div id="m_agrega" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
        
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel">Agregar Observación</h4>
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  
                                  <!--form-->
                                   <form id="formulario" class="" action="" method="post" novalidate>
                                        
                                        
                 <!--trar  id_usuario--><input type="text" id="id_usuario" name="id_usuario" readonly style="visibility:hidden;"/>
                <!--proceso 1 guardar, 2 actualizar--><input type="text" id="pro" name="pro" readonly style="visibility:hidden;"/>
                <!--correo:--><input type="text" id="correo_actual" name="correo_actual" readonly style="visibility:hidden;"/> 
                
                
                
                                           <span class="section">Información oserbación</span>
                                           
                                        <div class="field item form-group">
                                        
                                         <!--daos atomaticos que se utilisan de secion -->
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Folio<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input id="folio" class="form-control" data-validate-length-range="6" data-validate-words="2" name="folio" placeholder="" required="required" />
                                            </div>
                                        </div>
                                        

                                        
                                        
                                         <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Área de observación</label>
											<div class="col-md-6 col-sm-6 ">
                                            
                                            <select id="area" name="area" class="form-control">
                                                <option value="0">Selecciona</option>
                                            	<?php
                                                	if ($obj->conecta())
													{
														$datos = $obj->getAreas();
														while ($fila = sqlsrv_fetch_array($datos))
														{
															 $id = $fila["id_area"];
															 $campo = $fila["nombre_area"];
															
															echo "<option value=".$id.">".$campo."</option>";
														}
													}
                                                ?>
                                            	</select>
											</div>
										</div>
                                        
                                        <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Observación realizada a</label>
											<div class="col-md-6 col-sm-6 ">
												<select id="puesto" name="puesto" class="form-control">
                                            <option value="0">Selecciona</option>
                                            <?php
                                                if ($obj->conecta())
                                                {
                                                    $datos = $obj->getPuestos();
                                                    while ($fila = sqlsrv_fetch_array($datos))
                                                    {
                                                         $id = $fila["id_puesto"];
                                                          $campo = $fila["puesto"];
                                                        
                                                        echo "<option value=".$id.">".$campo."</option>";
                                                    }
                                                }
                                            ?>
                                            </select>
											</div>
										</div>

										<div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Comportamientos identificados</label>
											<div class="col-md-6 col-sm-6 ">
											<select id="comportamiento" name="comportamiento" class="form-control">
                        					<option value="0">Selecciona</option>
											<?php
                                                if ($obj->conecta())
                                                {
                                                    $datos = $obj->getComportamientos();
                                                    while ($fila = sqlsrv_fetch_array($datos))
                                                    {
                                                         $id = $fila["id_comportamiento"];
                                                         $campo = $fila["nombre_comportamiento"];
                                                        
                                                        echo "<option value=".$id.">".$campo."</option>";
                                                    }
                                                }
                                            ?>
                                            </select>
											</div>
										</div>
										
                                        <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Aspectos identificados</label>
											<div class="col-md-6 col-sm-6 ">
												<select id="aspectos" name="aspectos" class="form-control">
                        					<option value="0">Selecciona</option>
											<?php
                                                if ($obj->conecta())
                                                {
                                                    $datos = $obj->getAspectos();
                                                    while ($fila = sqlsrv_fetch_array($datos))
                                                    {
                                                         $id = $fila["id_aspecto"];
                                                         $campo = $fila["aspectos"];
                                                        
                                                        echo "<option value=".$id.">".$campo."</option>";
                                                    }
                                                }
                                            ?>
                                            </select>
											</div>
										</div>

                                        <div class="form-group row">
											<label class="control-label col-md-3 col-sm-3 label-align">Responsable de seguimiento</label>
											<div class="col-md-6 col-sm-6 ">
												 <select id="departamento" name="departamento" class="form-control">
                        					<option value="0">Selecciona</option>
											<?php
                                                if ($obj->conecta())
                                                {
                                                    $datos = $obj->getDepartamentos();
                                                    while ($fila = sqlsrv_fetch_array($datos))
                                                    {
                                                         $id = $fila["id_departamento"];
                                                         $campo = $fila["nombre_departamento"];
                                                        
                                                        echo "<option value=".$id.">".$campo."</option>";
                                                    }
                                                }
                                            ?>
                                            </select>
											</div>
										</div>
                                        
                                        <div class="form-group row">
											<label class="col-md-3 col-sm-3  label-align">Tipo de observación
											</label> 

											<div class="col-md-9 col-sm-9 ">
												
												<div class="radio">
													<label>
														<input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Acto seguro 
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Acto inseguro 
													</label>
												</div>
                                                <div class="radio">
													<label>
														<input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Condición segura
													</label>
												</div>
                                                <div class="radio">
													<label>
														<input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Condición inseguro 
													</label>
												</div>
											</div>
										</div>
                                        
                                        <div class="form-group row">
											<label class="col-md-3 col-sm-3  label-align">Cliticidad
											</label>

											<div class="col-md-9 col-sm-9 ">
												
												<div class="radio">
													<label>
														<input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Alto
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Medio
													</label>
												</div>
                                                <div class="radio">
													<label>
														<input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Bajo
													</label>
												</div>
                                                <div class="radio">
													
												</div>
											</div>
										</div>
                                        
                                        
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Descripción del evento<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <textarea required name='message'></textarea></div>
                                        </div>
                                        
                                        <div class="form-group row">
                                                
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Acciones realizadas<span class="required">*</span></label>
                                            <div class="col-md-3 col-sm-3">
                                                <textarea required name='message'></textarea></div>
                                       
                                        </div>
                                        
                                        <div class="form-group row">
                                       <label for="message">Acciones realizadas (20 chars min, 100 max) :</label>
												<textarea id="message" required class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
                                  
                                		</div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  <button id="guarda_ar" type="button" class="btn btn-primary">Guardar</button>
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
        <?php require("secciones/footer.php");?>
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
    <script src="js/observacion.js"></script>
    <script src="js/funciones.js"></script>

  </body>
</html>

<!-- modal-procesando -->
<div class="modal" role="dialog" id="mloading">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Procesando ...</h4>
      </div>
      <div class="modal-body text-center"> 
        <img src="img/b_loading.gif" width="147" height="137" alt="" />
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- /.modal-procesando -->

<!--alerta-->
<div class="modal" id="m_alerta" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div id="m_head_alerta" class="modal-header">
        <h4 id="m_txt_alerta" class="modal-title" style="color:#FFFFFF"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <label id="m_l_alerta"></label>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--alerta-->