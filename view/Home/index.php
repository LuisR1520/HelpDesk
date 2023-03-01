<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<title>AMPYME::Home</title>
</head>
<body class="with-side-menu">
<?php
//header("Refresh:10");

?>
    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-sm-4">
	                        <article class="statistic-box blue">
	                            <div>
	                                <div class="number" id="lbltotal"></div>
	                                <div class="caption"><div>Total de Tickets</div></div>
	                            </div>
	                        </article>
	                    </div>
						<div class="col-sm-4">
	                        <article class="statistic-box yellow">
	                            <div>
	                                <div class="number" id="lbltotalabierto"></div>
	                                <div class="caption"><div>Total de Tickets Abiertos</div></div>
	                            </div>
	                        </article>
	                    </div>
						<div class="col-sm-4">
	                        <article class="statistic-box green">
	                            <div>
	                                <div class="number" id="lbltotalcerrado"></div>
	                                <div class="caption"><div>Total de Tickets Cerrados</div></div>
	                            </div>
	                        </article>
	                    </div>
					</div>
				</div>
			</div>
			<?php
    if ($_SESSION["rol_id"]==1){
        ?>
			<section class="card">
				<header class="card-header">
				HELP DESK
				</header>
				<div class="card-block">
					<div style="height: 350px;"> <img src = ../../public/img/logo-am.png style="max-width: 100%;  height:350px;"  /> </div>
				</div>
			</section>
		</div>
	</div>
	<?php
}else{
	?>
<section class="card">
				<header class="card-header">
					Grafico Estadístico
				</header>
				<div class="card-block">
					<div id="divgrafico" style="height: 250px;"></div>
				</div>
			</section>
			<section class="card">
				<header class="card-header">
					Grafico Estadístico de Asignaciones Totales
				</header>
				<div class="card-block">
					<div id="divigrafico" style="height: 250px;"></div>
				</div>
			</section>
			<section class="card">
				<header class="card-header">
					Grafico Estadístico de Abiertos Asignados
				</header>
				<div class="card-block">
					<div id="divgraficos" style="height: 250px;"></div>
				</div>
			</section>
		</div>
	</div>
<?php
    }
?>
	<!-- Contenido -->

	<?php require_once("../MainJs/js.php");?>

	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script type="text/javascript" src="home.js"></script>

	<script type="text/javascript" src="../notificacion.js"></script>
</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>