<?
function conectar()
{
    $sock = mysqli_connect("localhost", "transpo1", "NpqJ9@6dNp36.S", "transpo1_transaccionesPoira");

    if (!$sock) {
        die("Error al conectarse al servidor");
    }

    return ($sock);
}