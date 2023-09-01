<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/* if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$recaptcha_secret = "6LeqwhUUAAAAAKFmuBXLtJQJF58BctMJy271LpXo";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $_POST['g-recaptcha-response']);
	$response = json_decode($response, true);
	if ($response["success"] === false) {
		echo "<script>alert('Aseg�sere de validar el Captcha. Click en Aceptar para Intentarlo nuevamente .'); window.location.href=\"GenerarAlistamiento.php\"</script>";
	} else {
	}
} */
//Incluimos la libreria fpdf
require('../fpdf186/fpdf.php');
//Incluimos el archivo de conexion a la base de datos
include '../config/Funciones.php';
$bd  = conectar();

//mysql_select_db("emestour_Solicitudes",$con);
//Almacenamos el curso que haya elegido en el formulario
//$curso = $_POST['curso'];
//creamos una clase para ocupar el encabezado y pie de pagina en el PDF
class PDF extends FPDF
{
	//El metodo para crear el encabezado
	function Header()
	{
		$this->Cell(($this->w - 20), 20, '', 0, 1);
		$this->Cell(($this->w - 110), 25, '', 0);
		$this->Image("https://i.ibb.co/ynPGDxL/logo.png", 130, 10, 70, 20, 'png');
		$this->SetFont('Arial', 'B', 10); //Tipo de letra, estilo y tama�o
		$this->Cell(50, 05,'EMPRESA DE SERVICIO ESPECIAL EXPRESO MIRAFLORES SAS NIT: 900568844', 0, 1, 'R');
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
		$this->Cell(0, 5, date('d/m/Y H:i:s') , 0, 1, 'R');
		$this->Cell(0, 5, 'En Cumpliento de: Ley 769 de 2002, Ley 1383 de 2010, NTC 5375 Y Resolucion 40595:2022 - Generado desde app miraflores', 0, 1, 'C');
	}
}

//ahora instanseamos un objeto de la clase fpdf para empezar a armar el PDF con orientacion vertical, margenes en milimetros y tama�o de papel carta
$pdf = new PDF('P', 'mm', 'Legal');

//Utilizamos el siguiente metodo para cargar una nueva pagina en el PDF
$pdf->AddPage();
$pdf->AliasNbPages();
//Asiganamos el tipo de fuente, el estilo y el tama�o de letra
$pdf->SetFont('Arial', '', 10);
//Definimos el color de la letra
$pdf->SetTextColor(0x00, 0x00, 0x00);
$pdf->SetTextColor(0x00,0x00,0x00);
 $pdf->SetFillColor(214, 214, 214);

//generamos la consulta en la siguiente variable
//obtenemos todos los datos de la tabla alumnos segun el curso al que pertenecen
$sql = "SELECT * FROM tblAlistamiento WHERE IdProtocolo ='" . $_GET['var'] . "'";
$listado = mysqli_query($bd, $sql);

