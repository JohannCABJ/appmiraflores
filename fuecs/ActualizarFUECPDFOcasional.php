<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Incluimos la libreria fpdf
include("../phpqrcode/qrlib.php");
require("../fpdf186/fpdf.php");
//$con=mysqli_connect("localhost", "transroc", "wZMQbM2TVSzFPBsiHd","transroc_ROCA");
include '../config/Funciones.php';
$bd  = conectar();
//Almacenamos el curso que haya elegido en el formulario
//$curso = $_POST['curso'];

//creamos una clase para ocupar el encabezado y pie de pagina en el PDF
class PDF extends FPDF
{
	//El metodo para crear el encabezado
	function Header()
	{
		$this->Cell(($this->w - 20), 20, '', 0, 1);
		$this->Image('https://i.ibb.co/K9MLSts/bloque1887.jpg', 10, 10, 80, 16, 'jpg');
		$this->Cell(($this->w - 110), 25, '', 0);
		$this->Image('https://i.ibb.co/ynPGDxL/logo.png', 130, 10, 58, 18, 'png');
		$this->SetFont('Arial', 'B', 10); //Tipo de letra, estilo y tama�o
		$this->Cell(65, 05, 'FORMATO UNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PUBLICO DE TRANSPORTE', 0, 1, 'R'); //Titulo del reporte
	}

