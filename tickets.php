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
		session_start();	
		if($_SESSION["usuario"]==""){
			header("Location:index.php");
		}else{
			if(isset($_GET["fecha"])){
				$fecha=$_GET["fecha"];
				$_SESSION['fecha']=$fecha;  
			}else{
				$fecha=$_SESSION['fecha'];
			}
		}
		function animales($num,$conn) {
			$sql="SELECT nombre FROM lotoactivo WHERE id='$num'";
			$resultado = mysqli_query($conn,$sql);
			$row=mysqli_fetch($resultado);
			echo $row;
		}
		$animales = array(1 => "carnero",2 => "toro",3 => "ciempies",4 => "alacran",5 => "leon",6 => "rana",7 => "perico",8 => "raton",9 => "aguila",10 => "tigre",11 => "gato",12 => "caballo",13 => "mono",14 => "paloma",15 => "zorro",16 => "oso",17 => "pavo",18 => "burro",19 => "chivo",20 => "cochino",21 => "gallo",22 => "camello",23 => "zebra",24 => "iguana",25 => "gallina",26 => "vaca",27 => "perro",28 => "zamuro",29 => "elefante",30 => "caiman",31 => "lapa",32 => "ardilla",33 => "pescado",34 => "venado",35 => "jirafa",36 => "culebra",37 => "delfin",38=> "ballena");
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
				<div id="text-submit" style="width: 200px">
					<form method="GET" name="formulario"  action="">
						<SELECT type="text" onchange = "this.form.submit()" name="nombre" id="text" >
							<?php         
							echo "<option>Buscar</option>";                   
							$db = mysqli_connect('localhost','root','','loteria');
							$sql="SELECT * FROM tickets WHERE nombre!='' AND fecha='$fecha'";
							$result = mysqli_query($db,$sql);
							while ($raw=mysqli_fetch_array($result))
							{
								echo "<option>$raw[6]</option>";                   
							}
							?> 
						</SELECT>
						<input type="submit" id="submit" name ="boton" value="Buscar" />
					</form>
				</div>
				<div id="text-submit" style="width: 400px;">
					<form method="GET" name="formulario"  action="">
						<input type='submit' id='submit' name ='Final' onclick='this.form.submit()' value='Final' />
					</form>
				</div>
			</div>
		</div>
		<div class="row" id="show">	
			<div class="col-sm-9" id="contenListaTicket" style="height: 600px;">
				<table border = 0 class="table" style="width: 75%;">
					<?php
						$db = mysqli_connect('localhost','root','','loteria');
						if(isset($_GET["fecha"])){
							$fecha=$_GET["fecha"];
							$_SESSION['fecha']=$fecha;	
						}else{
							$fecha=$_SESSION['fecha'];
						}
						if(isset($_GET["nombre"])){
							$nombre=$_GET["nombre"];
							$sql="SELECT * FROM tickets WHERE nombre='$nombre' AND estado!=2 AND id>10100 ORDER BY id DESC";
							$sql="SELECT * FROM tickets WHERE nombre='$nombre' AND fecha='$fecha' AND estado!=2 ORDER BY id DESC";
						}else{
							$sql="SELECT * FROM tickets WHERE fecha='$fecha' ORDER BY id DESC";
							$nombre="";
						}
						if(!isset($_GET["Final"])){
							$result = mysqli_query($db,$sql);
							$pagados=0;
							$jugados=0;
							if(!$result){
								echo "<b>Error de busqueda</b>"; 
							exit;          
							}else{
								echo "<tr id ='showP'>
										<td>Numero</td>
										<td>Fecha</td>
										<td>Nombre</td>
										<td>Hora</td>
										<td>Status</td>
										<td>Caja</td>
										<td>Total</td>
									</tr>";
								while ($raw=mysqli_fetch_array($result))
								{
									if($raw[5]==2){
										$estado="Anulado";
									}else{
										$estado=$raw[5];
									}
									echo"
									<form method='GET' name='fechaF'  action=''>  

									<tr id='showS'>
										<td ><input type='submit' style='width: 80px;' name='detalles' value=".$raw[0]."></td>
										<td>".$raw[2]."</td>
										<td>".$raw[6]."</td>
										<td>".$raw[3]."</td>
										<td>".$estado."</td>
										<td>".$raw[4]."</td>
										<td>".$raw[7]."</td>
									";
									$jugados+=$raw[7];
									$pagados+=$raw[5];
									$nombre =$raw[6];
								}
								if(isset($_GET["nombre"])){
									echo "<tr id='showS' style='color:#E32222'>
										<td></td>
										<td></td>
										<td>".$nombre. "</td>
										<td></td>
										<td>".$pagados."</td>
										<td></td>
										<td>".$jugados."</td>
										<td>".($jugados-$pagados)."</td>
									</tr></form>";
								}
							}
						}else{
								echo "<tr id='showP'><td>Nombre</td><td>Jugado</td><td>Ganado</td><td>Total</td></tr>";
								$sql="SELECT * FROM tickets WHERE fecha='$fecha' AND estado!=2 ORDER BY nombre";
								$result = mysqli_query($db,$sql);
								$i=0;
								$nom="";
								$Tjugados=0;
								$Tpagados=0;
								if($result){
									while ($raw=mysqli_fetch_array($result))
									{
										if($nom==""){
											$nom=$raw[6];
										}else{
											if($nom!=$raw[6]){
												$sql2="SELECT estado,total FROM tickets WHERE fecha='$fecha' AND nombre='$nom' AND estado!=2 ORDER BY nombre";
												$result2 = mysqli_query($db,$sql2);	
												$jugados=0;
												$pagados=0;
												$total=0;
												while ($raw2=mysqli_fetch_array($result2))
												{
													$jugados+=$raw2[1];
													$pagados+=$raw2[0];
													$total=$jugados-$pagados;
												}
												$Tjugados+=$jugados;
												$Tpagados+=$pagados;
												if($total>0){	
													$color="#1823FD";
												}else{
													$color="#B20000";
												}
												echo"<tr id='showS'><td>".$nom."</td><td style='color:#B20000'>".$jugados."</td><td style='color:#1823FD'>".$pagados."</td><td style='color:".$color."'>".$total."</td></tr>";
												
												$nom=$raw[6];
											}else{
												$nom=$raw[6];
											}
										}
									}
									$sql2="SELECT estado,total FROM tickets WHERE fecha='$fecha' AND nombre='$nom' ORDER BY nombre";
									$result2 = mysqli_query($db,$sql2);	
									$jugados=0;
									$pagados=0;
									$total=0;
									while ($raw2=mysqli_fetch_array($result2))
									{
										$jugados+=$raw2[1];
										$pagados+=$raw2[0];
										$total=$jugados-$pagados;
									}
									$Tjugados+=$jugados;
									$Tpagados+=$pagados;
									$Ttotal= $Tjugados-$Tpagados;
												if($total>0){	
													$color="#1823FD";
												}else{
													$color="#B20000";
												}
									echo"<tr id='showS'><td>".$nom."</td><td style='color:#B20000'>".$jugados."</td><td style='color:#1823FD'>".$pagados."</td><td style='color:".$color."'>".$total."</td></tr>";
									echo"<tr id='showS'><td>Total</td><td style='color:#B20000'>".$Tjugados."</td><td style='color:#1823FD'>".$Tpagados."</td><td style='color:".$color."'>".$Ttotal."</td></tr>";
									echo"</table>";


								}else{
									echo "<b>Error de busqueda</b>"; 
								}
						}
					?>
				</table>
				<table border = 0 class="table" style="margin-left: 2px;width: 10%">
					<tr id ="showP">
						<td>Sorteo</td>
						<td>Animalito</td>
						<td>Bs.</td>
					</tr>
					<?php
						$db = mysqli_connect('localhost','root','','loteria');
						if(isset($_GET["numero"])){
							$numero=$_GET["numero"];
						}
						if(isset($_GET["detalles"])){
							$numero=$_GET["detalles"];
						}
						if(isset($numero)){
							$sql="SELECT * FROM numeros WHERE id_t='$numero' ORDER BY numero";
							$result = mysqli_query($db,$sql);
							if(!$result){
								echo "<b>Error de busqueda</b>"; 
								exit;          
							}else{
								$i =0;
								$total =0;
								while ($raw=mysqli_fetch_array($result))
								{
									echo"<tr id='showS'><td>".$raw[5]."</td><td>".$raw[4]."-".$animales[$raw[4]]."</td><td>".$raw[3]."</td</tr>";
									$i++;
									$total += $raw[3];
									
								}
								echo"<tr id='showS'><td></td><td></td><td>".$total."</td></tr>";
								echo "</table>";

							}
						}
					?>
				</table>
			</div>
			<div class="col-sm-3" id="contenResultados">
				<table border = 0 id = "showTable">
					<?php
						$conn = new mysqli("localhost", "root", "", "loteria");
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
								if($i<4){
									echo "
									<td id='cNum'>
										<image id='img'  type=image src='./imagenes/".$raw[3].".png' >
										<input value=".$raw[4]." type='text' readonly>
									</td>";
								}else{
									if($i==4){
										echo "</tr>";
										$i=0;
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

