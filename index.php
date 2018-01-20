<!DOCTYPE html>
<html lang="en">
<head>
	<title>AlmagencyMR.</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.css">
	<?php
		session_start();
		$_SESSION["usuario"]="";
		$conn = new mysqli("localhost", "root", "", "loteria");
	?>
	<link href="styleBlue.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body onload="document.getElementById('text-login').focus();">
	<div id="login">
		<form>
			<table border=0>
				<tr>
					<td>
						<h1>Iniciar sesion</h1>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="text-login" placeholder="Usuario" name="usuario">
					</td>
				</tr>
				<tr>
					<td>
						<input type="password" id="text-login" placeholder="Clave" name="clave">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" id="submit" name ="boton" onclick="this.submit" value="Ingresar">
					</td>
					<?php
						if(isset($_GET["usuario"])){
							$usuario =$_GET["usuario"];
							$clave =$_GET["clave"];
							$sql="SELECT * FROM usuarios WHERE usuario='$usuario'";
							$result = mysqli_query($conn,$sql);
							if($result){
								$_SESSION["usuario"]=$usuario;
								$_SESSION["fecha"]=date("y/m/d");
								while ($raw=mysqli_fetch_array($result)){
									if($raw[2]!=$clave){
										echo "<script>alert('Usuario o Clave correcta')</script>";
									}else{
										if($raw[2]=='1'){
											header("Location:inicio.php");
										}else{
											header("Location:inicio.php");
										}
									}

								}
							}else{
								echo "Usuario no registrado";
							}
						}
					?>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>