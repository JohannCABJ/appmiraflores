<!DOCTYPE html>
<html lang="es">
<link rel="shortcut icon" href="Favicon.png">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <div align="center"> <img src="images/logoPoiraTransparent.png" width="200" height="80" /> -->
	<header>
		<title>Confirmación elaboración protocolo de alistamiento</title>
		<!-- <script>
function nav(value) {
if (value != "") { location.href = value; }
}
</script> -->
		<style>
			input[type=text],
			select {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}

			input[type=submit] {
				width: 100%;
				background-color: #4CAF50;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			}

			input[type=submit]:hover {
				background-color: #45a049;
			}

			input[type=button] {
				width: 100%;
				background-color: #0b489e;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			}

			input[type=button]:hover {
				background-color: #00a3e5;
			}

			div {
				border-radius: 5px;
				background-color: #f2f2f2;
				padding: 20px;
			}
		</style>
	</header>
	<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	<?php
	$varrand = substr(md5(uniqid(rand())), 0, 10);
	$varallw = array("image/bmp", "image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");
	$tips = array("bmp", "gif", "jpeg", "png", "jpg");
	//$varpath = "http://app.expresomiraflores.com/tmp/";
  $varpath = "/opt/lampp/htdocs/mirafloresapp/tmp/";
	$varstat = "";


	if ($_POST["action"] == "upload") {
		if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
			$varname = $_FILES["imagen"]['name'];
			$vartemp = $_FILES['imagen']['tmp_name'];
			$vartype = $_FILES['imagen']['type'];

			if (in_array($vartype, $varallw) && $varname != "") {
				$arrname = explode(".", $varname);
				$i = strtolower(end($arrname));
				if (in_array($i, $tips)) {
					$varname = $varrand . "." . $i;
					if (copy($vartemp, $varpath . $varname)) {
						$varpath = $varpath . $varname;
						$varstat = "ok";
					} else {
						$varstat = "Error al subir el archivo";
					}
				} else {
					$varstat = "Archivo no valido";
				}
			} else {
				$varstat = "Archivo no valido";
			}
		}
	}

	?>
	<?php
	$varrand1 = substr(md5(uniqid(rand())), 0, 10);
	$varallw1 = array("image/bmp", "image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");
	$tips1 = array("bmp", "gif", "jpeg", "png", "jpg");
	//$varpath1 = "http://app.expresomiraflores.com/tmp/";
  $varpath1 = "/opt/lampp/htdocs/mirafloresapp/tmp/";
	$varstat1 = "";

	if ($_POST["action"] == "upload") {
		if (is_uploaded_file($_FILES["imagenlat"]["tmp_name"])) {
			$varname1 = $_FILES["imagenlat"]['name'];
			$vartemp1 = $_FILES['imagenlat']['tmp_name'];
			$vartype1 = $_FILES['imagenlat']['type'];

			if (in_array($vartype1, $varallw1) && $varname1 != "") {
				$arrname1 = explode(".", $varname1);
				$i1 = strtolower(end($arrname1));
				if (in_array($i1, $tips1)) {
					$varname1 = $varrand1 . "." . $i1;
					if (copy($vartemp1, $varpath1 . $varname1)) {
						$varpath1 = $varpath1 . $varname1;
						$varstat1 = "ok";
					} else {
						$varstat1 = "Error al subir el archivo";
					}
				} else {
					$varstat1 = "Archivo no valido";
				}
			} else {
				$varstat1 = "Archivo no valido";
			}
		}
	}
	?>
	<?php
	$varrand2 = substr(md5(uniqid(rand())), 0, 10);
	$varallw2 = array("image/bmp", "image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");
	$tips2 = array("bmp", "gif", "jpeg", "png", "jpg");
	$varpath2 = "/opt/lampp/htdocs/mirafloresapp/tmp/";
  //$varpath2 = "http://app.expresomiraflores.com/tmp/";
	$varstat2 = "";

	if ($_POST["action"] == "upload") {
		if (is_uploaded_file($_FILES["imagenlat"]["tmp_name"])) {
			$varname2 = $_FILES["imagenlat1"]['name'];
			$vartemp2 = $_FILES['imagenlat1']['tmp_name'];
			$vartype2 = $_FILES['imagenlat1']['type'];

			if (in_array($vartype2, $varallw2) && $varname2 != "") {
				$arrname2 = explode(".", $varname2);
				$i2 = strtolower(end($arrname2));
				if (in_array($i2, $tips2)) {
					$varname2 = $varrand2 . "." . $i2;
					if (copy($vartemp2, $varpath2 . $varname2)) {
						$varpath2 = $varpath2 . $varname2;
						$varstat2 = "ok";
					} else {
						$varstat2 = "Error al subir el archivo";
					}
				} else {
					$varstat2 = "Archivo no valido";
				}
			} else {
				$varstat2 = "Archivo no valido";
			}
		}
	}
	?>
	<?php
	$varrand3 = substr(md5(uniqid(rand())), 0, 10);
	$varallw3 = array("image/bmp", "image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");
	$tips3 = array("bmp", "gif", "jpeg", "png", "jpg");
  $varpath3 = "/opt/lampp/htdocs/mirafloresapp/tmp/";
  //$varpath3 = "http://app.expresomiraflores.com/tmp/";
	$varstat3 = "";

	if ($_POST["action"] == "upload") {
		if (is_uploaded_file($_FILES["imagenlat"]["tmp_name"])) {
			$varname3 = $_FILES["posterior"]['name'];
			$vartemp3 = $_FILES['posterior']['tmp_name'];
			$vartype3 = $_FILES['posterior']['type'];

			if (in_array($vartype3, $varallw3) && $varname3 != "") {
				$arrname3 = explode(".", $varname3);
				$i3 = strtolower(end($arrname3));
				if (in_array($i3, $tips3)) {
					$varname3 = $varrand3 . "." . $i3;
					if (copy($vartemp3, $varpath3 . $varname3)) {
						$varpath3 = $varpath3 . $varname3;
						$varstat3 = "ok";
					} else {
						$varstat3 = "Error al subir el archivo";
					}
				} else {
					$varstat3 = "Archivo no valido";
				}
			} else {
				$varstat3 = "Archivo no valido";
			}
		}
	}
	?>
	<?php
	// definimos las variables o marcamos el error
	include '../config/Funciones.php';
	$bd  = conectar();

	$sqlAL = "SELECT Placa, Activo FROM tblAlistamiento WHERE Placa ='" . $_POST['placa'] . "' AND Activo = 1";
	$resultAL = mysqli_query($bd, $sqlAL);
	// *******  AQUI SE QUITA LA VALIDACION DE LA VIGENCIA DEL PROTOCOLO DE ALISTAMIENTO **********
		if (mysqli_num_rows($resultAL) >= 1) {
		die("El Protocolo de Alistamiento del vehículo " . $_POST['placa'] . " ya se encuentra actualizado <br><br> <a href=\"SeleccionContrato_p.php\">Generar FUEC </a><div align='center'>");
	} else {
	@mysqli_query($bd, "SET NAMES 'utf8'");
  $placa = mysqli_real_escape_string($bd, $_POST['placa']);
  $fecha = mysqli_real_escape_string($bd, $_POST['fecha']);
  $source = mysqli_real_escape_string($bd, $_POST['source']);
  $driver = mysqli_real_escape_string($bd, $_POST['driver']);
  $km = mysqli_real_escape_string($bd, $_POST['km']);
  $date = mysqli_real_escape_string($bd, $_POST['date']);
  $selectaseo = mysqli_real_escape_string($bd, $_POST['selectaseo']);
  $selectpuertas = mysqli_real_escape_string($bd, $_POST['selectpuertas']);
  $selectllantas = mysqli_real_escape_string($bd, $_POST['selectllantas']);
  $selectfaros = mysqli_real_escape_string($bd, $_POST['selectfaros']);
  $selectvidrios = mysqli_real_escape_string($bd, $_POST['selectvidrios']);
  $selectretro = mysqli_real_escape_string($bd, $_POST['selectretro']);
  $selectextintor = mysqli_real_escape_string($bd, $_POST['selectextintor']);
  $selectexosto = mysqli_real_escape_string($bd, $_POST['selectexosto']);
  $selectluces = mysqli_real_escape_string($bd, $_POST['selectluces']);
  $selecttestigos = mysqli_real_escape_string($bd, $_POST['selecttestigos']);
  $selectpedales = mysqli_real_escape_string($bd, $_POST['selectpedales']);
  $selectcaja = mysqli_real_escape_string($bd, $_POST['selectcaja']);
  $selectfreno = mysqli_real_escape_string($bd, $_POST['selectfreno']);
  $selectparqueo = mysqli_real_escape_string($bd, $_POST['selectparqueo']);
  $selectsillas = mysqli_real_escape_string($bd, $_POST['selectsillas']);
  $selectcinturones = mysqli_real_escape_string($bd, $_POST['selectcinturones']);
  $selectemer = mysqli_real_escape_string($bd, $_POST['selectemer']);
  $selectespejos = mysqli_real_escape_string($bd, $_POST['selectespejos']);
  $selectbocina = mysqli_real_escape_string($bd, $_POST['selectbocina']);
  $selectbotiquin = mysqli_real_escape_string($bd, $_POST['selectbotiquin']);
  $selectaire = mysqli_real_escape_string($bd, $_POST['selectaire']);
  $selectliqfreno = mysqli_real_escape_string($bd, $_POST['selectliqfreno']);
  $selectacemotor = mysqli_real_escape_string($bd, $_POST['selectacemotor']);
  $selectliqembrague = mysqli_real_escape_string($bd, $_POST['selectliqembrague']);
  $selectrefri = mysqli_real_escape_string($bd, $_POST['selectrefri']);
  $selectliqdir = mysqli_real_escape_string($bd, $_POST['selectliqdir']);
  $selectlimpia = mysqli_real_escape_string($bd, $_POST['selectlimpia']);
  $selectcorreas = mysqli_real_escape_string($bd, $_POST['selectcorreas']);
  $selectmangueras = mysqli_real_escape_string($bd, $_POST['selectmangueras']);
  $selectcables = mysqli_real_escape_string($bd, $_POST['selectcables']);
  $selectbaterias = mysqli_real_escape_string($bd, $_POST['selectbaterias']);
  $observaciones = mysqli_real_escape_string($bd, $_POST['observaciones']);
  $responsable = mysqli_real_escape_string($bd, $_POST['responsable']);

	$ssql = "INSERT INTO tblAlistamiento (Placa,Fecha,Ruta,Conductor,KmActual,Salida,Aseo,Puertas,Llantas,Faros,Vidrios,Retrovisor,Extintor,Exosto,Luces,Testigos,Pedales,Caja,Freno,Parqueo,Sillas,Cinturones,Emergencia,Espejos,Bocina,Botiquin,Aire,LiqFreno,AceMotor,LiqEmbrague,Refrigerante,Activo,LiqDir,LimpiaPara,Correas,Mangueras,Cables,Bateria,Observaciones,Responsable,imagen, imagenlat, imagenlat1, posterior ) 
             VALUES('$placa','$fecha', '$source' ,'$driver',  '$km' , '$date','$selectaseo', '$selectpuertas',  '$selectllantas',  '$selectfaros', '$selectvidrios', '$selectretro', '$selectextintor', '$selectexosto', '$selectluces', '$selecttestigos', '$selectpedales', '$selectcaja', '$selectfreno', '$selectparqueo', '$selectsillas', '$selectcinturones', '$selectemer', '$selectespejos', '$selectbocina', '$selectbotiquin', '$selectaire','$selectliqfreno','$selectacemotor','$selectliqembrague','$selectrefri',1,'$selectliqdir','$selectlimpia','$selectcorreas','$selectmangueras','$selectcables','$selectbaterias','$observaciones','$responsable','$varpath','$varpath1','$varpath2', '$varpath3')";

	$rs_access = mysqli_query($bd, $ssql);

	if (!$rs_access)
		die("Error al ejecutar la consulta:        " . mysqli_error($bd));
	echo "<br>";
	echo  "<font face='Arial Narrow'><font size = 5 ><div align='center'>El Protocolo de Alistamiento ha sido procesado con éxito</div></font></font> \n";

	//recibo el último id
	$ultimo_id = mysqli_insert_id($bd);
	echo "<font face='Arial Narrow'> <font size= 5> Su código de Protocolo de Alistamiento es :<b> $ultimo_id  </b> </font>";
	echo "<br>";

	if ($_POST['selectacemotor'] == 'Malo') {
		echo "<font face='Arial Narrow'> <font size= 5> El Protocolo de Alistamiento se generó pero éste no cumple con los requisitos mínimos para laborar debido que el item FUGA DE FLUIDOS DE MOTOR \n se reporta como '$_POST[selectacemotor]' y éste Item no dede tener valores negativos </b> </font>";
	}
	} // *******  AQUI SE CIERRA EL IF DE  LA VALIDACION DE LA VIGENCIA DEL PROTOCOLO DE ALISTAMIENTO **********
	?>;

	<?php

	$sql2017 = "UPDATE tblVencimientos SET FechaKmActual = '$_POST[fecha]' , KmActual = '$_POST[km]'  WHERE Placa = '$_POST[placa]'";

	if (mysqli_query($bd, $sql2017)) {
		echo "";
	} else {
		echo "No fue Posible actualizar el odómetro" . mysqli_error($bd);
	}
	mysqli_close($bd);
	?>
	<?php
	$dia = date("d.m.Y");
	$hora = date("H:i:s");
	$fecha = $_POST['fecha'];
	$protocol = $ultimo_id;
	$placa = $_POST['placa'];
	$kilom = $_POST['km'];
	$email = "dev@expresomiraflores.com";
	$destinatario = "johann.rvs@gmail.com";
	$subject = 'Protocolo de Alistamiento ' . $placa;
	$desde = 'Desde: ' . $email . "\r\n" .
		'Reply-To:dev@expresomiraflores.com' . "\r\n" .
		'Cc: dev@expresomiraflores.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	$contingut = "
 El mensaje se ha sido enviado desde transportespoira.com el dia: $dia a las: $hora\n\n 
----------------------------------------------------------------------------\n
 Protocolo No.: $protocol\n
 Fecha: $fecha\n
 Placa: $placa\n
 Km.: $kilom\n
 Para obtener el FUEC elaborado, ingrese aqui: https://aplicaciones.transportespoira.com/AlistamientoPDF.php/?var=$protocol
 ----------------------------------------------------------------------------\n
 ";
	mail($destinatario, $subject, $contingut, $desde);

	echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Para descargar el documento completo del Protocolo de Alistamiento que acabo de generar haga click <a href='AlistamientoPDF.php/?var=$protocol'>aqui</a> Si va a generar un FUEC haga click en el siguiente boton </span> </b></font></td></tr>";
	?>

	<body>
		<div>
			<input type="button" onclick="location.href = 'SeleccionContrato_p.php'" value="Generar FUEC"></button>
		</div>
	</body>

</html>