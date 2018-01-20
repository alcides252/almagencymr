<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
	<title>AlmagencyMR.</title>
	<?php
		$animales = array(1 => "carnero",2 => "toro",3 => "ciempies",4 => "alacran",5 => "leon",6 => "rana",7 => "perico",8 => "raton",9 => "aguila",10 => "tigre",11 => "gato",12 => "caballo",13 => "mono",14 => "paloma",15 => "zorro",16 => "oso",17 => "pavo",18 => "burro",19 => "chivo",20 => "cochino",21 => "gallo",22 => "camello",23 => "zebra",24 => "iguana",25 => "gallina",26 => "vaca",27 => "perro",28 => "zamuro",29 => "elefante",30 => "caiman",31 => "lapa",32 => "ardilla",33 => "pescado",34 => "venado",35 => "jirafa",36 => "culebra",37 => "delfin",38=> "ballena");
		session_start();
		$conn = new mysqli("localhost", "root", "", "loteria");
		function animales($num,$conn) {
			$sql="SELECT nombre FROM lotoactivo WHERE id='$num'";
			$resultado = mysqli_query($conn,$sql);
			$row=mysqli_fetch($resultado);
			echo $row;
		}
		$fecha=date("y/m/d");
		$horaT=date("h:i:s");
		$hr=date("h");
		$hora =6;
		$hora =date("h");
		$min=date("i");
		$caja=$_SESSION["usuario"];
		$total=0;
		$nombre="";
		if(!isset($_SESSION["id"])){
			$sql="SELECT max(id) FROM tickets";
			$resultado = mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($resultado);
			$_SESSION["id"]=$row[0];
		}
		echo "<script> id=".($_SESSION["id"])."</script>";
		if($_SESSION["usuario"]==""){
			header("Location:index.php");
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
	?>
	<script type="text/javascript">
		var txt=[];
		var total=0;
		var bsM=0;
		var max=[];
		var id=0;
		var sorteo=[""];
		var animales = ["carnero","toro","ciempies","alacran","leon","rana","perico","raton","aguila","tigre","gato","caballo","mono","paloma","zorro","oso","pavo","burro","chivo","cochino","gallo","camello","zebra","iguana","gallina","vaca","perro","zamuro","elefante","caiman","lapa","ardilla","pescado","venado","jirafa","culebra","delfin","ballena"]
		var idR=1;
		pantalla=screen.width
		if(pantalla>1000){
			document.write('<link href="style.css" rel="stylesheet" type="text/css" media="screen" />');
		}else{
			document.write('<link href="style.css" rel="stylesheet" type="text/css" media="screen" />');

		}
		function cargarE($animal) {
			var t=0;
			var bs=0;
			var loteria="";
			if(bsM!=0){
				bs=bsM
			}else{
				for (var i = 0; i < document.montos.length; i++) {
					if ((document.montos[i].checked==1) ) {
						bs=document.montos[i].value
					}
				}
			}
			e=0;
			for (var i = 0; i < document.loterias.length; i++) {
				if ((document.loterias[i].checked==1) ) {
					document.getElementById("showNum").style.display="block"
					var animal=$animal
					var sor="     <td><input id='ticketF' name ='sorteos[]' value="+document.loterias[i].value+" type='text' readonly></td>"
					var precio =" <td><input id='ticketF' name ='numeros[]' value="+animal+" type='text'readonly></td>"
					var nomb="    <td><input id='ticketF' value="+animales[$animal-1]+" type='text'readonly></td>"
					var monto="   <td><input id='ticketF' name ='montos[]'value="+bs+" type='text'></td>"
					var eliminar="<td><button id='eliminar' type='button' onclick='quitar("+idR+","+parseInt(bs)+","+$animal+")'>"+idR+"</button></td>"
					var fila=sor+precio+nomb+monto+eliminar;
					idR+=1;
					total=total+parseInt(bs);
					var btn = document.createElement("TR");
					btn.innerHTML=fila;
					document.getElementById("showNum").appendChild(btn);
					document.getElementsByName("total")[0].value=total;
					if($animal==37){
						txt.push("0x"+bs)
					}else{
						if($animal==38){
							txt.push("00x"+bs)
						}else{
							if($animal<10){
								txt.push($animal+"x"+bs)
							}else{
								txt.push($animal+"x"+bs)
							}
						}
					}
				}
			}
			document.getElementById('text').focus();
		}
		function repetir(nombre) {
			alert(nombre);
		}
		function quitar(fila,bs,animal) {
			if(fila!==(document.getElementById("showNum").rows.length)){
				aux = animal+'x'+bs
				for (var i = 0; i < txt.length; i++) {
					if(txt[i]==aux){
						txt.splice(i,1);
					}
				}	
				total = total-bs
				document.getElementById("showNum").deleteRow(fila);
				document.getElementsByName("total")[0].value=total;
				document.getElementById('text').focus();
				idR-=1;
			}
		}
		function ocultar_loto(x){ 
			switch(x) {
				case 1:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 2:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 3:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 4:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 5:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 6:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 7:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("contenMontos").style.display="none" ;
					document.getElementById("contenTickets").style.display="none" ;
				break;
				case 8:
					document.loterias.elements[0].checked=1	
				break;
				case 9:
					document.loterias.elements[0].checked=1	
				break;
				case 10:
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 11:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 12:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 10:
					document.getElementById("10am").style.display="none" ;
				break;
			}				
		} 
		function seleccionar_todo(x){ 
		   for (i=0;i<document.montos.elements.length;i++) 
		      if(document.montos.elements[i].type == "checkbox")
	      		if(i==x){
		      	   document.montos.elements[i].checked=1 
	      		}else{
		      	   document.montos.elements[i].checked=0 
	      		}
		} 
		function completar(linea,y,c){
			x = linea.length
			for (var i = x; i < y; i++) {
				linea=linea+c
			}
			linea=linea+"\n"
			return (linea)
		}
		function imprimir(idA) {
			if(document.getElementsByName("total")[0].value>500){
				texto="";
				for (var i = 0; i < document.loterias.length; i++) {
					if(document.loterias[i].checked==1){
						sorteo.push(document.loterias[i].value)
					}
				}
				var myWindow = window.open("", "Ticket", "width=180,height=300");
				p="<p style='margin: 0;text-align:left; font-size:10px; text-transform:uppercase;'>";
				s=p+"AlmagencyMR.!";
				s+=p+"Ticket: "+(idA);
				s+=p+"Serial: "+(idA*547);
				s+=p+"Caja:<?php echo $_SESSION['usuario'];?>";
				s+=p+"<?php echo $fecha,"  ",$horaT;?>";
				s+=p+"--------------------------------";
				s+=p+"Sorteo: lottoactivo "+sorteo[1];
				e=0;
				for (var i = txt.length - 1; i >= 0; i--) {
					if(e==0){
						if(txt[i]!=""){
							texto+=p+txt[i];
							if(i!=1){
								texto+="  ---  ";
								e++;
							}
						}
					}else{
						if(e==1){
							texto+=txt[i];
							e=0;
						}
					}	
				}
				s+=p+texto;
				s+=p+"--------------------------------";
				s+=p+"total bs: "+document.getElementsByName("total")[0].value;
				s+=p+"Caduca a los 3 dias";
				s+=p+"Revise su ticket";
				s+=p+".";
				s+=p+".";
				s+=p+".";
				s+=p+".";
				myWindow.document.write(s);
				myWindow.document.close();
				myWindow.print();
				myWindow.close();
			}
		}
		function monto(){
			k=window.event.keyCode
			if(k==13){
				if(document.getElementById("text").value!="" && parseInt(document.getElementById("text").value)>=0 && parseInt(document.getElementById("text").value)<=36){
					document.getElementById('text2').focus();
					document.getElementById('text2').select();
				}else{
					alert("Debe ingresar un numero entre 0-36");
				}
			}else{
				if(k==186){
					document.getElementById('submitT').focus();
					document.getElementById("text").value="";
				}else{
					if(k==97){
						anularTicket()
					}else{
						if(k==112){
							pagarTicket()
						}else{
							if(k==107){
								listaTicket()
							}else{
								if(k==110){
									document.getElementById('nombre').focus();
									document.getElementById("text").value="";
								}else{
									if(k==118){
										document.getElementById('text').focus();
										manual()
									}else{
										if(k==114){
											document.getElementById('idRep').focus();
										}
									}
								}
							}
						}

					}

				}
			}
		}		
		function cargarManual(){
			if(window.event.keyCode==13){
				bsM=parseInt(document.getElementById("text2").value)
				if(document.getElementById("text2").value!="" && parseInt(document.getElementById("text2").value)>=100 && parseInt(document.getElementById("text2").value)<=5000){
					if(document.getElementById("text").value!=""){
						if(document.getElementById("text").value=="00"){
							cargarE(38);	
						}else{
							if(document.getElementById("text").value=="0"){
								cargarE(37);
							}else{
								cargarE(parseInt(document.getElementById("text").value));
							}	
						}
					}
					document.getElementById("text").value="";
					document.getElementById('text').focus();
				}else{
					alert("Monto invalido 100bs-5000bs")
					document.getElementById("text2").value="";
					document.getElementById('text2').focus();
				}
			}
		}
		function anularTicket(){	
			var myWindow = window.open("", "Anular", "width=250,height=250");
			p="<link href='style.css' rel='stylesheet' type='text/css' media='screen' />"
			p+="<div id='contenAnular'>"
			p+="<form method='GET' name='formulario'  action=''>"
			p+="<table border='0'>"
			p+="<tr>"
			p+="<td>"
			p+="Anular ticket"
			p+="</td>"
			p+="</tr>"
			p+="<tr>"
			p+="<td>"
			p+="<input type='text' id='anular' placeholder='Ticket' name='idAnular' onkeypress='monto()' value='' />"
			p+="</td>"
			p+="<td>"
			p+="<input type='submit' id='submit' name ='boton' onclick='alert('Seguro que desea anular')' value='Anular' />"
			p+="</td>"
			p+="</tr>"
			p+="</table>"
			p+="</form>"
			p+="</div>"
			p+="<p style='margin: 0;text-align:left; font-size:20px; color:#ffffff;'>";
			myWindow.document.write(p);
			myWindow.document.close();


		}

		function anularTicket2(){
			document.getElementById("showNumeros").style.display="none";
			document.getElementById("contenAnular").style.display="block";
			document.getElementById("anular").focus();
		}
		function pagarTicket(){
			document.getElementById("showNumeros").style.display="none";
			document.getElementById("contenPagar").style.display="block";
			document.getElementById("pagar").focus();
		}
		function listaTicket(){
			document.getElementById("showNumeros").style.display="none";
			document.getElementById("contenLista").style.display="block";
		}
		function manual(){
			document.getElementById("showNumeros").style.display="block";
			document.getElementById("contenLista").style.display="none";
			document.getElementById("contenAnular").style.display="none";
			document.getElementById("contenPagar").style.display="none";
		}
	</script> 
</head>
<body onload="document.getElementById('text').focus();">
	<div id="wrapper">
		<div id="menu">
			<ul>
			<li class="current_page_item"><a href="inicio.php">Inicio</a></li>
			<li><a href="inicioG.php">Granja</a></li>
			<li><a href="tickets.php">Tickets</a></li>
			<li><a href="resultados.php">Resultados</a></li>
			<li><a href="ganadores.php">Ganadores</a></li>
			<li><a href="reportes.php">Reportes</a></li>
			<li style="float: right;"><a><?php echo date("h:i")." ".date("d/m"); ?></a></li>
			<li style="float: right;"><a><?php echo $_SESSION["usuario"];?></a></li>
		
			</ul>
		</div>
		<div id="show">
			<div id="contenTickets">
				<input type="text" id="text" placeholder="Numero" style="width: 60px;" maxlength="2" onkeypress="monto()" />
				<input type="text" id="text2" placeholder="Monto" style="width: 60px;" maxlength="4" onkeypress="cargarManual()" />
				<form method="GET" name="formulario"  action="">
					<input type="text" id="idRep" placeholder="Serial" name="idRep" value="" />
					<input type="submit" id="submit" name ="boton" onclick="" value="Repetir" />
				</form>
				<form method="GET" name="ticketForm"  action="">
					<table style="margin-top: 3px">
						<tr>
							<td><input type="text" id="nombre" name ="nombre" placeholder="Nombre" value="<?php echo $nombre;?>" id="nombre"></td>
						</tr>
						<tr>
							<td><input type="text" id="text" name ="total" placeholder="Total" value="<?php if($total>0){echo $total;}?>" id="totalTicket"></td>
							<td><input type="submit" id="submitT" name ="boton" onclick="imprimir('<?php echo $_SESSION["id"]+1?>')" value="Aceptar" /></td>
						</tr>
					</table>
					<hr color=blue>
					<div style="overflow: scroll;height: 545px;">
						<table id="showNum"  border=0 name="tabla">
							<tr>
								<th>Loto</th>
								<th>Num.</th>
								<th>Animal</th>
								<th>Bs.</th>
								<th><img src="eliminar.png" border="0" width="20" height="20"></th>
							</tr>
							<?php 
								if(isset($_GET["boton"])){
									if($_GET["boton"]=="Aceptar"){
										$estado=0;
										$i=0;
										$j=0;
										if(isset($_GET["total"])){
											if($min!=59){
												$arrayM = $_GET["montos"];
												$arrayL = $_GET["sorteos"];
												$arrayA = $_GET["numeros"];
												$nombre = $_GET["nombre"];
												$total = $_GET["total"];
												$ram=rand(1, 37);
												$serial= ($_SESSION["id"]*547);
												if($total>500){
													$sql = "INSERT INTO tickets (serialT,fecha, caja, hora, estado, total,nombre) VALUES ('$serial','$fecha', '$caja', '$horaT', '$estado', '$total', '$nombre')";
													if ($conn->query($sql) === TRUE) {
														$id = mysqli_insert_id($conn);
														echo "<script> id=".($id)."</script>";
														$_SESSION["id"]=$id;
														
														foreach($arrayA as $animal){
															$sql1 = "INSERT INTO numeros (id_t,fecha,hora,monto,numero,sorteo) VALUES ('$id','$fecha','$horaT','$arrayM[$i]','$animal','$arrayL[$i]')";
															if ($conn->query($sql1) === FALSE) {
																echo "ErrorAlcides: " . $sql1 . "<br>" . $conn->error;
															}else{
			                  									header("Location:inicio.php");
															}
															$i++;
														}
														#echo "<script> alert(".($id).")</script>";
														#echo "<script>alert('Registrado')</script>";
													} else {
														echo "Error: " . $sql . "<br>" . $conn->error;
													}
												}else{
													echo "<script> alert ('Monto no permitido, jugada minima 500bs.')</script>";
												}
											}else{
												echo "<script> alert ('Loteria Cerrada..!!')</script>";
											}
										}else{
											echo "<script> alert ('No ha seleccionado nada')</script>";
										}
									}else{
										if($_GET["boton"]=="Repetir"){
											$i=0;
											if($_GET["idRep"]!=""){
												$rep = $_GET["idRep"];									
												$db = mysqli_connect('localhost','root','','loteria');
												$sql1="SELECT nombre FROM tickets WHERE id='$rep'";
												$rs = mysqli_query($db,$sql1);
												$row=mysqli_fetch_array($rs);
												$nombre = $row[0];
												echo "<script>document.getElementsByName('nombre')[0].value='".$nombre."';</script>";
												$sql="SELECT * FROM numeros WHERE id_t='$rep' ORDER BY numero";
												$result = mysqli_query($db,$sql);
												if(!$result){
													echo "<b>Errorrr de busqueda</b>"; 
													exit;          
												}else{
													$j=1;
													if($hora==12){
															$sorteo="1pm";
														}else{
															if(($hora>=1)and($hora<=3)){
																$sorteo="4pm";
															}else{
																if($hora<=7){
																	$sorteo=($hora+1)."pm";
																}else{
																	if($hora==10){
																		$sorteo="11am";
																	}else{
																		if($hora<=10){
																			$sorteo="10am";
																		}else{
																			$sorteo="12m";
																		}
																	}
																}
															}
														}
													while ($raw=mysqli_fetch_array($result))
													{
														echo"<tr>
														<td><input id='ticketF' name ='sorteos[]'style='margin:0px;width:40px;' value=".$sorteo." type='text' readonly></td>
														<td><input id='ticketF' name ='numeros[]'style='margin:0px;width:30px;' value=".$raw[4]." type='text'readonly></td>
														<td><input id='ticketF' name =''style='margin:0px;width:50px;' value=".$animales[$raw[4]]." type='text'readonly></td>
														<td><input id='ticketF' name ='montos[]' style='margin:0px;width:30px;' value=".$raw[3]." type='text'></td>
														<td><button type='button' id='eliminar' onclick='quitar(".$j.",".$raw[3].",".$raw[4].")'>".$j."</button></td>";
														if($raw[4]==37){
															echo "<script>txt.push('0 x ".$raw[3]."')</script>";
														}else{
															if($raw[4]==38){
																echo "<script>txt.push('00 x ".$raw[3]."')</script>";
															}else{
																echo "<script>txt.push('".$raw[4]." x ".$raw[3]."')</script>";
															}

														}
														$i++;
														$j++;
														$total += $raw[3];
													}
													echo "<script>total=".$total.";</script>";
													echo "<script>document.getElementsByName('total')[0].value='".$total."';</script>";
													echo "<script>idR=".$j.";</script>";
													echo "<script>document.getElementById('showNum').style.display='block';</script>";
												}
											}else{
												$ram=rand(1, 37);
												echo "<image type=image src='./imagenes/".$ram.".png' width='200' height='200'></td>";
												/*echo "<script>alert('Ingrese serial')</script>";*/
											}
										}
									}
								}
							?>
						</table>
					</div>
				</form>
			</div>
			<div id="contenNumeros">
				<table border = 0 style="float:left;">
					<?php
					$numeros = new SplFixedArray(39);
					$fechas = new SplFixedArray(39);
					$sorteo=sorteoActual();
					$sql="SELECT * FROM numeros WHERE fecha='$fecha' AND sorteo='$sorteo' ORDER BY numero";
					$sql="SELECT * FROM resultados WHERE id>104 ORDER BY id";
					$result = mysqli_query($conn,$sql);
					$j=0;
					$totalR=0;

					while ($raw=mysqli_fetch_array($result)){
						$a = $raw[3];
						$totalR++;
						while ($j <= 39) {
							if($j==$a){
								$numeros[$j]=$numeros[$j]+1;
								$fechas[$j]=$raw[1];
								$j+=1;
							}else{
								$j+=1;
							}
						}
						$j=0;
					}
					$i=1;
					foreach($animales as $x){
							if($i <= 30){
								echo"<tr style='font-size:18px;'>
									<td id='cuadroNumeros'>".$numeros[$i+0]."<image id='img' name='carnero' type=image src='./imagenes/".($i+0).".png' onclick='cargarE($i+0)'>".$fechas[$i+0]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+1]."<image id='img'  type=image src='./imagenes/".($i+1).".png' onclick='cargarE($i+1)'>".$fechas[$i+1]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+2]."<image id='img'  type=image src='./imagenes/".($i+2).".png' onclick='cargarE($i+2)'>".$fechas[$i+2]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+3]."<image id='img'  type=image src='./imagenes/".($i+3).".png' onclick='cargarE($i+3)'>".$fechas[$i+3]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+4]."<image id='img'  type=image src='./imagenes/".($i+4).".png' onclick='cargarE($i+4)'>".$fechas[$i+4]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+5]."<image id='img'  type=image src='./imagenes/".($i+5).".png' onclick='cargarE($i+5)'>".$fechas[$i+5]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+6]."<image id='img'  type=image src='./imagenes/".($i+6).".png' onclick='cargarE($i+6)'>".$fechas[$i+6]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+7]."<image id='img'  type=image src='./imagenes/".($i+7).".png' onclick='cargarE($i+7)'>".$fechas[$i+7]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+8]."<image id='img'  type=image src='./imagenes/".($i+8).".png' onclick='cargarE($i+8)'>".$fechas[$i+8]."</td>
									<td id='cuadroNumeros'>".$numeros[$i+9]."<image id='img'  type=image src='./imagenes/".($i+9).".png' onclick='cargarE($i+9)'>".$fechas[$i+9]."</td>";
								$i+=10;
							}
					}
					echo"<tr style='font-size:18px;'>
							<td id='cuadroNumeros'>".$numeros[31]."<image id='img'  type=image src='./imagenes/31.png' onclick='cargarE(31)'>".$fechas[31]."</td>
							<td id='cuadroNumeros'>".$numeros[32]."<image id='img'  type=image src='./imagenes/32.png' onclick='cargarE(32)'>".$fechas[32]."</td>
							<td id='cuadroNumeros'>".$numeros[33]."<image id='img'  type=image src='./imagenes/33.png' onclick='cargarE(33)'>".$fechas[33]."</td>
							<td id='cuadroNumeros'>".$numeros[34]."<image id='img'  type=image src='./imagenes/34.png' onclick='cargarE(34)'>".$fechas[34]."</td>
							<td id='cuadroNumeros'>".$numeros[35]."<image id='img'  type=image src='./imagenes/35.png' onclick='cargarE(35)'>".$fechas[35]."</td>
							<td id='cuadroNumeros'>".$numeros[36]."<image id='img'  type=image src='./imagenes/36.png' onclick='cargarE(36)'>".$fechas[36]."</td>
							<td id='cuadroNumeros'>".$numeros[37]."<image id='img'  type=image src='./imagenes/37.png' onclick='cargarE(37)'>".$fechas[37]."</td>
							<td id='cuadroNumeros'>".$numeros[38]."<image id='img'  type=image src='./imagenes/38.png' onclick='cargarE(37)'>".$fechas[38]."</td>
							<td id='cuadroNumeros'><image id='img'  type=image src='./imagenes/1.png' onclick='cargarE(38)'>".$totalR."</td>";
					?>
				</table>
			</div>
			<div id="contenResultados">
				<table border = 0 id = "showTable">
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
								if($i<4){
									echo "<td><image type=image src='./imagenes/".$raw[3].".png' width='61' height='61'></td></td>";
								}else{
									if($i==4){
										echo "</tr>";
									}
									if($i<8){
										echo "<td><image type=image src='./imagenes/".$raw[3].".png' width='61' height='61'></td></td>";
									}
								}
								$i++;
							}
						}
					?>
				</table>				
			</div>
			<div id="contenResultados" style="height: 200px;display: block">
				<h5>- Anota los tickets malos</h5>
				<h5>- Escribe los nombre bien</h5>
				<a href="https://time.is/Venezuela" id="time_is_link" rel="nofollow" style="font-size:12px"></a>
				<span id="Venezuela_z120" style="font: normal 18px Arial, 'Arial', Times, serif;	"></span>
				<script src="//widget.time.is/t.js"></script>
				<script>time_is_widget.init({Venezuela_z120:{time_format:"12hours:minutes:secondsAMPM"}});</script>


			</div>
			<div id="contenAnular">
				<div id="search"  style="width: 200px;height: 25px;">
					<form method="GET" name="formulario"  action="">
						<table border="0">
							<tr>
								<td>
									Anular ticket
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="anular" placeholder="Ticket" name="idAnular" onkeypress="monto()" value="" />
								</td>
								<td>
									<input type="submit" id="submit" name ="boton" onclick="alert('Seguro que desea anular')" value="Anular" />
								</td>
							</tr>
						</table>
					</form>
				</div>		
			</div>
			<div id="contenPagar">
				<form method="GET" name="formulario"  action="">
					<table border="0">
						<tr>
							<th>
								Pagar ticket
							</th>
						</tr>
						<tr>
							<td>
								<input type="text" id="ticketF" style="background: 171717" placeholder="Serial" onkeypress="monto()" name="idAnular" value="" />
							</td>
							<td>
								<input type="submit" id="submit" name ="boton" onclick="alert('Seguro que desea anular')" value="Anular" />
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id="contenLista">
				<div id="search"  style="width: 200px;height: 25px;">
					<form method="GET" name="formulario"  action="">
						<table border="0">
							<tr>
								<td>
									Id
								</td>
								<td>
									Hora
								</td>
								<td>
									Estado
								</td>
								<td>
									Total
								</td>
							</tr>
							<?php
								$db = mysqli_connect('localhost','root','','loteria');
								$sql="SELECT * FROM tickets WHERE fecha='$fecha' ORDER BY id DESC";
								$result = mysqli_query($db,$sql);
								if($result){
									while ($raw=mysqli_fetch_array($result))
									{
										echo "<tr style='background:#C0BCBC'>
										<td>".$raw[0]."</td>
										<td>".$raw[3]."</td>
										<td>".$raw[5]."</td>
										<td>".$raw[7]."</td>
										</tr>";
									}
								}
							?>
						</table>
					</form>
				</div>		
			</div>
		</div>
	</div>
	<div id="footer">
		<p style="color: #fff">almagency</p>
	</div>
</body>
</html>




					