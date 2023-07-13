<? 
//Reanudamos la sesi�n 
session_start(); 
//Literalmente la destruimos 
session_destroy(); 
//Redireccionamos a index.php (al inicio de sesi�n) 
//header("Location: login.php");
header("Location: ../index.html");
?>
