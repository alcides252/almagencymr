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
		if(isset($_GET["fecha2"])){
			$fecha2=$_GET["fecha2"];
			$_SESSION['fecha2']=$fecha2;	
			$sql="SELECT * FROM tickets WHERE fecha BETWEEN '$fecha' AND '$fecha2' AND estado!='2'";
		}else{
			if(isset($_SESSION["fecha2"])){
				$fecha2=$_SESSION['fecha2'];
			}else{
				$_SESSION['fecha2']=$fecha;	
				$fecha2=$fecha;
			}
			$sql="SELECT * FROM tickets WHERE fecha='$fecha' AND estado!='2'";
		}
		if(isset($_GET["sorteo"])){
			$sorteo=$_GET["sorteo"];
			$_SESSION['sorteo']=$sorteo;	
		}else{
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
			<div class="col-sm-12"  id="contenSubmits">
				<div id="text-submit" style="width: 390px;">
					<form method="GET" name="fechaF"  action=""> 
						<a style="color:#3A3A3A;font: 14px Arial, Helvetica;">Desde</a>
						<input type="date" name="fecha" step="1" min="2017-11-01" max="2018-12-31" value="<?php echo $_SESSION['fecha'];?>" id="text" >
						<a style="color:#3A3A3A;font: 14px Arial, Helvetica;">Hasta</a>
						<input type="date" name="fecha2" step="1" min="2017-11-01" max="2018-12-31" value="<?php echo $_SESSION['fecha'];?>"onchange = "this.form.submit()" id="text" >
					</form>
				</div>
			</div>
		</div>
		<div class="row" id="show">	
			<div class="col-sm-12" id="contenNumeros">
				<table border =0 class="table-bordered" style="margin-top: 5px;width: 95%;margin:auto;">
					<tr style="background:#8F9FFF">
						<td>Desde</td>
						<td>Hasta</td>
						<td>Tickets</td>
						<td>Efectivo</td>
						<td>Credito</td>
						<td>Total</td>
						<td>Premio</td>
						<td>Porcentaje</td>
						<td>Caja</td>
						<td>Efectivo en caja</td>
					</tr>
					<?php
						if($result){
							if(isset($_GET["fecha"])){
								$fecha=$_GET["fecha"];
							}
							$tickets=0;
							$vendido=0;
							$efectivo=0;
							$credito=0;
							$efectivoP=0;
							$creditoP=0;
							$pagado=0;
							while ($raw=mysqli_fetch_array($result))
							{
								$tickets ++;
								$vendido = $vendido + $raw[7];
								$pagado = $pagado + $raw[5];
								if($raw[6]!=""){
									$credito+=$raw[7];
									$creditoP+=$raw[5];
								}else{
									$efectivo+=$raw[7];
									$efectivoP+=$raw[5];
								}
							}
							$porcentaje = ($efectivo*0.10)+($credito*0.05);
							$total=$vendido-$pagado;			
							if($total-$porcentaje<0){
								$colorT="#D72A2A";
							}else{
								$colorT="#1D1DC8";
							}
							echo"
							<tr>
								<td>".$fecha."</td>
								<td>".$fecha2."</td>
								<td>".number_format($tickets)."</td>
								<td>".number_format($efectivo)."</td>
								<td>".number_format($credito)."</td>
								<td style='color:  #1D1DC8'>".number_format($vendido)."</td>
								<td style='color:  #D72A2A'>".number_format($pagado)."</td>
								<td>".number_format($porcentaje)."
								<td style='color:  ".$colorT."'>".number_format($total)."</td>
								<td style='color:  ".$colorT."'>".number_format($total-$credito+$creditoP)."</td>
								</td>
							</tr>";
						}         
					?>
				</table>
				<table border =0 class="table-bordered" style="width: 95%;margin:auto;">
					<tr style="background:#8F9FFF">
						<td>Sorteo</td>
						<td>Total</td>
						<td>resultado x BS</td>
						<td>Premio</td>
						<td>Caja</td>
						<td>Efectivo</td>
					</tr>
					<?php
						if($result){
							$tickets=0;
							$vendido=0;
							$ventas=0;
							$credito=0;
							$efectivoP=0;
							$efectivoT=0;
							$creditoP=0;
							$pagado=0;
							$sqlS="SELECT * FROM sorteos";
							$resultS=mysqli_query($db,$sqlS);
							while ($rawS=mysqli_fetch_array($resultS))
							{	
								$vendido=0;
								$resultadoVendido=0;
								$efectivoCaja=0;
								$resultado=0;
								$sorteoS=$rawS[1];
								$sqlN="SELECT * FROM numeros WHERE fecha='$fecha' AND sorteo='$sorteoS'";
								$resultN=mysqli_query($db,$sqlN);
								while ($rawN=mysqli_fetch_array($resultN))
								{	
									$id_t=$rawN[0];
									$sqlT="SELECT * FROM tickets WHERE  id='$id_t' AND fecha='$fecha' AND estado!='2'";
									$resultT=mysqli_query($db,$sqlT);
									while ($rawT=mysqli_fetch_array($resultT))
									{	
										$vendido+=$rawN[3];
										if($rawT[6]!=""){
											$efectivoP+=$rawN[3];
										}
									}
								}
								$sqlR="SELECT * FROM resultados WHERE fecha='$fecha' AND sorteo='$sorteoS'";
								$resultR=mysqli_query($db,$sqlR);
								while ($rawR=mysqli_fetch_array($resultR))
								{	
									$resultado=$rawR[3];
								}
								$sqlN="SELECT * FROM numeros WHERE fecha='$fecha' AND sorteo='$sorteoS' AND numero='$resultado'";
								$resultN=mysqli_query($db,$sqlN);
								while ($rawN=mysqli_fetch_array($resultN))
								{	
									$resultadoVendido+=$rawN[3];
								}
								if(($vendido-($resultadoVendido*30))<0){
									$efectivoCaja=($vendido-($resultadoVendido*30)+$efectivoP);
								}else{
									$efectivoCaja=($vendido-($resultadoVendido*30)-$efectivoP);
								}
								echo"
									<tr>
									<td>".$rawS[1]."</td>
									<td>".number_format($vendido)."</td>
									<td>".number_format($resultado)."  x  ".number_format($resultadoVendido)."</td>
									<td>".number_format($resultadoVendido*30)."</td>
									<td>".number_format($vendido-($resultadoVendido*30))."</td>
									<td>".number_format($efectivoCaja)."</td>
									</td>
								</tr>";
								$ventas+=$vendido;
								$pagado+=($resultadoVendido*30);
								$efectivoT+=$efectivoCaja;
								$efectivoP=0;
							}
							echo"
								<tr>
								<td></td>
								<td>".number_format($ventas)."</td>
								<td></td>
								<td>".number_format($pagado)."</td>
								<td>".number_format($ventas-$pagado)."</td>
								<td>".number_format($efectivoT)."</td>
								</td>
							</tr>";
						}         
					?>
				</table>
			</div>
		</div>
		</div>
</body>
</html>