	// Pie de p�gina
	function Footer()
	{
		// Posici�n: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial', 'I', 8);
		// N�mero de p�gina

		$this->Cell(0, 10, 'Pag ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
		$this->SetFont('Arial', '', 5); //Tipo de letra, estilo y tama�o
		$this->Cell(0, 10, date('d/m/Y H:i:s'), 0, 1, 'R');
		$this->SetY(-19);
		$this->SetFont('Arial', '', 7); //Tipo de letra, estilo y tama�o
		$this->Cell(0, 10, 'ESTE DOCUMENTO DIGITAL CUMPLE CON EL ARTICULO 8 DE LA RESOLUCION No.1069 DEL 23 DE ABRIL DE 2015 MINISTERIO DE TRANSPORTE', 0, 1, 'C');
	}
}

//ahora instanseamos un objeto de la clase fpdf para empezar a armar el PDF con orientacion vertical, margenes en milimetros y tama�o de papel carta
$pdf = new PDF('P', 'mm', 'Letter');

//Utilizamos el siguiente metodo para cargar una nueva pagina en el PDF
$pdf->AddPage();
$pdf->AliasNbPages();
//Asiganamos el tipo de fuente, el estilo y el tama�o de letra
$pdf->SetFont('Arial', '', 10);
//Definimos el color de la letra
$pdf->SetTextColor(0x00, 0x00, 0x00);

/* $listado2 = "SELECT * FROM tblContratos WHERE NoContrato= 0024 ";
//$listado2 = "SELECT * FROM tblContratos WHERE NoContrato='" .$_POST['contrato1']."'";
$result2 = mysqli_query($con, $listado2);

if (mysqli_num_rows($result2) == 0) {
	die("<div align='center'> <img src='images/logoPoiraTransparent.png' border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br> No se puede generar la actualizacion del FUEC ya que no existen contratos asociados a ese numero <br><br> <a href=\"ActualizarFUEC_lOcasional.php\">  Intenta nuevamente </a><div align='center'>");
} */

$listado22 = mysqli_query($bd, "SELECT * FROM tblFUECOcasional WHERE IdFUEC ='" . $_GET['var'] . "'");

if (mysqli_num_rows($listado22) > 0) {
	while ($fila1 = mysqli_fetch_array($listado22)) {

		$fechaini = EXPLODE('-', $fila1['FechaInicial']);
		$fechafin = EXPLODE('-', $fila1['FechaFinal']);
		$placa99 = $fila1['Placa'];
		$noFUEC = $fila1['IdFUEC'];
		$fechaf = $fila1['FechaFinal'];
		$fechaelab = $fila1['FechaActual'];

		$sql1 = "SELECT * FROM tblAlistamiento WHERE Placa = '" . $placa99 . "' AND Activo = '1' ORDER BY IdProtocolo DESC LIMIT 1 ";
		$result1 = mysqli_query($bd, $sql1);

		//  if( mysql_num_rows($result1) == 0){
		//die ("<div align='center'> <img src='Logo Espetours.jpg' border=0> <br><br><b> ESPETOURS Informa: </b> <br><br> El Protocolo  No." .$_POST['protocolo']." no existe actualmente en nuestros Registros <br><br> <a href=\"ActualizarFUEC_lOcasional.php\">  Intenta nuevamente </a><div align='center'>");
		//}
		while ($row = mysqli_fetch_assoc($result1)) {
			$Placa1 = $row['Placa'];
			$Activo = $row['Activo'];
			$Motor = $row['AceMotor'];
			$Caja = $row['Caja'];
			$Transmision = $row['LiqEmbrague'];
			$Mangueras = $row['Mangueras'];
			$FrenosLiq = $row['LiqFreno'];
			$Hidraulico = $row['LiqDir'];
			$Llantas = $row['Llantas'];
			$Protocol = $row['IdProtocolo'];

			if (!$result1) {
				echo "La consulta SQL contiene errores." . mysqli_error($bd);
				exit();
			}
			//else
			//{if ($Placa1 <> $PlacaA){

			//die ("<div align='center'> <img src='Logo Espetours.jpg' border=0> <br><br><b> ESPETOURS Informa: </b> <br><br>No se puede generar el FUEC debido a que la placa ingresada no coincide con el n�mero de placa del Protocolo de Alistamiento <br><br> <a href=\"ActualizarFUEC_lMancol.php\"> haz click aqu� </a> <div align='center'> ");
			//}
			else {
				if ($Activo == 0) {

					die("<div align='center'> <img src='images/logoPoiraTransparent.png' border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br>No se puede generar el FUEC debido a que el Protocolo de Alistamiento ha expirado, para realizar un nuevo Protocolo de Alistamiento <br><br> <a href=\"Alistamiento_p.php\"> haz click aquI </a> <div align='center'> ");
				} else {
					if ($Motor == 'Malo') {
						die(" <div align='center'> <img src='images/logoPoiraTransparent.png' border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br>No se puede generar el FUEC debido a que El Protocolo de Alistamiento en el Item 'Fuga Fluidos Motor' no cumple con los requisitos minimos para laborar, realiza las acciones correctivas e<br><br> <a href=\"Alistamiento_p.php\"> Intenta nuevamente </a> <div align='center'>");
					} else {
						if ($Caja == 'Malo') {
							die(" <div align='center'> <img src='images/logoPoiraTransparent.png' border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br>No se puede generar el FUEC debido a que El Protocolo de Alistamiento en el Item 'Fuga Fluidos Caja' no cumple con los requisitos minimos para laborar, realiza las acciones correctivas e<br><br> <a href=\"Alistamiento_p.php\"> Intenta nuevamente </a> <div align='center'>");
						} else {
							if ($Transmision == 'Malo') {
								die(" <div align='center'> <img src='images/logoPoiraTransparent.png border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br>No se puede generar el FUEC debido a que El Protocolo de Alistamiento en el Item 'Fuga Fluidos Transmision' no cumple con los requisitos minimos para laborar, realiza las acciones correctivas e<br><br> <a href=\"Alistamiento_p.php\"> Intenta nuevamente </a> <div align='center'>");
							} else {
								if ($Mangueras == 'Malo') {
									die(" <div align='center'> <img src='images/logoPoiraTransparent.png' border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br>No se puede generar el FUEC debido a que El Protocolo de Alistamiento en el Item 'Estado Mangueras' no cumple con los requisitos minimos para laborar, realiza las acciones correctivas e<br><br> <a href=\"Alistamiento_p.php\"> Intenta nuevamente </a> <div align='center'>");
								} else {
									if ($FrenosLiq == 'Malo') {
										die(" <div align='center'> <img src='images/logoPoiraTransparent.png' border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br>No se puede generar el FUEC debido a que El Protocolo de Alistamiento en el Item 'Nivel Liquido de frenos' no cumple con los requisitos minimos para laborar, realiza las acciones correctivas e<br><br> <a href=\"Alistamiento_p.php\"> Intenta nuevamente </a> <div align='center'>");
									} else {
										if ($Hidraulico == 'Malo') {
											die(" <div align='center'> <img src='images/logoPoiraTransparent.png' border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br>No se puede generar el FUEC debido a que El Protocolo de Alistamiento en el Item 'Nivel Liquido Direccion' no cumple con los requisitos minimos para laborar, realiza las acciones correctivas e<br><br> <a href=\"Alistamiento_p.php\"> Intenta nuevamente </a> <div align='center'>");
										} else {
											if ($Llantas == 'Malo') {
												die(" <div align='center'> <img src='images/logoPoiraTransparent.png' border=0> <br><br><b> TRANSPORTES POIRA Informa: </b> <br><br>No se puede generar el FUEC debido a que El Protocolo de Alistamiento en el Item 'Estado de las llantas' no cumple con los requisitos minimos para laborar, realiza las acciones correctivas e<br><br> <a href=\"Alistamiento_p.php\"> Intenta nuevamente </a> <div align='center'>");
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
		//}
		$fechaActualL = date('Y');
		$listado = mysqli_query($bd, "SELECT * FROM tblContratos WHERE NoContrato= 0024 ");
		//$listado = mysql_query("SELECT * FROM tblContratos WHERE NoContrato='" .$_POST['contrato1']."'");

		if (mysqli_num_rows($listado) > 0) {
			while ($fila = mysqli_fetch_array($listado)) {
				$pdf->SetFont('Arial', 'B', 10); //Tipo de letra, estilo y tama�o
				$pdf->Cell(0, 4, 'TERRESTRE AUTOMOTOR ESPECIAL No. 473007718' . $fechaActualL . $fila['NoContrato'] . $fila1['IdFUEC'], 0, 1, 'C');
				$pdf->Cell(194, 5, '         RAZON SOCIAL DE LA EMPRESA DE TRANSPORTE ESPECIAL                                             NIT', 1, 1, 'L'); //**
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(130, 10, 'EMPRESA DE SERVICIO ESPECIAL EXPRESO MIRAFLORES S.A.S.', 1, 0, 'C'); //id
				$pdf->Cell(64, 10, '900568844-2', 1, 1, 'C'); //Celda con ancho de 50, alto de 10, el dato, borde 1, sin salto de linea**
				$pdf->Cell(30, 10, 'CONTRATO No.', 1, 0); //**
				$pdf->Cell(164, 10, $fila['NoContrato'], 1, 1); //**
				$pdf->Cell(30, 10, 'CONTRATANTE:', 1, 0); //**
				$pdf->Cell(127, 10, $fila1['Contratante'], 1, 0); //**
				$pdf->Cell(10, 10, 'NIT:', 1, 0);
				$pdf->Cell(27, 10, $fila1['NitContratante'], 1, 1); //**
				//$pdf->Cell(30,10,'',1,0);
				$pdf->MultiCell(194, 05, 'OBJETO CONTRATO:  ' . $fila1['ObjetoContrato'], 1, 'L');
				$pdf->MultiCell(194, 05, 'ORIGEN-DESTINO,DESCRIBIENDO EL RECORRIDO:  ' . $fila1['OrigenDestino'], 1, 'L');
				$pdf->Cell(90, 10, 'CONVENIO  CONSORCIO  UNION TEMPORAL  CON:', 1, 0);
				$pdf->Cell(104, 10, $fila1['Convenio'], 1, 1);
				//$pdf->Cell(194,10,'',1,1,'C');
				$pdf->Cell(95, 10, 'VIGENCIA DEL CONTRATO', 1, 0, 'C'); //**
				$pdf->Cell(33, 10, 'DIA', 1, 0, 'C');
				$pdf->Cell(33, 10, 'MES', 1, 0, 'C');
				$pdf->Cell(33, 10, 'ANO', 1, 1, 'C');
				$pdf->Cell(95, 10, 'FECHA INCIAL', 1, 0, 'C');
				$pdf->Cell(33, 10, $fechaini[2], 1, 0, 'C');
				$pdf->Cell(33, 10, $fechaini[1], 1, 0, 'C');
				$pdf->Cell(33, 10, $fechaini[0], 1, 1, 'C');
				$pdf->Cell(95, 10, 'FECHA VENCIMIENTO', 1, 0, 'C');
				$pdf->Cell(33, 10, $fechafin[2], 1, 0, 'C');
				$pdf->Cell(33, 10, $fechafin[1], 1, 0, 'C');
				$pdf->Cell(33, 10, $fechafin[0], 1, 1, 'C');
				$pdf->Cell(194, 10, 'CARACTERISTICAS DEL VEHICULO', 1, 1, 'C');
				$pdf->Cell(48, 10, 'PLACA', 1, 0, 'C');
				$pdf->Cell(48, 10, 'MODELO', 1, 0, 'C');
				$pdf->Cell(49, 10, 'MARCA', 1, 0, 'C');
				$pdf->Cell(49, 10, 'CLASE', 1, 1, 'C');
				$pdf->Cell(48, 10, $fila1['Placa'], 1, 0, 'C');
				$pdf->Cell(48, 10, $fila1['Modelo'], 1, 0, 'C');
				$pdf->Cell(49, 10, $fila1['Marca'], 1, 0, 'C');
				$pdf->Cell(49, 10, $fila1['Clase'], 1, 1, 'C');
				$pdf->Cell(96, 10, 'NUMERO INTERNO', 1, 0, 'C');
				$pdf->Cell(98, 10, 'NUMERO TARJETA DE OPERACION', 1, 1, 'C');
				$pdf->Cell(96, 10, $fila1['Interno'], 1, 0, 'C');
				$pdf->Cell(98, 10, $fila1['TarjetaOp'], 1, 1, 'C');
				$pdf->SetFont('Arial', '', 8);
				$pdf->Cell(40, 8, 'DATOS DEL CONDUCTORES', 1, 0, 'C');
				$pdf->Cell(70, 8, 'NOMBRES Y APELLIDOS', 1, 0, 'C');
				$pdf->Cell(26, 8, 'No. CEDULA', 1, 0, 'C');
				$pdf->Cell(34, 8, 'LICENCIA CONDUCCION', 1, 0, 'C');
				$pdf->Cell(24, 8, 'VIGENCIA', 1, 1, 'C');
				$pdf->Cell(40, 8, 'CONDUCTOR 1', 1, 0, 'C');
				$pdf->Cell(70, 8, $fila1['NombreC1'], 1, 0, 'C');
				$pdf->Cell(26, 8, $fila1['CedulaC1'], 1, 0, 'C');
				$pdf->Cell(34, 8, $fila1['LicenciaC1'], 1, 0, 'C');
				$pdf->Cell(24, 8, $fila1['VigenciaC1'], 1, 1, 'C');
				$pdf->Cell(40, 8, 'CONDUCTOR 2', 1, 0, 'C');
				$pdf->Cell(70, 8, $fila1['NombreC2'], 1, 0, 'C');
				$pdf->Cell(26, 8, $fila1['CedulaC2'], 1, 0, 'C');
				$pdf->Cell(34, 8, $fila1['LicenciaC2'], 1, 0, 'C');
				$pdf->Cell(24, 8, $fila1['VigenciaC2'], 1, 1, 'C');
				$pdf->Cell(40, 8, 'CONDUCTOR 3', 1, 0, 'C');
				$pdf->Cell(70, 8, $fila1['NombreC3'], 1, 0, 'C');
				$pdf->Cell(26, 8, $fila1['CedulaC3'], 1, 0, 'C');
				$pdf->Cell(34, 8, $fila1['LicenciaC3'], 1, 0, 'C');
				$pdf->Cell(24, 8, $fila1['VigenciaC3'], 1, 1, 'C');
				$pdf->Cell(40, 8, 'RESPONSAB.CONTRATANTE', 1, 0, 'C');
				$pdf->Cell(70, 8, 'NOMBRES Y APELLIDOS', 1, 0, 'C');
				$pdf->Cell(26, 8, 'No. CEDULA', 1, 0, 'C');
				$pdf->Cell(34, 8, 'DIRECCION', 1, 0, 'C');
				$pdf->Cell(24, 8, 'TELEFONO', 1, 1, 'C');
				$pdf->Cell(40, 8, 'DATOS CONTRATANTE', 1, 0, 'C');
				$pdf->Cell(70, 8, $fila1['ResponsableCte'], 1, 0, 'C');
				$pdf->Cell(26, 8, $fila1['CedulaResponsableCte'], 1, 0, 'C');
				$pdf->Cell(34, 8, $fila1['DireccionResponsableCte'], 1, 0, 'C');
				$pdf->Cell(24, 8, $fila1['TelResponsableCte'], 1, 1, 'C');
				$pdf->Cell(0, 2, '', 0, 1, 'C');
				$pdf->Cell(110, 3, 'EXPRESO MIRAFLORES Mz. B Cs 8 Villa Carolina Purificacion Tol.', 0, 0, 'l');
				$pdf->Cell(84, 3, 'Firmado digitalmente por JESUS HELI ARIZA MANRIQUE', 0, 1, '0');
				$pdf->Cell(110, 3, 'Cel. 3118912134', 0, 0, 'l');
				$pdf->Cell(84, 3, 'REPRESENTANTE LEGAL', 0, 1, '0');
				$pdf->Cell(110, 3, 'Mail: info@expresomiraflores.com', 0, 0, 'l');
				$pdf->Cell(84, 3, 'Con un certificado digital emitido por EXPRESO MIRAFLORES', 0, 1, '0');
				$pdf->Image('https://i.ibb.co/NLx792D/logo-Super.png', 8, 255, 28, 9, 'png');
        //QRcode::png('espetours.com', "images/QR.png", "Q", 4, 2);
				//QRcode::png('./ActualizarFUECPDFOcasionalCopy.php/?var=9', "images/QR.png", "Q", 4, 2);
				QRcode::png($urlqr."/?var=" .$noFUEC, "images/QR.png", "Q", 4, 2);
				//QRcode::png("https://aplicaciones.transportespoira.com/ActualizarFUECPDFOcasionalCopy.php/?var=$noFUEC", "images/QR.png", "Q", 4, 2);
				$pdf->Image('images/QR.png', 92, 238, 28, 24, 'PNG');
				$pdf->Cell(110, 3, 'Puede verificar este documento escaneando el codigo QR', 0, 0, 'l');
				$pdf->Cell(84, 3, 'Razon: Soy el autor de este documento ', 0, 1, '0');
				$pdf->Image('https://i.ibb.co/5Ts3fYr/signRL.png', 170, 232, 35, 21, 'PNG');
				$pdf->Cell(110, 3, 'Protocolo de Alistamiento No.' . $Protocol . '', 0, 0, 'l');
				$pdf->Cell(84, 3, 'Fecha de elaboracion.' . $fechaelab . '', 0, 1, 'l');
				$pdf->Cell(110, 3, '', 0, 0, 'l');
				$pdf->Cell(84, 3, 'Firma digital ampara por la Ley 527 de 1999 ', 0, 1, 'l');
				$pdf->Cell(110, 3, '', 0, 0, 'l');
				$pdf->Cell(84, 3, 'Decreto 2364 de 2012 ', 0, 1, 'l');
				$pdf->Cell(110, 3, '', 0, 0, 'l');
				$pdf->Ln(14);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(194, 10, '         INSTRUCTIVO PARA LA DETERMINACION DEL NUMERO CONSECUTIVO DEL FUEC', 0, 1, 'C'); //**
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(194, 05, 'El formato unico de Extracto de Contrato "FUEC" estara constituido por los siguientes numeros', 0, 'L');
				$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
				$pdf->MultiCell(194, 05, 'a) Los tres primeros digitos de izquierda a derecha corresponden al codigo de la Direccion Territorial que otorgo la habilitacion o de aquella a la cual se hubiese trasladado la empresa de Servicio Publico de Transporte Terrestre Automotor Especial;', 0, 'J');
				$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
				$pdf->Cell(83, 5, 'Antioquia-Choco', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '305', 1, 0, 'C');
				$pdf->Cell(83, 5, 'Huila-Caqueta', 1, 0, 'C');
				$pdf->Cell(13, 5, '441', 1, 1, 'C');
				$pdf->Cell(83, 5, 'Bolivar-San Andres y Providencia', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '213', 1, 0, 'C');
				$pdf->Cell(83, 5, 'Meta-Vaupes-Vichada', 1, 0, 'C');
				$pdf->Cell(13, 5, '550', 1, 1, 'C');
				$pdf->Cell(83, 5, 'Boyaca-Casanare', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '415', 1, 0, 'C');
				$pdf->Cell(83, 5, 'Narino-Putumayo', 1, 0, 'C');
				$pdf->Cell(13, 5, '352', 1, 1, 'C');
				$pdf->Cell(83, 5, 'Caldas', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '317', 1, 0, 'C');
				$pdf->Cell(83, 5, 'N/Santander-Arauca', 1, 0, 'C');
				$pdf->Cell(13, 5, '454', 1, 1, 'C');
				$pdf->Cell(83, 5, 'Cauca', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '319', 1, 0, 'C');
				$pdf->Cell(83, 5, 'Quindio', 1, 0, 'C');
				$pdf->Cell(13, 5, '363', 1, 1, 'C');
				$pdf->Cell(83, 5, 'Cesar', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '220', 1, 0, 'C');
				$pdf->Cell(83, 5, 'Risaralda', 1, 0, 'C');
				$pdf->Cell(13, 5, '366', 1, 1, 'C');
				$pdf->Cell(83, 5, 'Cordoba-Sucre', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '223', 1, 0, 'C');
				$pdf->Cell(83, 5, 'Santander', 1, 0, 'C');
				$pdf->Cell(13, 5, '468', 1, 1, 'C');
				$pdf->Cell(83, 5, 'Cundinamarca', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '425', 1, 0, 'C');
				$pdf->Cell(83, 5, 'Tolima', 1, 0, 'C');
				$pdf->Cell(13, 5, '473', 1, 1, 'C');
				$pdf->Cell(83, 5, 'Guajira', 1, 0, 'C'); //**
				$pdf->Cell(13, 5, '421', 1, 0, 'C');
				$pdf->Cell(83, 5, 'Valle del Cauca', 1, 0, 'C');
				$pdf->Cell(13, 5, '376', 1, 1, 'C');
				$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
				$pdf->MultiCell(194, 05, 'b) Los cuatro digitos siguientes senalaran el numero de resolucion mediante la cual se otorgo la habilitacion de la Empresa. En caso que la resolucion no tenga estos digitos, los faltantes seran completados con ceros a la izquierda;', 0, 'J');
				$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
				$pdf->MultiCell(194, 05, 'c) Los dos siguientes digitos, corresponderan a los dos ultimos del ano en que la empresa fue habilitada;', 0, 'J');
				$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
				$pdf->MultiCell(194, 05, 'd) A continuacion, cuatro digitos que corresponderan al ano en el que se expide el extracto de contrato;', 0, 'J');
				$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
				$pdf->MultiCell(194, 05, 'e) Posteriormente, cuatro digitos que identifican el numero del contrato. La numeracion debe ser consecutiva, establecida por cada empresa y continuara con la numeracion dada a los contratos de prestacion del servicio celebrados para el transporte de estudiantes, empleados, turistas, usuarios del servicio de salud y grupos especificos de usuarios, en vigencia de la resolucion 6655 de 27 de diciembre de 2019. ', 0, 'J');
				$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
				$pdf->MultiCell(194, 05, 'f) Finalmente, los cuatros ultimos digitos corresponderan al numero consecutivo del extracto de contrato que se expida para la ejecucion de cada contrato. Se debe expedir un nuevo extracto por vencimiento del plazo inicial del mismo o por cambio del vehiculo.', 0, 'J');
				$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(194, 10, 'EJEMPLO', 0, 1, 'L'); //**
				$pdf->SetFont('Arial', '', 10);
				$pdf->MultiCell(194, 05, 'Empresa habilitada por la Direccion Territorial Cundimarca en el ano 2012, con resolucion de habilitacion No. 0155, que expide el primer extracto del contrato en el ano 2015, del contrato 255. El numero del FORMATO UNICO DE EXTRACTO DEL CONTRATO "FUEC" sera: 425015512201502550001', 0, 'J');
			}
		}
	}
} else {
	$pdf->Cell(0, 10, "No existen contratos asociados a ese numero", 0, 0, "C");
}
//Ejecutar el pdf en una nueva pesta�a y al guardarlo sugiere el nombre de archivo
$pdf->Output('FUEC ' . $Placa1 . ' ' . $noFUEC . ' ' . $fechaf . '.pdf', 'I');
