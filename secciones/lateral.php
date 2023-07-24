<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="inicio.php" class="site_title"><i class="fa fa-user"></i> <span>Safer</span></a>
    </div>
 <!-- /menu pro//divisoresfile -->
    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <!--<img src="images/img.jpg" alt="..." class="img-circle profile_img">-->
      </div>
      <div class="profile_info">
        <span>Bienvenido,</span>
        <!-- menu profile quick inforequiere el nombre del usuario -->
        <?php
        	$nombre = $_SESSION["nombre"];
            echo "<h2>".$nombre."</h2>";
        ?>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <?php require('secciones/menu.php');?>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="salir.php">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <nav class="nav navbar-nav">
      
    </nav>
  </div>
</div>
<!-- /top navigation -->