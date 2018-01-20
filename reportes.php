<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
	<title>agencia de loteria Primos Romero</title>
	<script type="text/javascript" src="codigo.js"></script>
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
		$sql="SELECT * FROM tickets";
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
		}else{
			if($_SESSION["usuario"]=="elchile252"){
				header("Location:reportesAD.php");
			}else{
				header("Location:reportesAD.php");
			}
		}
	?>
</head>
<body >
	<div id="wrapper">
		<div id="menu">
			<ul>
			<li><a href="inicio.php">Inicio</a></li>
			<li><a href="tickets.php">Tickets</a></li>
			<li><a href="resultados.php">Resultados</a></li>
			<li><a href="ganadores.php">Ganadores</a></li>
			<li class="current_page_item"><a href="reportes.php">Reportes</a></li>
			<li><a><?php echo $_SESSION["usuario"];?></a></li>
			<li><a href="pago.php">Pago</a></li>
			<li><a href="index.php">Cerrar Sesion</a></li>
			</ul>
		</div>
		<div id="show">
			<div id="contenSubmits">
				<div id="text-submit" style="width: 200px">
					<form method="GET" name="fechaF"  action="">  
						<input type="text" id="text" name ="fecha" value="<?php if(isset($_SESSION['fecha'])){echo  $_SESSION['fecha'];}else{echo date("y/m/d");}?>" />
						<input type="submit" id="submit" name ="boton" value="Aceptar" />
					</form>
				</div>
				<div id="text-submit" style="width: 600px">
					<form method="GET" name="fechaF"  action="">  
						<SELECT type="text" name="sorteo" id="text" ><option><?php echo sorteoActual();?></option>
							<option>10am</option>
							<option>11am</option>
							<option>12m</option>
							<option>1pm</option>
							<option>4pm</option>
							<option>5pm</option>
							<option>6pm</option>
							<option>7pm</option>
						</SELECT>
						<SELECT type="text" name="monto" onchange = "this.form.submit()" id="text" ><option><?php if(isset($_SESSION["monto"])){ echo $_SESSION["monto"];};?></option>
							<option>1000</option>
							<option>2000</option>
							<option>3000</option>
							<option>4000</option>
							<option>5000</option>
						</SELECT>
					</form>
				</div>
			</div>
			<div id="contenNumeros" style="width: 800px;float: left;">
				<table border = 1 id = "showTable">
					<tr id ="showP">
						<td><p>Vendidos</p></td>
						<td><p>Vendido(BS)</p></td>
						<td><p>Pagado(Bs)</p></td>
						<td><p>Total</p></td>
						<td><p>Porcentaje</p></td>
					</tr>
					<?php
						if(!$result){
							echo "<script>alert('Error de busqueda')</script>"; 
						}else{
							$tickets=0;
							$vendido=0;
							$pagado=0;
							while ($raw=mysqli_fetch_array($result))
							{
								$tickets ++;
								$vendido = $vendido + $raw[7];
								$pagado = $pagado + $raw[5];
							}
							$porcentaje = $vendido*0.10;
							$total=$vendido-$pagado;						
							echo"
							<tr id='showS'>
								<td><p>".$tickets."</p></td>
								<td><p>".formatoNumero($vendido)."</p></td>
								<td style='color:  #D72A2A'><p>".formatoNumero($pagado)."</p></td>
								<td style='color:  #1D1DC8'><p>".formatoNumero($total)."</p></td>
								<td><p>".formatoNumero($porcentaje)."</p>
								</td>
							</tr>";
						}         
					?>
				</table>
				<table border = 0 id = "showTableRight" style="float:right;">          
					<tr id ="showP">
						<td>Numero.</td>
						<td>Bs.</td>
					</tr>        
					<?php
						$tapa = new SplFixedArray(39);
						$sorteo =sorteoActual();
						if(isset($_GET["sorteo"])){
							$sorteo=$_GET["sorteo"];
							$_SESSION["sorteo"]=$sorteo;
						}else{
							$sorteo="10am";
						}
						if(isset($_GET["monto"])){
							$monto=$_GET["monto"];
							$_SESSION["monto"]=$monto;
						}else{
							$monto=0;
						}
						$sql="SELECT * FROM numeros WHERE fecha='$fecha' AND sorteo='$sorteo' ORDER BY numero";
						$result = mysqli_query($db,$sql);
						if(!$result){
							echo "<b>Error de busqueda</b>"; 
							exit;          
						}else{
							$i =0;
							$total2 =0;
							$total3 =0;
							while ($raw=mysqli_fetch_array($result))
							{
								$j =$raw[4];
								$tapa[$j] = $tapa[$j] + $raw[3];
								$i++;
							}
							$i =0;
							$j =$monto;
							foreach($tapa	 as $v) {
								if((!$v=="")and($v>=$j)){
									
									echo"
									<tr id='showS'>
										<td>".$i."-".$animales[$i]."</td>
										<td>".($v-$j)."</td>
									</tr>";
									$total3 += $v-$j;
								}
								$total2 += $v;
								$i++;
							}
							echo"
							<tr id='showS'>
								<td >Disponible ".($total2-$total3)."</td>
								<td >Ventas ".($total2)."</td>
							</tr>
							<tr id='showS'>
								<td style='background:none;'></td>
								<td
								>Excedente ".($total3)."</td>
							</tr>";
							echo "</table>";

						}
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
