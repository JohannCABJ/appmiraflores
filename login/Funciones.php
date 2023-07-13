<?
function conectar()
{
    $sock = mysqli_connect("localhost", "expresom", ")J9Fv7Qs6ts2B:", "expresom_app");

    if (!$sock) {
        die("Error al conectarse al servidor");
    }

    return ($sock);
}
