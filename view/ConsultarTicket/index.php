<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<title>AMPYME::Consultar Ticket</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">

			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Consultar Ticket</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="../Home/index.php">Home</a></li>
								<li class="active">Consultar Ticket</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 5%;">No.Ticket</th>
							<th style="width: 10%;">Categoría</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Título</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Usuario</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha Creación</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha de Asignación</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Soporte</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha de Cierre</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Cerrado Por:</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Tiempo en ser asignado:</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Tiempo en total de resolucion:</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Tiempo de resolucion desde asignacion:</th>
							<th class="text-center" style="width: 5%;">Detalles</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>

		</div>
	</div>
	<!-- Contenido -->
	<?php require_once("modalasignar.php");?>
	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="consultarticket.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>
