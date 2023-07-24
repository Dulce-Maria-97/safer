<!--sesion u suari-->
<?php
	@session_start();
	if(!isset($_SESSION["usuario"])) { 
		header('Location: index.php');
		exit();
	}
	//require ("class/safer.class.php");
	//$obj = new Safer();
	
	//definir zona horaria de mexico
	date_default_timezone_set("America/Mexico_City");
?>

<!--el csor en esl boton del estado -->
<style>
	.mano{cursor:pointer}
</style>

<!--el csor en esl boton del estado -->

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
                    <h2>Registro <small>Observaciones</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    	<button id="nuevo" type="button" class="btn btn-primary" data-toggle="modal">Nuevo</button>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div id="datos" class="card-box table-responsive">
                                <!--se llama la tabla -->
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

<!--agregar usuario-->
  <div id="registrar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg">
      <div id="contenido" class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title" id="titulo"></h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          
          <!--form-->
          <form id="formulario" class="" action="" method="post" novalidate>
          		<!--trar  id_usuario--><input type="text" id="id_comportamiento" name="id_comportamiento" readonly style="visibility:hidden;"/>
                <!--proceso 1 guardar, 2 actualizar--><input type="text" id="pro" name="pro" readonly style="visibility:hidden;"/>
                <input type="text" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION["usuario"];?>" readonly style="visibility:hidden;"/>
                
               <span class="section">Información</span>
               <!--daos atomaticos que se utilisan de secion -->
               <!--<div class="field item form-group">  
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Folio<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input id="folio" class="form-control" data-validate-length-range="6" data-validate-words="2" name="folio" placeholder="" required="required" />
                    </div>
                </div>-->
                
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Fecha<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                    	
                    	<input type="text" id="fecha" name="fecha" value="<?php echo date("d/m/Y"); ?>" class="form-control" readonly>
						<!--<input id="fecha" name="fecha" class="form-control date" type="date" readonly>-->
                    </div>
                </div>
               
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Numero de empleado<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input id="numero" name="numero" class="form-control" value="<?php echo $obj->getNumEmpleado($_SESSION["usuario"]);?>" type="text"  readonly/>
                        </div>
                </div>
                
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nombre<span class="required">*</span></label>
                   <div class="col-md-6 col-sm-6">
                        <input id="nombre_empleado" name="nombre_empleado" class="form-control" value="<?php echo $obj->getNombreComUsuario($_SESSION["usuario"]);?>" type="text"  readonly/>
                        </div>
                </div>
                
                <!--daos atomaticos que se utilisan de secion -->   
                
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
                    <label class="control-label col-md-3 col-sm-3 label-align">Tipo de Observacion</label>
                    <div class="col-md-6 col-sm-6 ">
                         <select id="tipo" name="tipo" class="form-control">
                    <option value="0">Selecciona</option>
                    <?php
                        if ($obj->conecta())
                        {
                            $datos = $obj->getTipoObservacion();
                            while ($fila = sqlsrv_fetch_array($datos))
                            {
                                 $id = $fila["id_tipo_observacion"];
                                 $campo = $fila["observacion"];
                                
                                echo "<option value=".$id.">".$campo."</option>";
                            }
                        }
                    ?>
                    </select>
                    </div>
                </div> 
                
 				<div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 label-align">Criticidad</label>
                    <div class="col-md-6 col-sm-6 ">
                         <select id="criticidad" name="criticidad" class="form-control">
                    <option value="0">Selecciona</option>
                    <?php
                        if ($obj->conecta())
                        {
                            $datos = $obj->getCriticidades();
                            while ($fila = sqlsrv_fetch_array($datos))
                            {
                                 $id = $fila["id_criticidad"];
                                 $campo = $fila["nombre"];
                                
                                echo "<option value=".$id.">".$campo."</option>";
                            }
                        }
                    ?>
                    </select>
                    </div>
                </div>                               
                
            
                
                
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Descripción del evento<span class="required"></span></label>
                    <div class="col-md-6 col-sm-6">
                        <textarea class="form-control" required id="descripcion" name='descripcion'></textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                        
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Acciones realizadas<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <textarea class="form-control" required name='acciones' id="acciones"></textarea></div>
               
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button id="reg" type="button" class="btn btn-primary">Guardar</button>
          <button id="edi" type="button" class="btn btn-warning">Editar</button>
        </div>

      </div>
    </div>
  </div>                        
<!--agregar area--> 











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