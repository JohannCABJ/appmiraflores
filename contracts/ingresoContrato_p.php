<? include("../login/seguridad.php"); ?>
<!DOCTYPE html>
<h5>
  <font face='Arial Narrow'> Usuario: <? echo $_SESSION["usuarioactual"] ?> </font>
</h5>
<h5>
  <font face='Arial Narrow'> <a href="../login/salir.php">Salir</a></font>
</h5>
<html lang="es">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div align="center"> <img src="../images/logo.jpg" width="200" height="80" />

  <header>
    <title>Ingreso de contrato prestacion de servicio</title>
    <font face='Arial Narrow' size="+1"> <b> </b> </font>
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

      div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
      }
    </style>
  </header>

  <body>
    <h3>A continuacion debera diligenciar la totalidad de los campos para el registro del contrato </h3>
    <div>
      <form action="insertContract.php" method="post" name="form1" id="form1">
        <label for="contratante">Nombre Contratante</label>
        <input type="text" id="contratante" name="contratante" maxlength="52" placeholder="Ingrese nombre contratante.." required>

        <label for="idcontratante">Identificacion Contratante</label>
        <input type="text" id="idcontratante" name="idcontratante" maxlength="12" placeholder="NIT O CC de contratante.." required>

        <label for="objeto">Objeto del Contrato</label>
        <select id="objeto" name="objeto" required>
          <option value="">Seleccione...</option>
          <option value="GRUPO ESPECIFICO DE USUARIOS">Grupo Especifico de usuarios</option>
          <option value="TRANSPORTE EMPRESARIAL">Transporte Empresarial</option>
          <option value="TRANSPORTE DE TURISTAS">Transporte de Turistas</option>
          <option value="TRANSPORTE DE ESTUDIANTES">Transporte de Estudiantes</option>
          <option value="TRANSPORTE USUARIOS SERVICIO DE SALUD">Transporte de usuarios servicio de salud </option>
        </select>

        <label for="responsable">Responsable del Contratante</label>
        <input type="text" id="responsable" name="responsable" maxlength="30" placeholder="Nombre resppnsable del contratante.." required>

        <label for="idresponsable">Identificacion del Responsable del Contratante</label>
        <input type="text" id="idresponsable" name="idresponsable" maxlength="12" placeholder="Identificacion resppnsable del contratante.." required>

        <label for="direccioncontratante">Dirección Contratante</label>
        <input type="text" id="direccioncontratante" name="direccioncontratante" maxlength="17" placeholder="Direccion del contratante.." required>

        <label for="telefonocontratante">Telefono Contratante</label>
        <input type="text" id="telefonocontratante" name="telefonocontratante" maxlength="12" placeholder="No. Telefono resppnsable del contratante.." required>

        <label for="origendestino">Origen-Destino</label>
        <input type="text" id="origendestino" name="origendestino" maxlength="187" placeholder="Ingrese el recorrido.." required>

        <label for="valorfuec">Valor del Servicio</label>
        <input type="text" id="valorfuec" name="valorfuec" maxlength="12" placeholder="Valor del FUEC.." required>

    </div>

    <tr>
      <td align="center" valign="middle" bgcolor="#ECECEC">
        <p class="style3">
          <font face="Arial Narrow" style="text-align: left">Fecha Inicio Recorrido </font>
        </p>
      </td>
      <td height="32" width="455" align="center" valign="middle" bgcolor="#ECECEC">
        <h4 class="style3">
          <input type="date" name="fechainicial" id="fechainicial" required min="<?php echo date("Y-m-d", strtotime(date("Y-m-d"))); ?>">
        </h4>
      </td>
    </tr>
    <tr>
      <td height="18">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="middle" bgcolor="#ECECEC">
        <p class="style3">
          <font face="Arial Narrow">Fecha Final Recorrido </font>
        </p>
      </td>
      <td height="33" align="center" valign="middle" bgcolor="#ECECEC">
        <h4 class="style3">
          <span style="text-align: left"></span>
          <span style="text-align: left"></span>
          <span style="text-align: left"></span>
          <span style="text-align: left"></span>
          <input type="date" name="fechafinal" id="fechafinal" required min="<?php echo date("Y-m-d", strtotime(date("Y-m-d"))); ?>">
        </h4>
      </td>
    </tr>
    <tr>
      <td height="72" colspan="2">
        <div align="center"><strong>
            <font face="Arial Narrow">INFORMACI&Oacute;N DEL VEH&Iacute;CULO </font>
          </strong></div>
      </td>
    </tr>
    <tr>
      <td height="32">
        <font face="Arial Narrow">Placa</font>
      </td>
      <td>
        <?php
        //mysql_connect("localhost", "emestour","iwzuFbboUfNeX246uJ") or die(mysql_error());
        //mysql_select_db("emestour_Solicitudes") or die(mysql_error());

        //
        ?>
        <?php
        include 'Funciones.php';
        ?>
        <?php
        $con = conectar();

        $dat = "SELECT * FROM tblVencimientos WHERE Estado LIKE 'ACTIVO' ORDER BY Placa ASC";
        $sql = mysqli_query($con, $dat);
        ?>

        <select name="placa">
          <option value="">Seleccione...</option>
          <?php

          while ($lista = mysqli_fetch_array($sql))
            echo "<option  value='" . $lista["Placa"] . "'>" . $lista["Placa"] . "</option>";

          ?>

        </select>
      </td>
    </tr>
    <input type="submit" name="Submit" value="Generar Codigo">

    </form>
  </body>

</html>