<?php
function conectar()
{
    $sock = mysqli_connect("localhost", "root", "", "expresom_app");

    if (!$sock) {
        die("Error al conectarse al servidor");
    }

    return ($sock);
}