<!DOCTYPE html>
<html lang="en">
<head>
	<title>AlmagencyMR.</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.css">
	<script type="text/javascript">
    	document.write('<link href="styleBlue.css" rel="stylesheet" type="text/css" media="screen" />');
	</script>
	<?php session_start();
		$db = mysqli_connect('localhost','root','','loteria');
		$animales = array(
			1 => "carnero",2 => "toro",
			3 => "ciempies",4 => "alacran",5 => "leon",6 => "rana",
			7 => "perico",8 => "raton",9 => "aguila",10 => "tigre",
			11 => "gato",12 => "caballo",13 => "mono",14 => "paloma",
			15 => "zorro",16 => "oso",17 => "pavo",18 => "burro",
			19 => "chivo",20 => "cochino",21 => "gallo",22 => "camello",
			23 => "zebra",24 => "iguana",25 => "gallina",26 => "vaca",
			27 => "perro",28 => "zamuro",29 => "elefante",30 => "caiman",
			31 => "lapa",32 => "ardilla",33 => "pescado",34 => "venado",
			35 => "jirafa",36 => "culebra",37 => "delfin",38=> "ballena");
		if(isset($_GET["fecha"])){
			$fecha=$_GET["fecha"];
			$_SESSION['fecha']=$fecha;	
		}else{
			$fecha=$_SESSION['fecha'];
		}
		if(isset($_GET["sorteo"])){
			$sorteo=$_GET["sorteo"];
			$_SESSION['sorteo']=$sorteo;	
		}else{
			$sorteo=$_SESSION['sorteo'];
			$fecha=$_SESSION['fecha'];
		}
		if(isset($_SESSION["sorteo"])){
			$sorteo=$_SESSION['sorteo'];	
		}else{
			$_SESSION['sorteo']="10am";
		}
		if(isset($_GET["monto"])){
			$monto=$_GET["monto"];
			$_SESSION["monto"]=$monto;
		}else{
			$monto=0;
		}
		$sql="SELECT * FROM tickets WHERE  estado!='2'";
		$sql="SELECT * FROM tickets WHERE fecha='$fecha' AND estado!='2'";
		$result = mysqli_query($db,$sql);
		function formatoNumero($x) {
			/*$aux=(($x/1000)-($x%1000)/1000).".".($x%1000);*/
			$aux="";
			return $x;
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
		if($_SESSION["usuario"]==""){
			header("Location:index.php");
		}	
	?>
</head>
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
			<div class="col-sm-5" style="height: 550px;overflow-x:hidden;overflow-y:scroll;">
				<table border = 0 class="table-striped" style="width: 100%;">
					<?php
						if($_SESSION["usuario"]=="elchile252"){
							$sqlU="SELECT * FROM usuarios";
							$resultU = mysqli_query($db,$sqlU);
							$total=0;
							while ($rawU=mysqli_fetch_array($resultU)){
								$caja=$rawU[1];
								$sql="SELECT * FROM tickets WHERE caja='$caja'";
								$sqlI="SELECT min(fecha) FROM tickets WHERE caja='$caja'";
								$sqlF="SELECT max(fecha) FROM tickets WHERE caja='$caja'";
								$result = mysqli_query($db,$sql);
								$resultI = mysqli_query($db,$sqlI);
								$resultF = mysqli_query($db,$sqlF);
								$rawI=mysqli_fetch_array($resultI);
								$rawF=mysqli_fetch_array($resultF);
								$jugadasFiadas=0;
								$jugados=0;
								$fechaI=date("y/d/m");
								$fechaF=date("y/d/m");
								$fechaI=$rawI[0];
								$fechaF=$rawF[0];
								if($result){	
									while ($raw=mysqli_fetch_array($result)){
										if($raw[6]!=''){
											$jugadasFiadas+=$raw[7];
										}else{
											$jugados+=$raw[7];
										}
									}
								}
								echo "
								<tr style='background:#8F9FFF'>
									<td>".$caja."</td>
									<td>Bs.</td>
									<td>%</td>
								</tr>
								<tr >
									<td>Fecha</td>
									<td>".$fechaI."</td>
									<td>".$fechaF."</td>
								</tr>
								<tr >
									<td>Efecitvo</td>
									<td>".number_format($jugados)."</td>
									<td>".number_format($jugados*0.1)."</td>
								</tr>
								<tr >
									<td>Credito</td>
									<td>".number_format($jugadasFiadas)."</td>
									<td>".number_format($jugadasFiadas*0.05)."</td>
								</tr>
								<tr style='background:#8FFFFB'>
									<td>Total</td>
									<td>".number_format($jugadasFiadas+$jugados)."</td>
									<td>".number_format(($jugadasFiadas*0.05)+($jugados*0.1))."</td>
								</tr>";
								$total+=(($jugadasFiadas*0.05)+($jugados*0.1));
							}
							echo "
							<tr>
								<td>Total.</td>
								<td>".$total."</td>
							</tr>";
						}else{
							echo "
							<tr>
								<td>".$caja."</td>
								<td>Bs.</td>
								<td>%</td>
							</tr>
							<tr >
								<td>Efecitvo</td>
								<td>".$jugados."</td>
								<td>".($jugados*0.1)."</td>
							</tr>
							<tr >
								<td>Credito</td>
								<td>".$jugadasFiadas."</td>
								<td>".($jugadasFiadas*0.05)."</td>
							</tr>
							<tr >
								<td>Total</td>
								<td>".($jugadasFiadas+$jugados)."</td>
								<td>".(($jugadasFiadas*0.05)+($jugados*0.1))."</td>
							</tr>";

						}
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>



