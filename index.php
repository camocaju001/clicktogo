<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Click2Go | Administrador</title>
    <?php include("views/header.php"); ?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    	
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>C2G</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>Click2Go</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
        	<?php include("views/navbar-static-top.php"); ?>
        </nav>
      </header>
      
	<?php if(!isset($_SESSION['token'])){?>
			<!-- Left side column. contains the logo and sidebar -->
		      <aside class="main-sidebar">
		      	<?php //include("aside_left_original.php"); ?>
		        <?php include("views/aside_left.php"); ?>
		      </aside>
		
		      <!-- Content Wrapper. Contains page content -->
		      <div class="content-wrapper">
				<?php
				if(isset($_GET["content"]) && file_exists('views/'.$_GET["content"].'.php') ) {
					include("views/".$_GET["content"].".php");
				}else{
					echo ' Vista no existente';
				}
				?>
		      </div>
		      <!-- /.content-wrapper -->
      <?php }else{
      	if(isset($_GET['act']) && $_GET['act'] == 'log'){
      		echo('logi');
      	}
      	include("views/login.php"); 
      }?>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016 <a href="http://www.ideasthroughiris.com/">Ideas Through Iris</a>.</strong> All rights reserved.
      </footer>
      
    </div><!-- ./wrapper -->
	
  </body>
  <?php include("views/footer.php"); ?>
</html>
