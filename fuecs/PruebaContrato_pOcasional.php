<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div align="center"> <img src="https://i.ibb.co/ynPGDxL/logo.png" width="200" height="80" />

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generación de FUEC</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  </head>

  <body>
    <?php
    include '../config/Funciones.php';
    ?>
    <?php
    $con = conectar();

    $dat = "SELECT Placa FROM tblVencimientos WHERE Estado LIKE 'ACTIVO' ORDER BY Placa ASC";
    $sql = mysqli_query($con, $dat);
    ?>
    <div class="container text-black  w-80"><br>
      <div class="form-group row">
        <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">A continuación deberá diligenciar la totalidad de los campos para la generación del FUEC</label>
      </div>
    </div>
    <div class="container mt-5">
      <form action="PruebaContratoOcasional.php" method="post" name="form1" id="needs-validation" novalidate>
        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Nombre Contratante</label>
            <div class="col-12 col-6">
              <input type="text" id="contratante" name="contratante" class="form-control" maxlength="60" placeholder="Ingrese nombre contratante.." required>
              <div class="invalid-feedback">
                Ingrese nombre del contratante
              </div>
            </div>
          </div>
        </div>
        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Identificacion Contratante</label>
            <div class="col-12 col-6">
              <input type="text" id="idcontratante" name="idcontratante" maxlength="12" class="form-control" placeholder="NIT O CC de contratante.." required>
              <div class="invalid-feedback">
                Ingrese NIT o cedula del contratante
              </div>
            </div>
          </div>
        </div>
        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Objeto del Contrato</label>
            <div class="col-12 col-6">
              <select class="col-12 col-6" id="objeto" name="objeto" required>
                <option value="">Seleccione...</option>
                <option value="GRUPO ESPECIFICO DE USUARIOS">Grupo Especifico de usuarios</option>
                <option value="TRANSPORTE EMPRESARIAL">Transporte Empresarial</option>
                <option value="TRANSPORTE DE TURISTAS">Transporte de Turistas</option>
                <option value="TRANSPORTE DE ESTUDIANTES">Transporte de Estudiantes</option>
                <option value="TRANSPORTE USUARIOS SERVICIO DE SALUD">Transporte de usuarios servicio de salud </option>
              </select>
              <div class="invalid-feedback">
                Por favor seleccione el objeto del contrato.
              </div>
            </div>
          </div>
        </div>
        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Nombre Contratante</label>
            <div class="col-12 col-6">
              <input class="form-control" type="text" id="responsable" name="responsable" maxlength="30" placeholder="Nombre responsable del contratante.." required>
              <div class="invalid-feedback">
                Por favor ingrese el origen y destino.
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Identificacion Contratante</label>
            <div class="col-12 col-6">
              <input class="form-control" type="text" id="idresponsable" name="idresponsable" maxlength="12" placeholder="Identificacion responsable del contratante.." required>
              <div class="invalid-feedback">
                Por favor ingrese la identificacion del contratante
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Dirección Contratante</label>
            <div class="col-12 col-6">
              <input class="form-control" type="text" id="direccioncontratante" name="direccioncontratante" maxlength="21" placeholder="Direccion del contratante.." required>
              <div class="invalid-feedback">
                Por favor ingrese la dirección del contratante
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="telefonocontratante" class="col-12 col-6 col-form-label text-center">Telefono Contratante</label>
            <div class="col-12 col-6">
              <input class="form-control" type="text" id="telefonocontratante" name="telefonocontratante" maxlength="12" placeholder="No. Telefono responsable del contratante.." required>
              <div class="invalid-feedback">
                Por favor ingrese la dirección del contratante
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="origendestino" class="col-12 col-6 col-form-label text-center">Origen-Destino</label>
            <div class="col-12 col-6">
              <input class="form-control" type="text" id="origendestino" name="origendestino" maxlength="230" placeholder="Ingrese el recorrido.." required>
              <div class="invalid-feedback">
                Por favor ingrese el origen y destino
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label for="totalkm" class="col-12 col-6 col-form-label text-center">Total Km. del recorrido</label>
            <div class="col-12 col-6">
              <input class="form-control" type="text" id="totalkm" name="totalkm" maxlength="4" placeholder="Ingrese el Km total del recorrido.." required>
              <div class="invalid-feedback">
                Por favor ingrese el kilometraje
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label class="col-12 col-6 col-form-label text-center" for="valorfuec">Valor del Servicio</label>
            <div class="col-12 col-6">
              <input class="form-control" type="text" id="valorfuec" name="valorfuec" maxlength="12" placeholder="Valor del servicio" required>
              <div class="invalid-feedback">
                Por favor ingrese el valor del servicio
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label class="col-12 col-6 col-form-label text-center" for="fechainicial">Fecha Incial del recorrido</label>
            <div class="col-12 col-6">
              <input class="form-control" type="date" name="fechainicial" id="fechainicial" required>
              <div class="invalid-feedback">
                Por favor seleccione la fecha inicial
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <label class="col-12 col-6 col-form-label text-center" for="fechafinal">Fecha Final del recorrido</label>
            <div class="col-12 col-6">
              <input class="form-control" type="date" name="fechafinal" id="fechafinal" required>
              <div class="invalid-feedback">
                Por favor seleccione la fecha final
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-6 container text-black bg-green w-80 mt-8">
          <div class="row">
            <div class="col">
              <h3 class="bg-success text-white p-2 mb-3 text-center">Información del vehículo</h3>
            </div>
          </div>
        </div>

        <div class="container text-black  w-60"><br>
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

        <div class="col-12 col-6 container text-black bg-green w-80 mt-8">
          <div class="row">
            <div class="col">
              <h3 class="bg-success text-white p-2 mb-3 text-center">Información de conductores</h3>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <?php
            $con = conectar();
            $dat2 = "SELECT * FROM tblConductores WHERE EstadoLaboral LIKE 'ACTIVO' ORDER BY Nombre ASC ";
            $sql2 = mysqli_query($con, $dat2);
            ?>
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Seleccione Conductor 1</label>
            <div class="col-12 col-6">
              <select class="col-12 col-6" name="cedulac1" id="cedulac1" required>
                <option value="">Seleccione...</option>
                <?php
                while ($lista2 = mysqli_fetch_array($sql2))
                  echo "<option  value='" . $lista2["IdConductor"] . "'>" . $lista2["Nombre"] . " " . $lista2["Apellidos"] . "</option>";
                ?>
              </select>
              <div class="invalid-feedback">
                Por favor seleccione el conductor.
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <?php
            $dat2 = "SELECT * FROM tblConductores WHERE EstadoLaboral LIKE 'ACTIVO' ORDER BY Nombre ASC ";
            $sql2 = mysqli_query($con, $dat2);
            ?>
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Seleccione Conductor 2</label>
            <div class="col-12 col-6">
              <select class="col-12 col-6" name="cedulac2" id="cedulac2">
                <option value="0">Seleccione...</option>
                <?php
                while ($lista2 = mysqli_fetch_array($sql2))
                  echo "<option  value='" . $lista2["IdConductor"] . "'>" . $lista2["Nombre"] . " " . $lista2["Apellidos"] . "</option>";
                ?>
              </select>
              <div class="invalid-feedback">
                Por favor seleccione el conductor.
              </div>
            </div>
          </div>
        </div>

        <div class="container text-black  w-80"><br>
          <div class="form-group row">
            <?php
            $dat3 = "SELECT * FROM tblConductores WHERE EstadoLaboral LIKE 'ACTIVO' ORDER BY Nombre ASC ";
            $sql3 = mysqli_query($con, $dat3);
            ?>
            <label for="colFormLabel" class="col-12 col-6 col-form-label text-center">Seleccione Conductor 3</label>
            <div class="col-12 col-6">
              <select class="col-12 col-6" name="cedulac3" id="cedulac3">
                <option value="0">Seleccione...</option>
                <?php
                while ($lista3 = mysqli_fetch_array($sql3))
                  echo "<option  value='" . $lista3["IdConductor"] . "'>" . $lista3["Nombre"] . " " . $lista3["Apellidos"] . "</option>";
                ?>
              </select>
              <div class="invalid-feedback">
                Por favor seleccione el conductor.
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-6 row d-flex justify-content-center">
				<div class="form-group mx-sm-4">
					<button type="submit" class="btn btn-success btn-lg">Generar FUEC</button>
					<button type="reset" class="btn btn-success btn-lg">Borrar</button>
					<input name="action" type="hidden" value="upload" />
				</div>
			</div>
      </form>
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