//Ahora mediante un bucle construimos el reporte 
//Pero primero validemos si existen alumnos en ese curso nos cargue los datos
if (mysqli_num_rows($listado) > 0) {
	while ($fila = mysqli_fetch_array($listado)) {
		$pdf->SetFont('Arial', 'B', 10); //Tipo de letra, estilo y tama�o
		$pdf->Cell(0, 4, 'PROTOCOLO DE ALISTAMIENTO No. ' . $fila['IdProtocolo'], 0, 1, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(50, 10, 'FECHA DE ELABORACION', 1, 0, 'L'); //id
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(144, 10, $fila['FechaActual'], 1, 1, 'L'); //Celda con ancho de 50, alto de 10, el dato, borde 1, sin salto de linea**
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(50, 10, 'PLACA', 1, 0); //**
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(20, 10, $fila['Placa'], 1, 0); //**
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(30, 10, 'CONDUCTOR', 1, 0, 'C'); //**
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(94, 10, $fila['Conductor'], 1, 1); //**
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(50, 10, 'ORIGEN-DESTINO:', 1, 0); //**
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(80, 10, $fila['Ruta'], 1, 0); //**
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(27, 10, 'HORA SALIDA:', 1, 0);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(37, 10, $fila['Salida'], 1, 1); //**
		$pdf->Ln(3);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(80, 10, 'CONCEPTO', 0, 0, 'C',TRUE); //**
		$pdf->Cell(17, 10, 'ESTADO', 0, 0, 'C', TRUE); //**
		$pdf->Cell(80, 10, 'CONCEPTO', 0, 0, 'C',TRUE); //**
		$pdf->Cell(17, 10, 'ESTADO', 0, 1, 'C',TRUE); //** 
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(80, 10, 'ASEO GENERAL: Sin polvo,lodo', 1, 0);

		$pdf->Cell(17, 10, $fila['Aseo'], 1, 0, 'C');
		
		$pdf->MultiCell(80, 5,'PUERTAS: Sin golpes, rayones - abren o cierran por dentro y por fuera', 1, 'L');
		$pdf->SetY(86);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Puertas'], 1, 1, 'C');
		$pdf->SetY(96);
		$pdf->SetX(10);

		$pdf->MultiCell(80, 5, 'ESTADO DE LLANTAS: Sin golpes, deformacion ni desgaste excesivo,pernos', 1, 0);
		$pdf->SetY(96);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Llantas'], 1, 0, 'C');
		$pdf->SetY(96);
		$pdf->SetX(107);
	
		$pdf->MultiCell(80, 5, 'FAROS DELANTEROS/TRASEROS: Sin agua, ni golpes o fisuras 	', 1, 0);
		$pdf->SetY(96);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Faros'], 1, 1, 'C');
		$pdf->SetY(106);
		$pdf->SetX(10);
	
		$pdf->MultiCell(80, 5, 'VIDRIOS-VENTANAS-LIMPIABRISAS: Sin rayones ni fisuras - limpiabrisas funcional', 1, 0);
		$pdf->SetY(106);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Vidrios'], 1, 0, 'C');
		
		$pdf->SetY(106);
		$pdf->SetX(107);
		$pdf->MultiCell(80, 5, 'ESPEJOS RETROVISORES: Estables, sin roturas ni fisuras', 1, 0);
		$pdf->SetY(106);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Retrovisor'], 1, 1, 'C');
	
		$pdf->MultiCell(80, 5, 'VENCIMIENTO EXTINTOR - MANOMETRO: Estables, sin roturas ni fisuras:', 1, 0);
		$pdf->SetY(116);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Extintor'], 1, 0, 'C');
		$pdf->SetY(116);
		$pdf->SetX(107);

		$pdf->MultiCell(80, 5, 'EXOSTO: Sin fisuras, ni golpes que afecten su funcionamiento', 1, 0);
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetY(116);
		$pdf->SetX(187);
		$pdf->Cell(17, 10, $fila['Exosto'], 1, 1, 'C');
		$pdf->SetY(126);
		$pdf->SetX(10);
	
		$pdf->MultiCell(80, 5, 'LUCES TRASERAS - DIRECCIONALES - FRENO - REVERSA: Deben encender todas', 1, 0);
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetY(126);
		$pdf->SetX(90);
		$pdf->Cell(17, 10, $fila['Luces'], 1, 0, 'C');
	
		$pdf->SetY(126);
		$pdf->SetX(107);
		$pdf->MultiCell(80, 5, 'TABLERO - TESTIGOS: Los testigos deben encender', 1, 0);
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetY(126);
		$pdf->SetX(187);
		$pdf->Cell(17, 10, $fila['Testigos'], 1, 1, 'C');

		$pdf->SetY(136);
		$pdf->SetX(10);
		$pdf->MultiCell(80, 5, 'MANDOS - PEDALES: Deben estar fijos y funcionales', 1, 0);
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetY(136);
		$pdf->SetX(90);
		$pdf->Cell(17, 10, $fila['Pedales'], 1, 0, 'C');
		$pdf->SetY(136);
		$pdf->SetX(107);

		$pdf->MultiCell(80, 5, 'BARRA DE CAMBIOS: Debe estar fijo y funcional, sin desajustes', 1, 0);
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetY(136);
		$pdf->SetX(187);
		$pdf->Cell(17, 10, $fila['Caja'], 1, 1, 'C');
		$pdf->SetY(146);
		$pdf->SetX(10);
	
		$pdf->MultiCell(80, 5, 'FRENO: Sistema de frenado sin longitud excesiva', 1, 0);
		$pdf->SetY(146);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Freno'], 1, 0, 'C');
	
		$pdf->SetY(146);
		$pdf->SetX(107);
		$pdf->MultiCell(80, 5, 'FRENO DE PARQUEO: Debe estar fijo y funcional', 1, 0);
		$pdf->SetY(146);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Parqueo'], 1, 1, 'C');
		
		$pdf->SetY(156);
		$pdf->SetX(10);
		$pdf->MultiCell(80, 5, 'SILLAS - VENTANAS- VIDRIOS:  Firmes sin vibraciones', 1, 0);

		$pdf->SetY(156);
		$pdf->SetX(90);
		$pdf->Cell(17, 10, $fila['Sillas'], 1, 0, 'C');
	
		$pdf->SetY(156);
		$pdf->SetX(107);
		$pdf->MultiCell(80, 5, 'ESPEJOS RETROVISORES INTERNOS: Estables, uno en el centro, sin roturas', 1, 0);
		$pdf->SetY(156);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Espejos'], 1, 1, 'C');

		$pdf->SetY(166);
		$pdf->SetX(10);
		$pdf->MultiCell(80, 5, 'SISTEMA DE AIRE: Aire acondicionado funcional - cuando aplique', 1, 0);
		$pdf->SetY(166);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Aire'], 1, 0, 'C');
		$pdf->SetY(166);
		$pdf->SetX(107);

		$pdf->MultiCell(80, 5, 'CINTURONES DE SEGURIDAD: Uno por silla. La hebilla debe enganchar con el candado', 1, 0);
		$pdf->SetY(166);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Cinturones'], 1, 1, 'C');
		$pdf->SetY(176);
		$pdf->SetX(10);

		$pdf->MultiCell(80, 5, 'SALIDAS DE EMERGENCIA: Senalizadas, martillo en cada salida de emergencia', 1, 0);
		$pdf->SetY(176);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Emergencia'], 1, 0, 'C');

		$pdf->MultiCell(80, 5, 'BOCINAS: Debe sonar y escucharse a 50 mts de distancia', 1, 0);
		$pdf->SetY(176);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Bocina'], 1, 1, 'C');
		$pdf->SetY(186);
		$pdf->SetX(10);
	
		$pdf->MultiCell(80, 5, 'EQUIPO PREVENCION Y SEGURIDAD: Botiquin, gato, cruceta, tacos, herramientas', 1, 0);
		$pdf->SetY(186);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Botiquin'], 1, 0, 'C');

		$pdf->MultiCell(80, 5, 'LIQUIDO DE FRENOS: A nivel de depósito, sin fuga', 1, 0);
		$pdf->SetY(186);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['LiqFreno'], 1, 1, 'C');
		
		$pdf->SetY(196);
		$pdf->SetX(10);
		$pdf->MultiCell(80, 5, 'ACEITE MOTOR: A nivel de la aguja y sin impurezas, sin fuga', 1, 0);
		$pdf->SetY(196);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['AceMotor'], 1, 0, 'C');
	
		$pdf->MultiCell(80, 5, 'LIQUIDO DE EMBRAGUE: A nivel establecido en el deposito, sin fuga', 1, 0);
		$pdf->SetY(196);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['LiqEmbrague'], 1, 0 , 'C');
		
		$pdf->SetY(206);
		$pdf->SetX(10);
		$pdf->MultiCell(80, 5, 'CORREAS:  Estado estandar en ambas caras y tension', 1, 1);
		$pdf->SetY(206);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Correas'], 1, 1, 'C');
		$pdf->SetY(206);
		$pdf->SetX(107);
		$pdf->MultiCell(80, 5, 'MANGUERAS: Sin roturas ni desgaste, conectadas con abrazaderas', 1, 1);
		$pdf->SetY(206);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Mangueras'], 1, 1 , 'C');
		$pdf->SetY(216);
		$pdf->SetX(10);
		$pdf->MultiCell(80, 5, 'CABLEADO: Sin desgaste y asegurados con firmeza', 1, 1);
		
		$pdf->SetY(216);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Cables'], 1, 1, 'C');
		$pdf->SetY(216);
		$pdf->SetX(107);
		$pdf->MultiCell(80, 5, 'BATERIA: Con soporte, sin corrosion, bornes sin sulfatar y conectados', 1, 1);
		$pdf->SetY(216);
		$pdf->SetX(187);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(17, 10, $fila['Bateria'], 1, 1 , 'C');
		$pdf->SetY(226);
		$pdf->SetX(10);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(80, 10, 'RESPONSABLE REVISION', 1, 0);
		$pdf->SetY(226);
		$pdf->SetX(90);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(114, 10, $fila['Responsable'], 1, 0, 'L');
		$pdf->SetY(236);
		$pdf->SetX(10);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(35, 10, 'OBSERVACIONES:', 0,0, );
		$pdf->SetY(236);
		$pdf->SetX(45);
		$pdf->SetFont('Arial', '', 10);
		$pdf->MultiCell(159, 5, '' . $fila['Observaciones'] . '', 0, 'J');
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Ln(7);
		$pdf->Cell(194, 5, 'REGISTRO FOTOGRAFICO', 0, 1, 'C', TRUE); //**
		

		$pdf->Image($fila['imagen'], 10, 280, 50, 40);
		$pdf->Image($fila['imagenlat'], 60, 280, 50, 40);
		$pdf->Image($fila['imagenlat1'], 110, 280, 50, 40);
		$pdf->Image($fila['posterior'], 160, 280, 50, 40); 


		$pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro

	}
} else {
	$pdf->Cell(0, 10, "No existen Protocolos de Alistamiento asociados a ese n�mero", 0, 0, "C");
}

//Ejecutar el pdf en una nueva pesta�a y al guardarlo sugiere el nombre de archivo
$pdf->Output('Protocolo_Alistamiento.pdf', 'I');
