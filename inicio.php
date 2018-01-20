<!DOCTYPE html>
<html lang="en">
<head>
	<title>AlmagencyMR.</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.css">
	<?php

		$animales = array(1 => "carnero",2 => "toro",3 => "ciempies",4 => "alacran",5 => "leon",6 => "rana",7 => "perico",8 => "raton",9 => "aguila",10 => "tigre",11 => "gato",12 => "caballo",13 => "mono",14 => "paloma",15 => "zorro",16 => "oso",17 => "pavo",18 => "burro",19 => "chivo",20 => "cochino",21 => "gallo",22 => "camello",23 => "zebra",24 => "iguana",25 => "gallina",26 => "vaca",27 => "perro",28 => "zamuro",29 => "elefante",30 => "caiman",31 => "lapa",32 => "ardilla",33 => "pescado",34 => "venado",35 => "jirafa",36 => "culebra",37 => "delfin",38=> "ballena");
		session_start();
		$conn = new mysqli("localhost", "root", "", "loteria");
		$fecha="18/01/02";
		$fecha=date("y/m/d");
		$horaT=date("h:i:s");
		$hr=date("h");
		$min=date("i");
		$hora =8;
		$hora =date("h");
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
	      $hora =11;
	      $hora =date("h");
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
		function alertP($string) {
			echo "<script>alert('".$string."')</script>";
		}
		function recargar($mensaje) {
			if($mensaje!=""){
				echo "<script>alert('".$mensaje."')</script>";
			}
			echo "<script>window.location='inicio.php'</script>";
		}
	?>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
		document.write('<link href="styleBlue.css" rel="stylesheet" type="text/css" media="screen" />');
		function mostrarTabla() {		
			document.getElementById("divNum").style.display="block"
			document.getElementById("showNum").style.display="block"
		}
		function cargarE($animal) {
			c=$animal+'a';
			maxA=parseInt(document.getElementById(c).value);
			var t=0;
			var bs=0;
			var loteria="";
			var min="<?php echo date('i');?>";
			var sorteoA="<?php echo sorteoActual();?>";
			if(bsM!=0){
				bs=bsM
			}else{
				for (var i = 0; i < document.montos.length; i++) {
					if ((document.montos[i].checked==1) ) {
						bsM=parseInt(document.montos[i].value)
					}
				}
			}
			mostrarTabla()
			e=0;
			for (var i = 0; i < document.loterias.length; i++) {
				if (document.loterias[i].checked==1){
					if(document.loterias[i].value==sorteoA){
						if((maxA+bsM)>10000){
							disponible=bsM-	((maxA+bsM)-10000)
							if(disponible>0){
								alert("Numero agotado, Disponibl	e "+disponible);
								bs=disponible;
								bsM=disponible;
							}else{
								alert("Numero agotado.");
								bs=0;
								bsM=0;
							}
						}
					}else{
						bsM=parseInt(document.getElementById("text2").value)
					}
					if(min<55){
						var animal=$animal
						var sorteo =  "<td><input id='ticketF' name ='sorteos[]' value="+document.loterias[i].value+" type='text'></td>"
						var numero =  "<td><input id='ticketF' name ='numeros[]' value="+animal+" type='text' style='width:25px;'></td>"
						var nombre =  "<td><input id='ticketF' value="+animales[$animal-1]+" type='text' style='width:60%;'></td>"
						var monto =   "<td><input id='ticketF' name ='montos[]'value="+bs+" type='text' style='width:40%;'></td>"
						var eliminar ="<td><button id='eliminar' type='button' onclick='quitar("+idR+","+parseInt(bs)+","+$animal+")'>"+idR+"</button></td>"
						var fila=sorteo+numero+nombre+monto+eliminar;
						idR+=1;
						total=total+parseInt(bs);
						var btn = document.createElement("TR");
						btn.innerHTML=fila;
						document.getElementById("showNum").insertBefore(btn,document.getElementById("showNum")[2]);  
						document.getElementsByName("total")[0].value=total;
						document.getElementById(c).value=maxA+bsM;
						document.getElementById(c).style.background="#76FF03"
						document.getElementById(c).style.color="#000"
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
					}else{
						if(document.loterias[i].value!=sorteoA){
							document.getElementById("showNum").style.display="block"
							var animal=$animal
							var sorteo =  "<td><input id='ticketF' name ='sorteos[]' value="+document.loterias[i].value+" type='text'></td>"
							var numero =  "<td><input id='ticketF' name ='numeros[]' value="+animal+" type='text' style='width:25px;'></td>"
							var nombre =  "<td><input id='ticketF' value="+animales[$animal-1]+" type='text' style='width:55px;'></td>"
							var monto =   "<td><input id='ticketF' name ='montos[]'value="+bs+" type='text' style='width:40px;'></td>"
							var eliminar ="<td><button id='eliminar' type='button' onclick='quitar("+idR+","+parseInt(bs)+","+$animal+")'>"+idR+"</button></td>"
							var fila=sorteo+numero+nombre+monto+eliminar;
							idR+=1;
							total=total+parseInt(bs);
							var btn = document.createElement("TR");
							btn.innerHTML=fila;
							document.getElementById("showNum").appendChild(btn);
							document.getElementsByName("total")[0].value=total;
							if(document.loterias[i]==sorteoA){
								document.getElementById(c).value=maxA+bsM;
								document.getElementById(c).style.background="#76FF03"
								document.getElementById(c).style.color="#000"
							}
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
						}else{
							alert("loteria Cerrada ");
							document.loterias[0].checked=0;
							document.loterias[1].checked=1;
						}
					}
				}
			}
			document.getElementById('text').focus();
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
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 2:
					document.getElementById("listaSorteos").deleteRow(0);
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
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
				break;
				case 8:
					document.loterias.elements[0].checked=1	
				break;
				case 9:
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 10:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 11:
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.getElementById("listaSorteos").deleteRow(0);
					document.loterias.elements[0].checked=1	
				break;
				case 12:
					document.getElementById("listaSorteos").deleteRow(0);
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
		function imprimir(idA) {
			if(document.getElementsByName("total")[0].value>499){
				texto="";
				for (var i = 0; i < document.loterias.length; i++) {
					if(document.loterias[i].checked==1){
						sorteo.push(document.loterias[i].value)
					}
				}
				var myWindow = window.open("", "Ticket", "width=180,height=300");
				p="<p style='margin: 0;text-align:left; font-size:10px; text-transform:capitalize;'>";
				u="<p style='margin: 0;text-align:left; font-size:10px; text-transform:capitalize;'>";
				s=p+"AlmagencyMR. "+"<?php echo $horaT;?>";
				s+=p+"Ticket: "+(idA)+" - Serial: "+(idA*547);
				s+=p+"--------------------------------";
				s+=p+"Sorteo: lottoActivo "+sorteo[1];
				e=0;
				for (var i = 0; i <= txt.length-1; i++) {
					if(e==0){
						if(txt[i]!=""){
							texto+=p+txt[i];
							if(txt[i+1]!=""){
								texto+=" --- ";
							}
						}
						e++;
					}else{
						texto+=txt[i]+"</p>";
						e=0;
					}
				}
				s+=p+texto;
				s+=p+"--------------------------------";
				s+=p+"total bs: "+document.getElementsByName("total")[0].value;
				s+=p+"Revisar ticket. Valido (3) dias.";
				s+=p+".";
				s+=p+".";
				s+=p+".";
				s+=p+".";
				myWindow.document.write(s);
				myWindow.document.close();
				var i=1;
				if(i==1){
					myWindow.print();
					myWindow.close();
				}
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
				if((k==186) || (k==124)){
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
										}else{
											if(k==105){
												document.getElementById('inicio').focus();
											}else{
												if(k==116){
													document.getElementById('tickets').focus();
												}else{
													if(k==82){
														document.getElementById('resultados').focus();
													}else{
														if(k==103){
															document.getElementById('ganadores	').focus();
														}
													}
												}
											}
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
				if(document.getElementById("text2").value!="" && parseInt(document.getElementById("text2").value)>=100 && parseInt(document.getElementById("text2").value)<=10000){
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
					alert("Monto invalido 100bs-10000bs")
					document.getElementById("text2").value="";
					document.getElementById('text2').focus();
				}
			}
		}
		function anularTicket(){	
			document.getElementById("contenAnular").style.display="block";
			document.getElementById("anular").focus();
		}
		function pagarTicket(){
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
		function mostrarR(){
			if(document.getElementById("ruleta").style.display=="block"){
				document.getElementById("ruleta").style.display="none";
			}else{
				document.getElementById("ruleta").style.display="block";
			}
		}
	</script>  	
</head>
<body onload="document.getElementById('text').focus();">
	<div class="container-fixed">
		<div class="row" id="menu">
			<div class="col-sm-12 col--12">
				<nav class="navbar navbar-expand-sm bg-primary navbar-light">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">AlmagencyMR.</a>
					</div>
					<button class="navbar-toggler btn-sm" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="collapsibleNavbar">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link btn-sm active" id ="inicio" href="inicio.php" data-toggle="tooltip" title="Inicio(i)">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm" id ="tickets"  href="tickets.php" data-toggle="tooltip" title="Tickets(t)">Tickets</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm" id ="resultados"  href="resultados.php" data-toggle="tooltip" title="Resultados(r)">Resultados</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm" id ="ganadores"  href="ganadores.php" data-toggle="tooltip" title="Ganadores(g)">Ganadores</a>
							</li>
							<li class="nav-item">
								<a class="nav-link btn-sm" id ="reportes"  href="reportes.php" data-toggle="tooltip" title="Reportes(R)">Reportes</a>
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
			<div class="col-sm-2" id="contenNumeros">
				<form  name="loterias" method="GET" action="">
					<table border = 0 class="table-striped" id = "listaSorteos">
						<?php   
							$sql="SELECT * FROM sorteos";
							$result = mysqli_query($conn,$sql);
							while ($raw=mysqli_fetch_array($result))
							{
								echo "
									<tr>
										<td><input type='checkbox' name ='loto[]'' value='".$raw[1]."' id='".$raw[0]."'><label id ='".$raw[1]."' for ='".$raw[0]."'>".$raw[1]." - LottActivo</label></td>
									</tr>";                   
							}
						?>
					</table>	
				</form>	
			</div>
			<div class="col-sm-1" id="contenNumeros">
				<form  name="montos" method="GET" action="">
					<table border =  0 class="table-striped" id="listaMontos">
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(0)" checked="1" value="100" id="100"><label for ="100">100</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(1)" value="200" id="200"><label for ="200">200</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(2)" value="300" id="300"><label for ="300">300</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(3)" value="400" id="400"><label for ="400">400</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(4)" value="500" id="500"><label for ="500">500</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(5)" value="600" id="600"><label for ="600">600</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(6)" value="700" id="700"><label for ="700">700</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(7)" value="800" id="800"><label for ="800">800</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(8)" value="900" id="900"><label for ="900">900</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name ="monto[]" onclick="seleccionar_todo(9)" value="1000" id="1000"><label for ="1000">1000</label></td>
						</tr>
						<?php
							echo "<script>ocultar_loto(".$hora.")</script>";
						?>
					</table>
				</form>
			</div>
			<div class="col-sm-6" id="contenNumeros">
				<table border = 0 class="table-striped">
					<?php
						$numeros = new SplFixedArray(39);
						$ttl=0;
						if(!isset($_GET["resultados"])){
							$sorteo=sorteoActual();
							$sql="SELECT * FROM numeros WHERE fecha='$fecha' AND sorteo='$sorteo' ORDER BY numero";
							$result = mysqli_query($conn,$sql);
							$j=0;
							while ($raw=mysqli_fetch_array($result)){
								$animal = $raw[4];
								while ($j <= 39) {
									if($j==$animal){
										$numeros[$j]=$numeros[$j]+$raw[3];
										$j+=1;
									}else{
										$j+=1;
									}
								}
								$j=0;
							}
						}else{
							$sql="SELECT * FROM resultados";
							$result = mysqli_query($conn,$sql);
							$j=0;
							while ($raw=mysqli_fetch_array($result)){
								$animal = $raw[3];
								while ($j <= 39) {
									if($j==$animal){
										$numeros[$j]=$numeros[$j]+1;
										$j+=1;
									}else{
										$j+=1;
									}
								}
								$j=0;
							}
						}
						$i=1;
						while ($j <= 38) {
							$ttl+=$numeros[$j];
							if ($numeros[$j]==""){
								$numeros[$j]=0;
							}
							$j+=1;
						}
						$j=0;
						foreach($animales as $x){
								if($i <= 30){
									echo"<tr>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+0).".png' onclick='cargarE($i+0)'>
											<input id='".($i+0)."a' value=".$numeros[$i+0]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+1).".png' onclick='cargarE($i+1)'>
											<input id='".($i+1)."a' value=".$numeros[$i+1]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+2).".png' onclick='cargarE($i+2)'>
											<input id='".($i+2)."a' value=".$numeros[$i+2]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+3).".png' onclick='cargarE($i+3)'>
											<input id='".($i+3)."a' value=".$numeros[$i+3]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+4).".png' onclick='cargarE($i+4)'>
											<input id='".($i+4)."a' value=".$numeros[$i+4]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+5).".png' onclick='cargarE($i+5)'>
											<input id='".($i+5)."a' value=".$numeros[$i+5]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+6).".png' onclick='cargarE($i+6)'>
											<input id='".($i+6)."a' value=".$numeros[$i+6]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+7).".png' onclick='cargarE($i+7)'>
											<input id='".($i+7)."a' value=".$numeros[$i+7]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+8).".png' onclick='cargarE($i+8)'>
											<input id='".($i+8)."a' value=".$numeros[$i+8]." type='text' readonly>
										</td>
										<td id='cNum'>
											<image id='img'  type=image src='./imagenes/".($i+9).".png' onclick='cargarE($i+9)'>
											<input id='".($i+9)."a' value=".$numeros[$i+9]." type='text' readonly>
										</td>";
									$i+=10;
								}
						}
						echo"<tr style='font-size:18px;'>

							<td id='cNum'>
								<image id='img'  type=image src='./imagenes/31.png' onclick='cargarE(31)'>
								<input id='31a' value=".$numeros[31]." type='text' readonly>

							</td>
							<td id='cNum'>
								<image id='img'  type=image src='./imagenes/32.png' onclick='cargarE(32)'>
								<input id='32a' value=".$numeros[32]." type='text' readonly>

							</td>
							<td id='cNum'>
								<image id='img'  type=image src='./imagenes/33.png' onclick='cargarE(33)'>
								<input id='33a' value=".$numeros[33]." type='text' readonly>

							</td>
							<td id='cNum'>
								<image id='img'  type=image src='./imagenes/34.png' onclick='cargarE(34)'>
								<input id='34a' value=".$numeros[34]." type='text' readonly>

							</td>
							<td id='cNum'>
								<image id='img'  type=image src='./imagenes/35.png' onclick='cargarE(35)'>
								<input id='35a' value=".$numeros[35]." type='text' readonly>

							</td>
							<td id='cNum'>
								<image id='img'  type=image src='./imagenes/36.png' onclick='cargarE(36)'>
								<input id='36a' value=".$numeros[36]." type='text' readonly>

							</td>
							<td id='cNum'>
								<image id='img'  type=image src='./imagenes/37.png' onclick='cargarE(37)'>
								<input id='37a' value=".$numeros[37]." type='text' readonly>

							</td>
							<td id='cNum'>
								<image id='img'  type=image src='./imagenes/38.png' onclick='cargarE(38)'>
								<input id='38a' value=".$numeros[38]." type='text' readonly>

							</td>
							<td id='cNum'>
								<input id='38a' value=".$ttl." type='text' readonly>

							</td>";
					?>
				</table>
			</div>
			<div class="col-sm-3" id="contenNumeros" style="height: 550px;">
				<table>
					<tr>
						<td>
							<input type="text" id="text" placeholder="Numero" style="width: 60px;" maxlength="2" onkeypress="monto()" />
						</td>
						<td>
							<input type="text" id="text2" placeholder="Monto" style="width: 60px;" maxlength="5" onkeypress="cargarManual()" />
						</td>
					</tr>
				</table>
				<form method="GET" name="formulario"  action="">
					<table>
						<tr>
							<td>
								<input type="text" id="idRep" placeholder="Serial" name="idRep" value="" />
							</td>
							<td>
								<input type="submit" id="submit" name ="boton" onclick="" value="Repetir" />
							</td>
						</tr>
					</table>
				</form>
				<form method="GET" name="ticketForm"  action="">
					<table>
						<tr>
							<td><input type="text" id="nombre" name ="nombre" placeholder="Nombre" value="<?php echo $nombre;?>" id="nombre"></td>
						</tr>
						<tr>
							<td><input type="text" id="text" name ="total" placeholder="Total" value="<?php if($total>0){echo $total;}?>" id="totalTicket"></td>
							<td><input type="submit" id="submitT" name ="boton" onclick="imprimir('<?php echo $_SESSION["id"]+1?>')" value="Aceptar" /></td>
						</tr>
					</table>
					<div  id="divNum">
						<table id="showNum"  border=0 name="tabla">
							<tr id='showP'>
								<td>Loto</td>
								<td>Nº</td>
								<td>Animal</td>
								<td>Bs.</td>
								<td><img src="./imagenes/eliminar.png" border="0" width="20" height="20"></td>
							</tr>
							<?php 
								if(isset($_GET["boton"])){
									if($_GET["boton"]=="Aceptar"){
										$estado=0;
										$i=0;
										$j=0;
										if(isset($_GET["total"])){
											$arrayM = $_GET["montos"];
											$arrayL = $_GET["sorteos"];
											$arrayA = $_GET["numeros"];
											$nombre = $_GET["nombre"];
											$total = $_GET["total"];
											$ram=rand(1, 37);
											$serial= (($_SESSION["id"]+1)*547);
											if($total>499){
												$sql = "INSERT INTO tickets (serialT,fecha, caja, hora, estado, total,nombre) VALUES ('$serial','$fecha', '$caja', '$horaT', '$estado', '$total', '$nombre')";
												if ($conn->query($sql) === TRUE) {
													$id = mysqli_insert_id($conn);
													echo "<script> id=".($id)."</script>";
													$_SESSION["id"]=$id;
													foreach($arrayA as $animal){
														$sql1 = "INSERT INTO numeros (id_t,fecha,hora,monto,numero,sorteo) VALUES ('$id','$fecha','$horaT','$arrayM[$i]','$animal','$arrayL[$i]')";
														if ($conn->query($sql1) === FALSE) {
															echo "ErrorAlcides: " . $sql1 . "<br>" . $conn->error;
														}
														$i++;
													}
													recargar("");
												} else {
													recargar("Error: " . $sql. $conn->error);
												}
											}else{
												alertP('Monto no permitido, jugada minima 500bs.');
											}
										}else{
											alertP('No ha seleccionado nada');
										}
									}else{
										if($_GET["boton"]=="Repetir"){
											echo "<script>mostrarTabla()</script>";
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
												if($result){
													$j=1;
													$sorteo="1pm";
													$sorteo=sorteoActual();
													while ($raw=mysqli_fetch_array($result))
													{
														echo"<tr>
														<td><input id='ticketF' name ='sorteos[]'value=".$sorteo." type='text' readonly></td>
														<td><input id='ticketF' name ='numeros[]'style='margin:0px;width:25px;' value=".$raw[4]." type='text'readonly></td>
														<td><input id='ticketF' name =''style='margin:0px;width:55px;' value=".$animales[$raw[4]]." type='text'readonly></td>
														<td><input id='ticketF' name ='montos[]' style='margin:0px;width:40px;' value=".$raw[3]." type='text'></td>
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
		</div>
		<div class="row" id="show">	
			<div class="col-sm-3" id="contenResultados">
				<table class="table-striped" id="tablaResultados">
					<?php
						$conn = new mysqli("localhost", "root", "", "loteria");
						$sql="SELECT * FROM resultados WHERE fecha='$fecha'";
						$result = mysqli_query($conn,$sql);
						if($result){
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
			<div class="col-sm-2"  id="contenAnular">
						<table border="0" id="tablaAnularPagar">
							<tr id="showN">
								<td>
									Anular ticket
								</td>
							</tr>
					<form method="GET" name="formulario"  action="">
							<tr>
								<td>
									<input type="text" id="anular" placeholder="Ticket" name="idAnular" onkeypress="this" value="" />
								</td>
							</tr>
					</form>
					<form method="GET" name="formulario"  action="">
							<tr>
								<td>
									<input type="text" id="" placeholder="Fecha" name="fechaAnular" value="" />
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="" placeholder="Hora" name="horaAnular" value="" />
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="" placeholder="Total" name="totalAnular" value="" />
								</td>
							</tr>
							<?php 

								if(isset($_GET["idAnular"])){
									$x=$_GET["idAnular"];
									$sql="SELECT * FROM tickets WHERE id='$x'";
									$result = mysqli_query($conn,$sql);
									$raw=mysqli_fetch_array($result);
									$fechaN=date("Y-m-d");
									if($fechaN!=$raw[2]){
										alertP("No se puede anular un ticket que no es de hoy. ".$raw[2]);
									}else{
										$hora1 = strtotime($raw[3]);
										$hora2 = strtotime(date("h:i:s"));
										if(($hora2-$hora1)>300) {
											alertP("Despues de 5 min no se puede anular un ticket.");
										} else {
											echo "<script>document.getElementsByName('idAnular')[0].value='".$x."';</script>";
											echo "<script>document.getElementsByName('fechaAnular')[0].value='".$raw[2]."';</script>";
											echo "<script>document.getElementsByName('horaAnular')[0].value='".$raw[3]."';</script>";
											echo "<script>document.getElementsByName('totalAnular')[0].value='".$raw[7]."';</script>";
											$sqlA="UPDATE tickets SET estado='2' WHERE id='$x'";
											if ($conn->query($sqlA) === TRUE) {
												recargar("Ticket Anulado");
											} else {
												echo "Error: " . $conn->error;
												header("Location:inicio.php");
											}
										}
									}
								}

							 ?>
						</table>
					</form>
				</div>
			<div class="col-sm-2"  id="contenPagar">
						<table border="0" id="tablaAnularPagar">
							<tr id="showN">
								<td>
									Pagar ticket
								</td>
							</tr>
					<form method="GET" name="formulario"  action="">
							<tr>
								<td>
									<input type="text" id="pagar" placeholder="Serial" name="idPagar" onkeypress="this" value="" />
								</td>
							</tr>
					</form>
					<form method="GET" name="formulario"  action="">
							<tr>
								<td>
									<input type="text" id="" placeholder="Fecha" name="fechaPagar" value="" />
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="" placeholder="Sorteo" name="sorteoPagar" value="" />
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="" placeholder="Premio" name="premioPagar" value="" />
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="" placeholder="Total" name="totalPagar" value="" />
								</td>
							</tr>
							<?php 

								if(isset($_GET["idPagar"])){
									$x=$_GET["idPagar"];
									$sql="SELECT * FROM ganadores WHERE serialT='$x'";
									$result = mysqli_query($conn,$sql);
									$raw=mysqli_fetch_array($result);
											echo "<script>document.getElementsByName('idPagar')[0].value='".$x."';</script>";
											echo "<script>document.getElementsByName('fechaPagar')[0].value='".$raw[4]."';</script>";
											echo "<script>document.getElementsByName('sorteoPagar')[0].value='".$raw[5]."';</script>";
											echo "<script>document.getElementsByName('premioPagar')[0].value='".$raw[3]."';</script>";
											echo "<script>document.getElementsByName('totalPagar')[0].value='".$raw[8]."';</script>";
											$sqlA="UPDATE tickets SET estado='$raw[3]' WHERE serialT='$x'";
											$sqlG="UPDATE ganadores SET estado='1' WHERE serialT='$x'";
											if (($conn->query($sqlA) === TRUE)and($conn->query($sqlG) === TRUE)) {
												recargar("Ticket cancelado.");
											} else {
												alertp("Error: " . $conn->error);
											}
								}

							 ?>
						</table>
					</form>
			</div>
			<div class="col-sm-5"  id="contenListaTicket" style="height: 205px;">
				<table border = 0 class="table" style="width: 99%;font-size: 10px;">
					<?php
						$db = mysqli_connect('localhost','root','','loteria');
						$sql="SELECT * FROM tickets WHERE fecha='$fecha' ORDER BY id DESC";
						if(!isset($_GET["Final"])){
							$result = mysqli_query($db,$sql);
							if($result){
								echo "<tr id ='showP'>
										<td>Numero</td>
										<td>Nombre</td>
										<td>Hora</td>
										<td>Status</td>
										<td>Total</td>
									</tr>";
								$i=1;
								while ($raw=mysqli_fetch_array($result))
								{
									if($i!=0){
										if($raw[5]==2){
											$estado="Anulado";
										}else{
											$estado=$raw[5];
										}
										echo"
										<tr id='showS'>
											<td>".$raw[0]."</td>
											<td>".$raw[6]."</td>
											<td>".$raw[3]."</td>
											<td>".$estado."</td>
											<td>".$raw[7]."</td>
										";
										$i++;
									}
								}
							}
						}
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>




					