<?php
include '../config.php';


function conectar()
{
    if (ENVIRONMENT === "dev") {
        $sock = mysqli_connect("localhost", "root", "", "expresom_app");
    } elseif (ENVIRONMENT === "prod") {
        $sock = mysqli_connect("localhost", "expresom", ")J9Fv7Qs6ts2B:", "expresom_app");
    } else {
        die("Entorno no válido");
    }

    if (!$sock) {
        die("Error al conectarse al servidor");
    }

    return ($sock);
};

if (ENVIRONMENT === "dev") {
    // Entorno de desarrollo local
    $baseImagePath = "/opt/lampp/htdocs/mirafloresapp/tmp/";
    $urlqr = "http://192.168.1.73/mirafloresapp/fuecs/ActualizarFUECPDFOcasionalCopy.php";
} else {
    // Entorno de producción
    $baseImagePath = "/home/expresom/app.expresomiraflores.com/tmp/";
    $urlqr = "/ActualizarFUECPDFOcasionalCopy.php";
}
