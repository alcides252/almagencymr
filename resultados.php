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
	<?php 		
		function animales($num,$conn) {
			$sql="SELECT nombre FROM lotoactivo WHERE id='$num'";
			$resultado = mysqli_query($conn,$sql);
			$row=mysqli_fetch($resultado);
			echo $row;
		}
		$animales = array(1 => "carnero",2 => "toro",3 => "ciempies",4 => "alacran",5 => "leon",6 => "rana",7 => "perico",8 => "raton",9 => "aguila",10 => "tigre",11 => "gato",12 => "caballo",13 => "mono",14 => "paloma",15 => "zorro",16 => "oso",17 => "pavo",18 => "burro",19 => "chivo",20 => "cochino",21 => "gallo",22 => "camello",23 => "zebra",24 => "iguana",25 => "gallina",26 => "vaca",27 => "perro",28 => "zamuro",29 => "elefante",30 => "caiman",31 => "lapa",32 => "ardilla",33 => "pescado",34 => "venado",35 => "jirafa",36 => "culebra",37 => "delfin",38=> "ballena");
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
		function alertP($string) {
			echo "<script>alert('".$string."')</script>";
			echo "<script>alert('".$string."')</script>";
		}
		function recargar($mensaje) {
			if($mensaje!=""){
				echo "<script>alert('".$mensaje."')</script>";
				echo "<script>window.location='resultados.php'</script>";
			}
		}
		function redireccionar($mensaje,$pagina) {
			if($mensaje!=""){
				echo "<script>alert('".$mensaje."')</script>";
				echo "<script>window.location='".$pagina."	'</script>";
			}
		}
	    function sorteoActual($x){

	      $hora =3;
	      $hora =date("h");
	      $hora = $hora - $x;
	      switch ($hora) {
	        case 1:
	          $sorteo='3pm';
	          break;  
	        case 2:
	          $sorteo='3pm';
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
	          $sorteo='9am';
	          break;  
	        case 8:
	          $sorteo='9am';
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
								<a class="nav-link btn-sm"  href="inicio.php">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm active"  href="tickets.php">Tickets</a>
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
			<div class="col-sm-9"  id="contenListaTicket">
				<form  name=”datos” method="GET" action="">
					<table border = 0 id = "showTableRight" style="float:right;">
						<tr>
							<td>
								<input type="text"  name="sorteo" id="text" value="<?php echo sorteoActual(1);?>" />
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" placeholder=" Numero" name="numero" id="text2" value="" />
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" placeholder=" Clave" name="clave" id="text" value="" />
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" id="submit" name ="boton" value="Aceptar" />
							</td>
						</tr>
						<?php
							$conn = new mysqli('localhost', 'root', '', 'loteria');
							if(isset($_GET["boton"]) and $_GET["boton"]=="Aceptar"){
								$numero = $_GET["numero"];
								$sorteo = $_GET["sorteo"];
								$clave = $_GET["clave"];
								$_SESSION["sorteo"]=$sorteo;
								$sql="SELECT nombre FROM lottoactivo WHERE id='$numero'";	
								$result = mysqli_query($conn,$sql);
								$raw=mysqli_fetch_array($result);
								$animal=$raw[0];
								$fecha=date("y/m/d");
								$hora=date("h:i:s");
								if ($sorteo!="Sorteo"){
									if (!$numero == ""){
										$usuario=$_SESSION["usuario"];
										$sql="SELECT * FROM usuarios WHERE usuario='$usuario'";	
										$result = mysqli_query($conn,$sql);
										$raw=mysqli_fetch_array($result);
										if ($clave != ""){
											if ($clave == $raw[2]){
												$sql = "INSERT INTO resultados (fecha, hora,numero,sorteo) VALUES ('$fecha','$hora','$numero', '$sorteo')";
												if ($conn->query($sql) === TRUE) {
										            $sql3 = "SELECT * FROM numeros WHERE numero='$numero' AND sorteo ='$sorteo' AND fecha='$fecha'";
										            $rs3 = mysqli_query($conn,$sql3);
													while ($raw=mysqli_fetch_array($rs3)){
														$sqlS="SELECT * FROM tickets WHERE id='$raw[0]'";	
														$resultS = mysqli_query($conn,$sqlS);
														$rawS=mysqli_fetch_array($resultS);
														$serialT=$rawS[1];
														$total=$raw[3]*30;
														$sqlINS = "INSERT INTO ganadores (serialT,ticket,premio,fecha,sorteo,estado,numero,totalT) VALUES ('$serialT','$raw[0]','$total','$fecha','$sorteo','0','$numero','$rawS[7]')";
														if ($conn->query($sqlINS) === TRUE) {
															redireccionar("ganadores listos","ganadores.php");
														}else{
															recargar("ganadores no listos");
														}
													}
												} else {
													alertP("Error: ".$sql." ".$conn->error);
												}                  
											}else{
												recargar("Clave incorrecta");
											}
										}else{
											recargar("Por favor ingrese su clave");
										}
									}else{
										recargar("Campo numero vacio");
									}
								}else{
									recargar("Debe Seleccionar un sorteo");
								}
							}
						?>
					</table>
				</form>	
				<table border = 0 id = "showTable" style="width: 65%;">
					<?php
						$sql="SELECT * FROM resultados WHERE fecha='$fecha'";
						$result = mysqli_query($conn,$sql);
						if(!$result){
							echo "<b>Error de busqueda</b>"; 
						exit;          
						}else{
							$i=0;
							echo"<tr>";
							while ($raw=mysqli_fetch_array($result))
							{
								if($i<5){
									echo "
									<td id='cNum'>
										<image id='img'  type=image src='./imagenes/".$raw[3].".png' >
										<input value=".$raw[4]." type='text' readonly>
									</td>";
								}else{
									if($i==5){
										echo "</tr>";
									}
									if($i<10){
										echo "
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".$raw[3].".png' >
											<input value=".$raw[4]." type='text' readonly>
										</td>";
									}
								}
								$i++;
							}
						}
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>


