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
				$sql = "INSERT INTO tickets (serialT,fecha, caja, hora, estado, total,nombre) VALUES ('500','$fecha', '$caja', '$horaT', '$estado', '$total', '$nombre')";
				if ($conn->query($sql) === TRUE) {
					$sql1="SELECT MAX(id) FROM tickets";
					$rs = mysqli_query($conn,$sql1);
					$row=mysqli_fetch($rs);
					$id = $row;
					echo $id;
					echo "<script>id=".($id).";</script>";
					foreach($arrayA as $animal){
						$sql1 = "INSERT INTO numeros (id_t,fecha,hora,monto,numero,sorteo) VALUES ('$id','$fecha','$horaT','$arrayM[$i]','$animal','$arrayL[$i]')";
						if ($conn->query($sql1) === FALSE) {
							echo "ErrorAlcides: " . $sql1 . "<br>" . $conn->error;
						}
						$i++;
					}
					echo "<script>alert('Registrado')</script>";

				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
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
				$sql1="SELECT nombre FROM tickets WHERE numero='$rep'";
				$rs = mysqli_query($conn,$sql1);
				$row=mysqli_fetch($resultado);
				$nombre = $row[0];
				echo "<script>document.getElementsByName('nombre')[0].value='".$nombre."';</script>";
				$sql="SELECT * FROM numeros WHERE id_tickets='$rep' ORDER BY animal";
				$result = mysqli_query($db,$sql);
				if(!$result){
					echo "<b>Error de busqueda</b>"; 
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
						<td><input id='ticketF' name ='numeros[]'style='margin:0px;width:30px;' value=".$raw[2]." type='text'readonly></td>
						<td><input id='ticketF' name =''style='margin:0px;width:50px;' value=".$animales[$raw[2]]." type='text'readonly></td>
						<td><input id='ticketF' name ='montos[]' style='margin:0px;width:30px;' value=".$raw[3]." type='text'></td>
						<td><button type='button' id='eliminar' onclick='quitar(".$j.",".$raw[3].",".$raw[2].")'>".$j."</button></td>";
						echo "<script>txt.push('".$raw[2]." x ".$raw[3]."')</script>";
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
				echo "<image type=image src='".$ram.".png' width='200' height='200'></td>";
				/*echo "<script>alert('Ingrese serial')</script>";*/
			}
		}
	}
}
?>


