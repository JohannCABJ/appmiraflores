<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div align="center"> <img src="https://i.ibb.co/ynPGDxL/logo.png" width="200" height="80" />
  <header>
    <title>Generacion de FUEC</title>
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
    <h3>A continuacion debera diligenciar la totalidad de los campos para la asignacion del codigo del FUEC </h3>
    <div>
      <form action="PruebaContratoOcasional.php" method="post" name="form1" id="form1">
        <label for="contratante">Nombre Contratante</label>
        <input type="text" id="contratante" name="contratante" maxlength="60" placeholder="Ingrese nombre contratante.." required>

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

        <label for="responsable">Nombre Contratante</label>
        <input type="text" id="responsable" name="responsable" maxlength="30" placeholder="Nombre resppnsable del contratante.." required>

        <label for="idresponsable">Identificacion Contratante</label>
        <input type="text" id="idresponsable" name="idresponsable" maxlength="12" placeholder="Identificacion resppnsable del contratante.." required>

        <label for="direccioncontratante">Dirección Contratante</label>
        <input type="text" id="direccioncontratante" name="direccioncontratante" maxlength="21" placeholder="Direccion del contratante.." required>

        <label for="telefonocontratante">Telefono Contratante</label>
        <input type="text" id="telefonocontratante" name="telefonocontratante" maxlength="12" placeholder="No. Telefono resppnsable del contratante.." required>

        <label for="origendestino">Origen-Destino</label>
        <input type="text" id="origendestino" name="origendestino" maxlength="230" placeholder="Ingrese el recorrido.." required>

        <label for="totalkm">Total Km. del recorrido</label>
        <input type="text" id="totalkm" name="totalkm" maxlength="4" placeholder="Ingrese el Km total del recorrido.." required>

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
          <input type="date" name="fechainicial" id="fechainicial" required>
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
          <input type="date" name="fechafinal" id="fechafinal" required>
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
        include '../config/Funciones.php';
        ?>
        <?php
        $con = conectar();

        $dat = "SELECT Placa FROM tblVencimientos WHERE Estado LIKE 'ACTIVO' ORDER BY Placa ASC";
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
    <tr>
      <td height="59" colspan="2">
        <div align="center"><strong>
            <font face="Arial Narrow">INFORMACION DE CONDUCTORES </font>
          </strong></div>
      </td>
    </tr>
    <tr>
      <td height="59">
        <font face="Arial Narrow">Identificaci&oacute;n Conductor 1 </font>
      </td>
      <td height="59"><label>
          <?php
          //$con=conectar();
          //$dat1="SELECT * FROM tblConductores WHERE EstadoLaboral LIKE 'ACTIVO'";
          //$sql1=mysqli_query($con,$dat1);
          //
          ?>
        </label>
        <?php
        $con = conectar();
        $dat2 = "SELECT * FROM tblConductores WHERE EstadoLaboral LIKE 'ACTIVO' ORDER BY Nombre ASC ";
        $sql2 = mysqli_query($con, $dat2);
        ?>

        <select name="cedulac1" id="cedulac1" required>
          <option value="">Seleccione...</option>
          <?php

          while ($lista2 = mysqli_fetch_array($sql2))
            echo "<option  value='" . $lista2["IdConductor"] . "'>" . $lista2["Nombre"] . " " . $lista2["Apellidos"] . "</option>";

          ?>

        </select>
        <label></label>
      </td>
    </tr>
    <tr>
      <td height="59">
        <font face="Arial Narrow">Identificaci&oacute;n Conductor 2 </font>
      </td>
      <td height="59"><label>
          <?php
          $dat2 = "SELECT * FROM tblConductores WHERE EstadoLaboral LIKE 'ACTIVO' ORDER BY Nombre ASC ";
          $sql2 = mysqli_query($con, $dat2);
          ?>

          <select name="cedulac2" id="cedulac2">
            <option value="0">Seleccione...</option>
            <?php

            while ($lista2 = mysqli_fetch_array($sql2))
              echo "<option  value='" . $lista2["IdConductor"] . "'>" . $lista2["Nombre"] . " " . $lista2["Apellidos"] . "</option>";

            ?>

          </select>
        </label></td>
    </tr>
    <tr>
      <td height="59">
        <font face="Arial Narrow">Identificaci&oacute;n Conductor 3</font>
      </td>
      <td height="59"><label>
          <?php
          $dat3 = "SELECT * FROM tblConductores WHERE EstadoLaboral LIKE 'ACTIVO' ORDER BY Nombre ASC ";
          $sql3 = mysqli_query($con, $dat3);
          ?>

          <select name="cedulac3" id="cedulac3">
            <option value="0">Seleccione...</option>
            <?php

            while ($lista3 = mysqli_fetch_array($sql3))
              echo "<option  value='" . $lista3["IdConductor"] . "'>" . $lista3["Nombre"] . " " . $lista3["Apellidos"] . "</option>";

            ?>
          </select>

          <input type="submit" name="Submit" value="Generar Codigo">

          </form>
  </body>

</html>