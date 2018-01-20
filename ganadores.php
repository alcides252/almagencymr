<!DOCTYPE html>
<html lang="en">
<head>
	<title>AlmagencyMR.</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.css">
	<script>
		document.write('<link href="styleBlue.css" rel="stylesheet" type="text/css" media="screen" />');
	</script>
	<?php 		
		function animales($num,$conn) {
			$sql="SELECT nombre FROM lotoactivo WHERE id='$num'";
			$resultado = mysqli_query($conn,$sql);
			$row=mysqli_fetch($resultado);
			echo $row;
		}
		function sorteoActual(){
			$hora =date("h");
			switch ($hora) {
				case 1:
					$sorteo='4pm';
				break;  
				case 2:
					$sorteo='4pm';
				break;  
				case 3:
					$sorteo='4pm';
				break;  
				case 4:
					$sorteo='5pm';
				break;  
				case 5:
					$sorteo='6pm';
				break;  
				case 6:
					$sorteo='7pm';
				break;  
				case 7:
					$sorteo='10am';
				break;  
				case 8:
					$sorteo='10am';
				break;
				case 9:
					$sorteo='10am';
				break;  
				case 10:
					$sorteo='11am';
				break;    
				case 11:
					$sorteo='12m';
				break;    
				case 12:
					$sorteo='1pm';
				break;          
			}
			return $sorteo;
		}
		session_start();	
		if($_SESSION["usuario"]==""){
			header("Location:index.php");
		}
		if(isset($_GET["fecha"])){
			$fecha=$_GET["fecha"];
			$_SESSION['fecha']=$fecha;  
		}else{
			$fecha=$_SESSION['fecha'];
		}
	?>
</head>
<body>
	<div class="container-fixed">
		<div class="row" id="menu">
			<div class="col-sm-12">
				<nav class="navbar navbar-expand-sm bg-primary navbar-light">
					<button class="navbar-toggler btn-sm" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="collapsibleNavbar">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link btn-sm active"  href="inicio.php">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm"  href="tickets.php">Tickets</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm"  href="resultados.php">Resultados</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm"  href="ganadores.php">Ganadores</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm"  href="reportes.php">Reportes</a>
							</li>
							<li style="float: right;">
								<a class="nav-link btn-sm"><?php echo date("h:i")." ".date("d/m"); ?></a>
							</li>
							<li style="float: right;">
								<a class="nav-link btn-sm" href="pago.php"><?php echo $_SESSION["usuario"];?></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<div class="row" id="show">	
			<div class="col-sm-9"  id="contenSubmits">
				<div id="text-submit" style="width: 200px;">
					<form method="GET" name="fechaF"  action="">  
            			<input type="date" name="fecha" step="1" min="2017-11-01" max="2018-12-31" value="<?php echo $_SESSION['fecha'];?>"onchange = "this.form.submit()" id="text" >
					</form>
				</div>
			</div>
		</div>
		<div class="row" id="show">
			<div id="contenListaTicket" style="width:65%;height: 500px;">
				<table border = 0 class="table" id = "showTable" style="width: 80%;">
					<tr id ="showP">
						<td>Ticket</td>
						<td>Sorteo</td>
						<td>Animal</td>	
						<td>Total</td>
						<td>Estado</td>
					</tr>
					<?php 
						$db = mysqli_connect('localhost','root','','loteria');
						$fecha=$_SESSION['fecha'];
						$sql="SELECT * FROM ganadores WHERE fecha='$fecha' ORDER BY id DESC";
						$result = mysqli_query($db,$sql);
						while ($raw=mysqli_fetch_array($result)){
							if($raw[6]==0){
								$estado="Por pagar";
								$td="<td style='color:#D72A2A;'>";
							}else{
								$estado="Pagado";
								$td="<td style='color:#1D1DC8;'>";
							}
							echo"
							<tr id='showS'>
							".$td."".$raw[2]."</td>
							".$td."".$raw[5]."</td>
							".$td."".$raw[7]."</td>
							".$td."".$raw[3]."</td>
							".$td."".$estado."</td>
							</tr>"; 
						}
					?>
				</table>
			</div>
		</div> 
</body>
</html>


