<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Protocolo de Alistamiento</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>

<body>
	<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	<?php
	include '../config/Funciones.php';
	?>
	<?php
	$con = conectar();

	$dat = "SELECT Placa FROM tblVencimientos WHERE Estado LIKE 'ACTIVO' ORDER BY Placa ASC";
	$sql = mysqli_query($con, $dat);

	$drivers = "SELECT IdConductor, Nombre, Apellidos FROM tblConductores WHERE EstadoLaboral LIKE 'ACTIVO' ORDER BY Nombre ASC";
	$sqlDrivers = mysqli_query($con, $drivers);
	?>
	<div class="container mt-5">
		<form action="./Alistamiento.php" method="post" enctype="multipart/form-data" id="needs-validation" novalidate>
			<div class="bg-success text-white p-3 mb-3">
				<h2 class="text-center">Protocolo de Alistamiento</h2>
			</div>
			<!-- FECHA -->
			<div class="container text-black w-80"><br>
				<div class="row d-flex justify-content-center">
					<div class="form-group mx-sm-4">
						<label for="validationCustom01">Fecha</label>
						<input type="datetime-local" class="form-control " id="validationCustom01" placeholder="Fecha" name="fecha" required>
					</div>
				</div>
			</div>
			<!-- Conductor -->
			<div class="container text-black  w-80"><br>
				<div class="form-group row">
					<label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Conductor</label>
					<div class="col-12 col-6">
						<select class="col-12 col-6" name="driver" required>
							<option value="">Seleccione...</option>
							<?php
							while ($driver = mysqli_fetch_array($sqlDrivers))
								echo "<option  value='" . $driver["IdConductor"] . "'>" . $driver["Nombre"] . " " . $driver["Apellidos"] . "</option>";
							?>
						</select>
						<div class="invalid-feedback">
							Por favor seleccione el conductor.
						</div>
					</div>
				</div>
			</div>
			<!-- Placa -->
			<div class="container text-black  w-80"><br>
				<div class="form-group row">
					<label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Placa</label>
					<div class="col-12 col-6">
						<select class="col-12 col-6" name="placa" required>
							<option value="">Seleccione...</option>
							<?php
							while ($lista = mysqli_fetch_array($sql))
								echo "<option  value='" . $lista["Placa"] . "'>" . $lista["Placa"] . "</option>";
							?>
						</select>
						<div class="invalid-feedback">
							Por favor seleccione la placa del vehículo.
						</div>
					</div>
				</div>
			</div>
			<!-- KilometrAJE -->
			<div class="container text-black  w-80"><br>
				<div class="form-group row">
					<label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Kilometraje Actual</label>
					<div class="col-12 col-6">
						<input name="km" type="text" class="form-control" required>
						<div class="invalid-feedback">
							Por favor ingrese el kilometraje actual.
						</div>
					</div>
				</div>
			</div>
			<!-- Origen - destino -->
			<div class="container text-black  w-80"><br>
				<div class="form-group row">
					<label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Origen - Destino</label>
					<div class="col-12 col-6">
						<input name="source" type="text" class="form-control" required>
						<div class="invalid-feedback">
							Por favor ingrese el origen y destino.
						</div>
					</div>
				</div>
			</div>
			<!-- Hora De Salida -->
			<div class="container text-black w-80"><br>
				<div class="form-group row">
					<label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Hora de salida</label>
					<div class="col-12 col-6">
						<input name="date" type="time" class="form-control" required>
						<div class="invalid-feedback">
							Por favor ingrese la hora del servicio
						</div>
					</div>
				</div>
			</div>
			<br>
			<!-- - - - - - - - - - Exterior- - - - - - - - - -->
			<div class="col-12 col-6 accordion mt-3" id="conceptoEstadoAccordion">
				<div class="card">
					<div class="card-header bg-light" id="conceptoEstadoHeading">
						<h2 class="mb-0">
							<button class="btn btn-link btn-block btn-block text-dark text-center" type="button" data-toggle="collapse" data-target="#conceptoEstadoCollapse" aria-expanded="false" aria-controls="conceptoEstadoCollapse">
								<i class="fas fa-chevron-down mr-2"></i> Exterior
							</button>
						</h2>
					</div>

					<div id="conceptoEstadoCollapse" class="collapse" aria-labelledby="conceptoEstadoHeading" data-parent="#conceptoEstadoAccordion">
						<div class="card-body">

							<!-- Aseo General -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Aseo General: Sin polvo,lodo </label>
								<div class="col-sm-5">
									<select name="selectaseo" class="form-control" id="colFormLabel" required>
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--laminas-puertas -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Láminas/Puertas: Sin golpes, rayones - abren o cierran por dentro y por fuera</label>
								<div class="col-sm-5">
									<select name="selectpuertas" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Estado de llantas -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Estado de llantas: Sin golpes, deformación ni desgaste excesivo - pernos completos</label>
								<div class="col-sm-5">
									<select name="selectllantas" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- faros -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Faros delanteros/traseros: Sin agua, ni golpes o fisuras</label>
								<div class="col-sm-5">
									<select name="selectfaros" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Vidrios Ventanas -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Vidrios - ventanas - limpiabrisas: Sin rayones ni fisuras - limpiabrisas funcional</label>
								<div class="col-sm-5">
									<select name="selectvidrios" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- retrovisores -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Espejos retrovisores: Estables, sin roturas ni fisuras</label>
								<div class="col-sm-5">
									<select name="selectretro" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- extintor -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Vencimiento Extintor-Válvula-Manómetro: Estables, sin roturas ni fisuras</label>
								<div class="col-sm-5">
									<select name="selectextintor" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- exosto -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Exosto: Sin fisuras</label>
								<div class="col-sm-5">
									<select name="selectexosto" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Luces -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">
									Luces delanteras - traseras - direccionales - freno - reversa: Deben encender todas las luces bajas, medias, altas, direccionales, parqueo, freno y reversa
								</label>
								<div class="col-sm-5">
									<select name="selectluces" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- - - - - - - - - - Interior- - - - - - - - - -->
			<div class="col-12 col-6 accordion mt-3" id="interiorAccordion">
				<div class="card">
					<div class="card-header bg-light" id="interiorHeading">
						<h2 class="mb-0">
							<button class="btn btn-link btn-block btn-block text-dark text-center" type="button" data-toggle="collapse" data-target="#interiorCollapse" aria-expanded="false" aria-controls="interiorCollapse">
								<i class="fas fa-chevron-down mr-2"></i>Interior
							</button>
						</h2>
					</div>

					<div id="interiorCollapse" class="collapse" aria-labelledby="interiorHeading" data-parent="#interiorAccordion">
						<div class="card-body">
							<!-- Tablero-testigos -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Tablero - testigos: Los testigos deben encender</label>
								<div class="col-sm-5">
									<select name="selecttestigos" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Mandos, pedales-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Mandos - pedales: Deben estar fijos y funcionales</label>
								<div class="col-sm-5">
									<select name="selectpedales" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Barra de cambios-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Barra de cambios: Debe estar fijo y funcional</label>
								<div class="col-sm-5">
									<select name="selectcaja" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Freno-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Freno: Sistema de frenado sin longitud excesiva</label>
								<div class="col-sm-5">
									<select name="selectfreno" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Freno de parqueo-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Freno de parqueo: Debe estar fijo y funcional</label>
								<div class="col-sm-5">
									<select name="selectparqueo" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Sillas-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Sillas -Ventanas - Vidrios: Firmes sin vibraciones</label>
								<div class="col-sm-5">
									<select name="selectsillas" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Cinturones de seguridad-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Cinturones de seguridad, hebillas y candados: Un cinturón por silla, sin desgaste. La hebila debe enganchar con el candado</label>
								<div class="col-sm-5">
									<select name="selectcinturones" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Salidas de emergencia-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Salidas de emergencia: Rotuladas para fácil identficación, martillo en cada salida de emergencia</label>
								<div class="col-sm-5">
									<select name="selectemer" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Espejos internos -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Espejos retrovisores internos: Estables, uno en el centro, sin roturas ni fisuras</label>
								<div class="col-sm-5">
									<select name="selectespejos" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Bocina -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Bocinas: Debe sonar y escucharse a 50 mts de distancia</label>
								<div class="col-sm-5">
									<select name="selectbocina" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- pito reversa -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Pito de reversa: Debe sonar cuando se active el cambio a reversa</label>
								<div class="col-sm-5">
									<select name="selectpitorever" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- equipo prevencion y seguridad -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Equipo de prevención y seguridad: Botiquin, gato, cruceta, triángulos, tacos, herramientas y linterna</label>
								<div class="col-sm-5">
									<select name="selectbotiquin" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Aire  -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Sistema de Aire: Aire acondicionado funcional - cuando aplique</label>
								<div class="col-sm-5">
									<select name="selectaire" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- - - - - - - - - - motor- - - - - - - - - -->
			<div class="col-12 col-6 accordion mt-3" id="motorAccordion">
				<div class="card">
					<div class="card-header bg-light" id="motorHeading">
						<h2 class="mb-0">
							<button class="btn btn-link btn-block btn-block text-dark text-center" type="button" data-toggle="collapse" data-target="#motorCollapse" aria-expanded="false" aria-controls="motorCollapse">
								<i class="fas fa-chevron-down mr-2"></i>Motor
							</button>
						</h2>
					</div>

					<div id="motorCollapse" class="collapse" aria-labelledby="motorHeading" data-parent="#motorAccordion">
						<div class="card-body">
							<!-- Líquido de frenos -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Líquido de frenos: A nivel de depósito, sin fuga</label>
								<div class="col-sm-5">
									<select name="selectliqfreno" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!-- Aceite de Motor -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Aceite de Motor: A nivel de la aguja y sin impurezas, sin fuga</label>
								<div class="col-sm-5">
									<select name="selectacemotor" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--Líquido de embrague -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Líquido de embrague: A nivel establecido en el depósito, sin fuga</label>
								<div class="col-sm-5">
									<select name="selectliqembrague" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--refrigetante -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Refrigerante: A nivel establecido en el depósito, sin fuga</label>
								<div class="col-sm-5">
									<select name="selectrefri" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--Líquido de dirección -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Líquido de dirección: En el nivel establecido en el depósito, sin fuga</label>
								<div class="col-sm-5">
									<select name="selectliqdir" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--Líquido limpiabrisas -->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Líquido limpiabrisas: En el nivel establecido en el depósito, sin fuga</label>
								<div class="col-sm-5">
									<select name="selectlimpia" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--Correas-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Correas: Estado estandar en ambas caras y tensión</label>
								<div class="col-sm-5">
									<select name="selectcorreas" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--Mangueras-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Mangueras: Sin roturas ni desgaste, conectadas con abrazaderas</label>
								<div class="col-sm-5">
									<select name="selectmangueras" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--Cableado-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Cableado: Sin desgaste y conectados</label>
								<div class="col-sm-5">
									<select name="selectcables" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
							<!--Bateria-->
							<div class="form-group row">
								<label for="colFormLabel" class="col-12 col-md-6 col-form-label text-center">Batería: Con soporte, sin corrosión, bornes sin sulfatar y conectados</label>
								<div class="col-sm-5">
									<select name="selectbaterias" class="form-control" required id="colFormLabel">
										<option value="">Seleccione...</option>
										<option value="Bueno">Bueno</option>
										<option value="Malo">Malo</option>
									</select>
									<div class="invalid-feedback">
										Por favor seleccione una opción.
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- Observaciones -->
			<div class="container mt-3"><br>
				<div class="form-group row">
					<label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Observaciones</label>
					<div class="col-12 col-6">
						<textarea name="observaciones" rows="3" class="form-control" id="exampleFormControlTextarea1"></textarea>
					</div>
				</div>
			</div>
			<!-- Responsable Revisión -->
			<div class="container mt-3 mb-8"><br>
				<div class="form-group row">
					<label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Responsable de la revisión</label>
					<div class="col-12 col-6">
						<input name="responsable" type="text" class="form-control" required>
						<div class="invalid-feedback">
							Por favor ingrese el responsble de la revisión.
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-6 container text-black bg-green w-80 mt-8">
				<div class="row">
					<div class="col">
						<h3 class="bg-success text-white p-2 mb-3 text-center">Imágenes</h3>
					</div>
				</div>
			</div>
			<div class="container mt-2">
				<div class="form-group row">
					<label for="exampleFormControlFile1" class="col-12 col-6 col-form-label text-left">Imagen Frontal</label>
					<div class="col-sm-8">
						<input name="imagen" type="file" class="form-control-file" id="imagen" required>
						<div class="invalid-feedback">
						Por favor seleccione una imagen.
					</div>
					</div>

				</div>
				<div class="form-group row">
					<label for="exampleFormControlFile1" class="col-12 col-6 col-form-label text-left">Imagen Lateral 1</label>
					<div class="col-sm-8">
						<input name="imagenlat" type="file" class="form-control-file" required id="imagenlat">
						<div class="invalid-feedback">
						Por favor seleccione una imagen.
					</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="exampleFormControlFile1" class="col-12 col-6 col-form-label text-left">Imagen Lateral 2</label>
					<div class="col-sm-8">
						<input name="imagenlat1" type="file" class="form-control-file" required id="imagenlat1">
						<div class="invalid-feedback">
						Por favor seleccione una imagen.
					</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="exampleFormControlFile1" class="col-12 col-6 col-form-label text-left">Imagen Posterior</label>
					<div class="col-sm-8">
						<input name="posterior" type="file" class="form-control-file" required id="posterior">
						<div class="invalid-feedback">
						Por favor seleccione una imagen.
					</div>
					</div>
				</div>
			</div><br>

			<div class="col-12 col-6 row d-flex justify-content-center">
				<div class="form-group mx-sm-4">
					<button type="submit" class="btn btn-success btn-lg">Enviar</button>
					<button type="reset" class="btn btn-success btn-lg">Borrar</button>
					<input name="action" type="hidden" value="upload" />
				</div>
			</div>
		</form>
	</div>


	</div>
	</div>

	</div>
	</div>
	</div>

	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict';

			window.addEventListener('load', function() {
				var form = document.getElementById('needs-validation');
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			}, false);
		})();
	</script>

	<!-- Optional JavaScript -->
	<script src="js/jquery-1.12.3.js"></script>
	<script src="js/jquery-1.12.3.min.js"></script>
	<script src="js/jquery.vide.min.js"></script>
	<script src="js/jquery.vide.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>



	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>