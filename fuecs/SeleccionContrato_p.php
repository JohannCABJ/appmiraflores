<!DOCTYPE html>
<html lang="es">
<link rel="shortcut icon" href="Favicon.png">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div align="center"> <img src="https://i.ibb.co/ynPGDxL/logo.png" width="200" height="80" />
  <header>
    <title>Seleccion Contrato para generar FUEC</title>
    <script>
      function nav(value) {
        if (value != "") {
          location.href = value;
        }
      }
    </script>
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
    <h3>Seleccione el contrato para generar el FUEC </h3>
    <div>
      <form method="post" action="">
        <p>
          <select name="select" size="1" select style="FONT-SIZE: 14px; COLOR: #000000; BACKGROUND-COLOR: rgb(255,255,255)" onChange="window.open(this.options[this.selectedIndex].value,'_self')" required>
            <option value="">Seleccione...</option>
            <option value="PruebaContrato_pOcasional.php">Ocasional</option>
            <!--  <option value="PruebaContrato_pOmia.php">Omia</option>
              <!-- <option value="PruebaContrato_pOcasional.php">Ocasional</option>
              <!-- <option value="PruebaContrato_pAgrosavia.php">Agrosavia</option>
              <!-- <option value="PruebaContrato_pStork.php">Stork</option>
              <!-- <option value="PruebaContrato_pLiceo.php">Liceo Colombia</option>
              <!-- <option value="PruebaContrato_pAlcaldiaRovira.php">Alcaldia de Rovira</option>
              <!--<option value="PruebaContrato_pCoomeva.php">Coomeva</option>
        <!--<option value="PruebaContrato_pNevadoTour.php">Nevado Tour</option>        	    
        <!--<option value="PruebaContrato_pElectro.php">Electolineas</option>
        <!-- <option value="PruebaContrato_pComfenalco.php">Comfenalco</option> -->
            <!-- <option value="PruebaContrato_pC&MA.php">CYMA</option> -->
            <!-- <option value="PruebaContrato_pVector.php">Vector Geophysical</option> -->
            <!-- <option value="PruebaContrato_pMBS.php">MBS</option> -->
            <!-- <option value="PruebaContrato_pCeym.php">CEYM Compania electrica mecanica</option>-->
          </select>
        </p>
        <p>&nbsp;</p>
    </div>
    </form>
  </body>

</html>