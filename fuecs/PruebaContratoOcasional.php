<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div align="center"> <img src="https://i.ibb.co/ynPGDxL/logo.png" width="200" height="80" />
  <link rel="shortcut icon" href="Favicon.png">
  <h5>
    <font face='Arial Narrow'> Usuario: <? echo $_SESSION["usuarioactual"] ?> </font>
  </h5>
  <h5>
    <font face='Arial Narrow'> <a href="salir.php">Cerrar sesión</a></font>
  </h5>
  <style type="text/css">
    .style3 {
      color: #FFFFFF;
      font-family: "Arial Narrow";
    }

    .style5 {
      color: #FFFFFF;
      font-weight: bold;
      font-family: "Arial Narrow";
    }

    .style6 {
      font-family: "Arial Narrow";
      font-weight: bold;
    }

    .style9 {
      color: #7EC242;
      font-weight: bold;
      font-family: "Arial Narrow";
    }

    -->
  </style>
  <header>
    <title>Generación de FUEC</title>
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
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  ?>

  <body>
    <h3>Confirmación asignacion del codigo del FUEC </h3>
    <p>
      <?php
      include '../config/Funciones.php';
      ?>

      <?php
      $con = conectar();
      $sql = "SELECT * FROM tblVencimientos WHERE Placa='" . $_POST['placa'] . "'";
      $sql2 = "SELECT * FROM tblConductores WHERE IdConductor= '" . $_POST['cedulac1'] . "'";
      $sql3 = "SELECT * FROM tblConductores WHERE IdConductor= '" . $_POST['cedulac2'] . "'";
      $sql4 = "SELECT * FROM tblConductores WHERE IdConductor= '" . $_POST['cedulac3'] . "'";
      $sql5 = "SELECT * FROM tblAlistamiento WHERE Placa = '" . $_POST['placa'] . "' ORDER BY IdProtocolo DESC LIMIT 1";

      $result = mysqli_query($con, $sql);
      $result2 = mysqli_query($con, $sql2);
      $result3 = mysqli_query($con, $sql3);
      $result4 = mysqli_query($con, $sql4);
      $result5 = mysqli_query($con, $sql5);

      if (mysqli_num_rows($result) == 0) {
        die("El número de placa " . $_POST['placa'] . " no existe actualmente en nuestro parque automotor <br><br> <a href=\"PruebaContrato_p.php\"> Intenta nuevamente </a>");
      } elseif (mysqli_num_rows($result2) == 0) {
        die("El conductor identificado con número de cédula1 " . $_POST['cedulac1'] . " no existe actualmente en nuestros registros <br><br> <a href=\"PruebaContrato_p.php\"> Intenta nuevamente </a>");
      } elseif (mysqli_num_rows($result3) == 0) {
        die("El conductor identificado con número de cédula2 " . $_POST['cedulac2'] . " no existe actualmente en nuestros registros <br><br> <a href=\"PruebaContrato_p.php\"> Intenta nuevamente </a>");
      } elseif (mysqli_num_rows($result4) == 0) {
        die("El conductor identificado con número de cédula3 " . $_POST['cedulac3'] . " no existe actualmente en nuestros registros <br><br> <a href=\"PruebaContrato_p.php\"> Intenta nuevamente </a>");
      }

      // verificamos que no haya error
      while ($row = mysqli_fetch_assoc($result)) {
        $row2 = mysqli_fetch_assoc($result2);
        $row3 = mysqli_fetch_assoc($result3);
        $row4 = mysqli_fetch_assoc($result4);
        $row5 = mysqli_fetch_assoc($result5);

        $fechaactual = $_POST['fechainicial'];
        $fechafinal = $_POST['fechafinal'];
        $fechadiff = strtotime($fechafinal) - strtotime($fechaactual);
        $dias = $fechadiff / (60 * 60 * 24);

        if (($dias) > 30) {
          die("Lo sentimos, el FUEC no pude ser elaborado con una vigencia mayor a 30 dias, en este momento intenta generar un FUEC por $dias dias");
        }
        if (strtotime($fechaactual) > strtotime($fechafinal)) {
          die("La fecha final del servicio no puede ser anterior a la fecha inicial");
        }

        $placaform = $row['Placa'];
        $fechaevento = $row['Tecno'];
        $fechaevento1 = $row['Soat'];
        $fechaevento2 = $row["Operacion"];
        $fechaevento3 = $row["Contractual"];
        $fechaevento4 = $row["Extracontractual"];
        $clase = $row["Clase"];
        $modelo = $row["Modelo"];
        $marca = $row["Marca"];
        $interno = $row["Interno"];
        $operation = $row["TarjetaOp"];
        $capacity = $row["Capacidad"];
        $convenio = $row["Convenio"];
        $Mtto = $row["MttoPrev"];
        $Ultimokm = $row["UltimoKmAceite"];
        $KmActual = $row["KmActual"];
        $kmParaCambiar84 = $row['CambioAceiteFijo'];
        $venlicencia1 = $row2["VencimientoLicencia"];
        $tipolicencia1 = $row2["TipoLicencia"];
        $tipolicencia2 = $row2["TipoLicencia"];
        $drivername2 = $row2["Nombre"];
        $driverlastname = $row2["Apellidos"];
        $driverfullname2 = $drivername2 . "\r" . $driverlastname;
        $tipolicencia3 = $row2["TipoLicencia"];
        $idconductor1  = $row2["IdConductor"];
        $simit1  = $row2["SIMIT"];
        $runt1  = $row2["RUNT"];
        $idconductor2  = $row3["IdConductor"];
        $drivername3 = $row3["Nombre"];
        $driverlastname3 = $row3["Apellidos"];
        $driverfullname3 = $drivername3 . "\r" . $driverlastname3;
        $tipolicencia3 = $row3["TipoLicencia"];
        $simit2  = $row3["SIMIT"];
        $runt2  = $row3["RUNT"];
        $drivername4 = $row4["Nombre"];
        $driverlastname4 = $row4["Apellidos"];
        $driverfullname4 = $drivername4 . "\r" . $driverlastname4;
        $venlicencia2 = $row3["VencimientoLicencia"];
        $idconductor3  = $row4["IdConductor"];
        $venlicencia3 = $row4["VencimientoLicencia"];





        $simit3  = $row4["SIMIT"];


        $runt3  = $row4["RUNT"];
        $estadoPA  = $row5["Activo"];

        $licencesc1 = array("A1", "A2", "A3", "B1", "B2", "B3");
        $licencesc2 = array("A1", "A2", "A3", "B1", "B2", "B3", "C1");

        if ($clase == "MICROBUS") {
          if (in_array($tipolicencia1, $licencesc1)) {
            die("Lo sentimos el conductor identificado con " . $idconductor1 . " tiene una licencia " . $tipolicencia1 . " y debe contar con una licencia C1, C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "CAMIONETA") {
          if (in_array($tipolicencia1, $licencesc1)) {
            die("Lo sentimos el conductor identificado con " . $idconductor1 . " tiene una licencia " . $tipolicencia1 . " y debe contar con una licencia C1, C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "BUSETA") {
          if (in_array($tipolicencia1, $licencesc2)) {
            die("Lo sentimos el conductor identificado con " . $idconductor1 . " tiene una licencia " . $tipolicencia1 . " y debe contar con una licencia C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "BUS") {
          if (in_array($tipolicencia1, $licencesc2)) {
            die("Lo sentimos el conductor identificado con " . $idconductor1 . " tiene una licencia " . $tipolicencia1 . " y debe contar con una licencia C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        }
        if ($clase == "MICROBUS") {
          if (in_array($tipolicencia2, $licencesc1)) {
            die("Lo sentimos el conductor identificado con " . $idconductor2 . " tiene una licencia " . $tipolicencia2 . " y debe contar con una licencia C1, C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "CAMIONETA") {
          if (in_array($tipolicencia2, $licencesc1)) {
            die("Lo sentimos el conductor identificado con " . $idconductor2 . " tiene una licencia " . $tipolicencia2 . " y debe contar con una licencia C1, C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "BUSETA") {
          if (in_array($tipolicencia2, $licencesc2)) {
            die("Lo sentimos el conductor identificado con " . $idconductor2 . " tiene una licencia " . $tipolicencia2 . " y debe contar con una licencia C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "BUS") {
          if (in_array($tipolicencia2, $licencesc2)) {
            die("Lo sentimos el conductor identificado con " . $idconductor2 . " tiene una licencia " . $tipolicencia2 . " y debe contar con una licencia C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        }
        if ($clase == "MICROBUS") {
          if (in_array($tipolicencia3, $licencesc1)) {
            die("Lo sentimos el conductor identificado con " . $idconductor3 . " tiene una licencia " . $tipolicencia3 . " y debe contar con una licencia C1, C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "CAMIONETA") {
          if (in_array($tipolicencia3, $licencesc1)) {
            die("Lo sentimos el conductor identificado con " . $idconductor3 . " tiene una licencia " . $tipolicencia3 . " y debe contar con una licencia C1, C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "BUSETA") {
          if (in_array($tipolicencia3, $licencesc2)) {
            die("Lo sentimos el conductor identificado con " . $idconductor3 . " tiene una licencia " . $tipolicencia3 . " y debe contar con una licencia C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        };
        if ($clase == "BUS") {
          if (in_array($tipolicencia3, $licencesc2)) {
            die("Lo sentimos el conductor identificado con " . $idconductor3 . " tiene una licencia " . $tipolicencia3 . " y debe contar con una licencia C2 ó C3 para conducir vehiculos tipo " . $clase);
          };
        }

        if (!$result) {
          echo "La consulta SQL contiene errores." . mysqli_error($con);
          exit();
        } else {
          if (strtotime($fechaactual) > strtotime($fechaevento)) {
            die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que la Revisión Tecnicomécanica y de gases no se encuentra actualizada en nuestro sistema. <br> Nuestra base de datos reporta fecha de vencimiento el $fechaevento");
          } else {
            if (strtotime($fechafinal) > strtotime($fechaevento)) {
              die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que la Revisión Tecnicomécanica y de gases vence durante el servicio. <br> cambie la fecha final o actualice la información. Nuestra base de datos reporta fecha de vencimiento el $fechaevento");
            } else {
              if (strtotime($fechaactual) > strtotime($fechaevento1)) {
                die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que el SOAT no se encuentra actualizado en nuestro sistema.<br> 
  Nuestra base de datos reporta fecha de vencimiento el $fechaevento1");
              } else {
                if (strtotime($fechafinal) > strtotime($fechaevento1)) {
                  die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que el SOAT vence durante el servicio. <br> cambie la fecha final o actualice la información. Nuestra base de datos reporta fecha de vencimiento el $fechaevento1");
                } else {
                  if (strtotime($fechaactual) > strtotime($fechaevento2)) {
                    die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que la Tarjeta de operación no se encuentra actualizada en nuestro sistema.<br> Nuestra base de datos reporta fecha de vencimiento el $fechaevento2");
                  } else {
                    if (strtotime($fechafinal) > strtotime($fechaevento2)) {
                      die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que la Tarjeta de operación vence durante el servicio. <br> cambie la fecha final o actualice la información. Nuestra base de datos reporta fecha de vencimiento el $fechaevento2");
                    } else {
                      if (strtotime($fechaactual) > strtotime($fechaevento3)) {
                        die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que la Póliza Contractual no se encuentra actualizada en nuestro sistema.<br> Nuestra base de datos reporta fecha de vencimiento el $fechaevento3");
                      } else {
                        if (strtotime($fechafinal) > strtotime($fechaevento3)) {
                          die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que la Póliza Contractual vence durante el servicio. <br> cambie la fecha final o actualice la información. Nuestra base de datos reporta fecha de vencimiento el $fechaevento3");
                        } else {
                          if (strtotime($fechaactual) > strtotime($fechaevento4)) {
                            die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que la Póliza Extracontractual no se encuentra actualizada en nuestro sistema.<br> Nuestra base de datos reporta fecha de vencimiento el $fechaevento4");
                          } else {
                            if (strtotime($fechafinal) > strtotime($fechaevento4)) {
                              die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que la Póliza Extracontractual vence durante el servicio. <br> cambie la fecha final o actualice la información. Nuestra base de datos reporta fecha de vencimiento el $fechaevento4");
                            } else {
                              if (($KmActual - $Ultimokm) > $kmParaCambiar84) {
                                die("Lo sentimos, el vehículo de placa " . $_POST['placa'] . " no puede ser programado debido a que no registra actualización de cambio de aceite programado en nuestro sistema.<br> Nuestra base de datos reporta último cambio de aceite en el Kilometraje $Ultimokm");
                              } else {
                                if (strtotime($fechaactual) > strtotime($Mtto)) {
                                  die("Lo sentimos, el vehículo de placa $placaform no puede ser programado debido a que debe realizar revisión programada para dar cumplimiento al Programa de Mantenimiento Preventivo del Sistema de Gestión de Calidad adoptado por la empresa, la cual tiene como fecha de vencimiento el: '. $Mtto .' recuerde que con el incumplimiento del programa de mantenimiento no podrá prestar ningún tipo de servicio de transporte");
                                } else {
                                  if (strtotime($fechafinal) > strtotime($Mtto)) {
                                    die("Lo sentimos, el vehículo de placa $placaform no puede ser programado debido a que debe realizar revisión programada para dar cumplimiento al Programa de Mantenimiento Preventivo del Sistema de Gestión de Calidad adoptado por la empresa, la cual vence durante el servicio. <br> cambie la fecha final o actualice la información. Nuestra base de datos reporta fecha de vencimiento el: '. $Mtto .' recuerde que con el incumplimiento del programa de mantenimiento no podrá prestar ningún tipo de servicio de transporte");
                                  } else {
                                    if (strtotime($fechaactual) > strtotime($venlicencia1)) {
                                      die("Lo sentimos, el conductor identificado con la cédula No. $idconductor1 no puede ser programado debido a que la licencia de conducción  no se encuentra actualizada en nuestro sistema.<br> Nuestra base de datos reporta fecha de vencimiento el $venlicencia1 ");
                                    } else {
                                      if (strtotime($fechafinal) > strtotime($venlicencia1)) {
                                        die("Lo sentimos, el conductor identificado con la cédula No. $idconductor1 no puede ser programado debido a que la licencia de conducción se vence durante el servicio. <br> cambie la fecha final o actualice la información. Nuestra base de datos reporta fecha de vencimiento el: $venlicencia1 ");
                                      } else {
                                        if (strtotime($fechaactual) > strtotime($venlicencia2)) {
                                          die("Lo sentimos, el conductor identificado con la cédula No. $idconductor2 no puede ser programado debido a que la licencia de conducción  no se encuentra actualizada en nuestro sistema.<br> Nuestra base de datos reporta fecha de vencimiento el $venlicencia2 ");
                                        } else {
                                          if (strtotime($fechafinal) > strtotime($venlicencia2)) {
                                            die("Lo sentimos, el conductor identificado con la cédula No. $idconductor2 no puede ser programado debido a que la licencia de conducción  se vence durante el servicio. <br> cambie la fecha final o actualice la información. Nuestra base de datos reporta fecha de vencimiento el: $venlicencia2 ");
                                          } else {
                                            if (strtotime($fechaactual) > strtotime($venlicencia3)) {
                                              die("Lo sentimos, el conductor identificado con la cédula No. $idconductor3 no puede ser programado debido a que la licencia de conducción  no se encuentra actualizada en nuestro sistema.<br> Nuestra base de datos reporta fecha de vencimiento el $venlicencia3");
                                            } else {
                                              if (strtotime($fechafinal) > strtotime($venlicencia3)) {
                                                die("Lo sentimos, el conductor identificado con la cédula No. $idconductor3 no puede ser programado debido a que la licencia de conducción  no se encuentra actualizada en nuestro sistema.<br> Nuestra base de datos reporta fecha de vencimiento el $venlicencia3");
                                              }

                                              //////***** 


                                              else {
                                                if ($simit1 == 0) {

                                                  die("Lo sentimos No se puede generar el contrato, el conductor identificado con la cédula No. $idconductor1 se encuentra reportado en el SIMIT <br><br> <div align='center'> ");
                                                } else {
                                                  if ($simit2 == 0) {

                                                    die("Lo sentimos No se puede generar el contrato, el conductor identificado con la cédula No. $idconductor2 se encuentra reportado en el SIMIT <br><br> <div align='center'> ");
                                                  } else {
                                                    if ($simit3 == 0) {

                                                      die("Lo sentimos No se puede generar el contrato, el conductor identificado con la cédula No. $idconductor3 se encuentra reportado en el SIMIT <br><br> <div align='center'> ");
                                                    } else {
                                                      if ($runt1 == 0) {

                                                        die("Lo sentimos No se puede generar el contrato, el conductor identificado con la cédula No. $idconductor1 se encuentra reportado en el RUNT <br><br> <div align='center'> ");
                                                      } else {
                                                        if ($runt2 == 0) {

                                                          die("Lo sentimos No se puede generar el contrato, el conductor identificado con la cédula No. $idconductor2 se encuentra reportado en el RUNT <br><br> <div align='center'> ");
                                                        } else {
                                                          if ($runt3 == 0) {

                                                            die("Lo sentimos No se puede generar el contrato, el conductor identificado con la cédula No. $idconductor3 se encuentra reportado en el RUNT <br><br> <div align='center'> ");
                                                          } else {
                                                            if ($estadoPA == 0) {

                                                              die("Lo sentimos No se puede generar el FUEC, el vehículo de placa. $placaform se encuentra con el Protocolo de Alistamiento vencido  <br><br> <a href=\"Alistamiento_p.php\"> Realiza un nuevo protocolo de alistamiento </a><div align='center'> ");
                                                            }
                                                            echo  "verificacion documental completa";
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
                  }
                }
              }
            }
          }
        }
      }
      ?>;


      <?php

      //include("Funciones.php");
      //$con=conectar();
      $nombreContratante = mb_strtoupper($_POST['contratante']);
      $origenDestino = mb_strtoupper($_POST['origendestino']);
      $objeto = mb_strtoupper($_POST['objeto']);
      $responsable = mb_strtoupper($_POST['responsable']);
      $direccioncontratante = mb_strtoupper($_POST['direccioncontratante']);

      $access = 1;
      //$access = $_SESSION["ide"];

      @mysqli_query($con, "SET NAMES 'utf8'"); //ESTA ES LA LINEA QEU JUNTO CON LA DE ARRIBA 

      $ssql = "INSERT INTO tblFUECOcasional (NoContrato,Contratante,NitContratante,ObjetoContrato,OrigenDestino,FechaInicial,FechaFinal,Placa,CedulaC1,CedulaC2,CedulaC3,ResponsableCte,CedulaResponsableCte,TelResponsableCte,DireccionResponsableCte,TotalKm,ValorFUEC,User,Convenio,Modelo,Marca,Clase,Interno,TarjetaOp,NombreC1,LicenciaC1,VigenciaC1,NombreC2,LicenciaC2,VigenciaC2,NombreC3,LicenciaC3,VigenciaC3,Capacidad, Reportado) 
             VALUES(0024,'$nombreContratante','$_POST[idcontratante]','$objeto','$origenDestino','$_POST[fechainicial]',
			 '$_POST[fechafinal]','$_POST[placa]','$idconductor1', '$idconductor2', '$idconductor3',
			 '$responsable','$_POST[idresponsable]',
			 '$_POST[telefonocontratante]','$direccioncontratante','$_POST[totalkm]','$_POST[valorfuec]',$access,'$convenio','$modelo','$marca','$clase','$interno','$operation','$driverfullname2','$idconductor1','$venlicencia1','$driverfullname3','$idconductor2','$venlicencia2','$driverfullname4','$idconductor3','$venlicencia3','$capacity','0');";

      $rs_access = mysqli_query($con, $ssql);

      if (!$rs_access)
        die("Error al ejecutar la consulta:        " . mysqli_error($con));
      echo "<br>";
      echo  "<font face='Arial Narrow'><font size = 5 ><div align='center'>El FUEC ha sido procesado con éxito</div></font></font> \n";

      //recibo el último id
      $ultimo_id = mysqli_insert_id($con);
      echo "<font face='Arial Narrow'> <font size= 5> El número de FUEC es :<b> $ultimo_id  </b> </font>"

      /*  $Update = "UPDATE tblFUECOcasional INNER JOIN tblVencimientos ON tblFUECOcasional.Placa = tblVencimientos.Placa SET tblFUECOcasional.Modelo = tblVencimientos.Modelo,  tblFUECOcasional.Marca = tblVencimientos.Marca,tblFUECOcasional.Clase = tblVencimientos.Clase, tblFUECOcasional.Interno = tblVencimientos.Interno, tblFUECOcasional.TarjetaOp = tblVencimientos.TarjetaOp, tblFUECOcasional.Capacidad = tblVencimientos.Capacidad, tblFUECOcasional.Convenio = tblVencimientos.Convenio WHERE tblFUECOcasional.Placa = '$_POST[placa]' AND tblVencimientos.Placa = '$_POST[placa]'"; */


      //$Update = "UPDATE tblFUECMancol SET tblFUECMancol.Modelo, tblFUECMancol.Marca,tblFUECMancol.Clase,tblFUECMancol.Interno,tblFUECMancol.TarjetaOp =         					     (SELECT tblVencimientos.Modelo,tblVencimientos.Marca,tblVencimientos.Clase,tblVencimientos.Interno,tblVencimientos.TarjetaOp FROM tblVencimientos WHERE (tblVencimientos.Placa = '$_POST[placa]'))WHERE tblFUECMancol.Placa = '$_POST[placa]'";

      //$Update = "UPDATE tblFUECMancol, tblVencimientos SET tblFUECMancol.Modelo, tblFUECMancol.Marca,tblFUECMancol.Clase,tblFUECMancol.Interno,tblFUECMancol.TarjetaOp =         					     //tblVencimientos.Modelo,tblVencimientos.Marca,tblVencimientos.Clase,tblVencimientos.Interno,tblVencimientos.TarjetaOp WHERE Placa.tblVencimientos = '$_POST[placa]'";
      /* $rs = mysqli_query($con, $Update);
      if ($rs == false) {
        echo '<p>Error al modificar los campos en la tabla.</p>';
      } else {
        echo '<p>Los datos se han modificado correctamente.</p>';
      }
 */
      /*  $Update1 = "UPDATE tblFUECOcasional INNER JOIN tblConductores ON tblFUECOcasional.CedulaC1 = tblConductores.IdConductor SET tblFUECOcasional.NombreC1 = CONCAT(tblConductores.Nombre,'\r',tblConductores.Apellidos),tblFUECOcasional.LicenciaC1 = tblConductores.NoLicencia,tblFUECOcasional.VigenciaC1 = tblConductores.VencimientoLicencia WHERE tblFUECOcasional.CedulaC1 = '$_POST[cedulac1]' AND tblConductores.IdConductor = '$_POST[cedulac1]'";

      $rs1 = mysqli_query($con, $Update1);
      if ($rs1 == false) {
        echo '<p>Error al modificar los campos en la tabla Conductor 1.</p>';
      } else {
        echo '';
      } */

      //	$Update0 = "UPDATE tblFUECMancol INNER JOIN tblContratos ON tblFUECMancol.NoContrato = tblContratos.NoContrato SET tblFUECMancol.Contratante = tblContratos.Contratante, tblFUECMancol.NitContratante = tblContratos.NitContratante , tblFUECMancol.ObjetoContrato = tblContratos.ObjetoContrato, tblFUECMancol.ResponsableCte = tblContratos.ResponsableCte, tblFUECMancol.CedulaResponsableCte = tblContratos.CedulaResponsableCte, tblFUECMancol.TelResponsableCte = tblContratos.TelResponsableCte, tblFUECMancol.DireccionResponsableCte = tblContratos.DireccionResponsableCte WHERE tblFUECMancol.NoContrato = '$_POST[contrato]' AND tblContratos.NoContrato = '$_POST[contrato]'";

      //$rs0 = mysql_query($Update0);
      //if($rs0 == false){
      //echo '<p>Error al modificar los campos en la tabla Conductor 1.</p>';
      //}
      //else{
      //echo '<p>Los datos se han modificado correctamente en conductor 1.</p>';	
      //}

      /*       $Update2 = "UPDATE tblFUECOcasional INNER JOIN tblConductores ON tblFUECOcasional.CedulaC2 = tblConductores.IdConductor SET tblFUECOcasional.NombreC2 = 
CONCAT(tblConductores.Nombre,'\r',tblConductores.Apellidos),tblFUECOcasional.LicenciaC2 = tblConductores.NoLicencia,tblFUECOcasional.VigenciaC2 = tblConductores.VencimientoLicencia WHERE tblFUECOcasional.CedulaC2 = '$_POST[cedulac2]' AND tblConductores.IdConductor = '$_POST[cedulac2]'";

      $rs2 = mysqli_query($con, $Update2);
      if ($rs2 == false) {
        echo '<p>Error al modificar los campos en la tabla Conductor 2.</p>';
      } else {
        echo '';
      }
      $Update3 = "UPDATE tblFUECOcasional INNER JOIN tblConductores ON tblFUECOcasional.CedulaC3 = tblConductores.IdConductor SET tblFUECOcasional.NombreC3 = CONCAT(tblConductores.Nombre,'\r',tblConductores.Apellidos),tblFUECOcasional.LicenciaC3 = tblConductores.NoLicencia,tblFUECOcasional.VigenciaC3 = tblConductores.VencimientoLicencia WHERE tblFUECOcasional.CedulaC3 = '$_POST[cedulac3]' AND tblConductores.IdConductor = '$_POST[cedulac3]'";

      $rs3 = mysqli_query($con, $Update3);
      if ($rs3 == false) {
        echo '<p>Error al modificar los campos en la tabla Conductor 3.</p>';
      } else {
        echo '';
      } */
      ?>;
      <?php
      $dia = date("d.m.Y");
      $hora = date("H:i:s");
      $noFUEC = $ultimo_id;
      $nombre = $_POST['contratante'];
      $apellido = $_POST['idcontratante'];
      $email = $_POST['objeto'];
      $telefono = $_POST['origendestino'];
      $asunto = $_POST['fechainicial'];
      $mensaje = $_POST['fechafinal'];
      $motor = $_POST['placa'];
      $cedulac1 = $_POST['cedulac1'];
      $aire = $_POST['cedulac2'];
      $pito = $_POST['cedulac3'];
      $sillas = $_POST['responsable'];
      $emergencia = $_POST['idresponsable'];
      $observaciones = $_POST['telefonocontratante'];
      $responsableDir = $_POST['direccioncontratante'];
      $destinatario = "dev@expresomiraflores.com";
      $subject = "Generación de FUEC Servicio Ocasional";
      $desde = 'Desde: ' . $email . "\r\n" .
        'Reply-To:dev@expresomiraflores.com' . "\r\n" .
        'Cc: operaciones@expresomiraflores.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
      $contingut = "
 El mensaje se ha sido enviado desde expresomiraflores.com el dia: $dia a las: $hora\n\n 
----------------------------------------------------------------------------\n
 FUEC No.: $noFUEC\n
 Contratante: $nombre\n
 Nit o C.C.: $apellido\n
 Objeto: $email\n
 Origen/Destino: $telefono\n
 Fecha Inicial: $asunto\n
 Fecha Final: $mensaje\n
 Placa: $motor\n
 Cedula C1: $cedulac1\n
 Cedula C2: $aire\n
 Cedula C3: $pito\n
 Responsable del Contratante: $sillas\n
 Cedula Responsable: $emergencia\n
 Telefono Rsponsable: $observaciones\n
 Direccion Responsable: $responsableDir\n
 Para obtener el FUEC elaborado, ingrese aqui: https://app.expresomiraflores.com/ActualizarFUECPDFOcasional.php/?var=$noFUEC
 ----------------------------------------------------------------------------\n
 ";
      mail($destinatario, $subject, $contingut, $desde);
      echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Para obtener el FUEC acabó de realizar ingrese <a href='ActualizarFUECPDFOcasional.php/?var=$noFUEC'>aqui</a> </span> </b></font></td></tr>";
      ?>
  </body>

</html>