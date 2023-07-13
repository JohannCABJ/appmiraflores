<?

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //form submitted

    //check if other form details are correct

    //verify captcha
    $recaptcha_secret = "6LelNM4eAAAAAGa56TtxUC-52W1IjcbWDQFdQKQn";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $_POST['g-recaptcha-response']);
    $response = json_decode($response, true);
 /*    if ($response["success"] === false) {
        echo "<script>alert('Asegusere de validar el Captcha. Click en Aceptar para Intentarlo nuevamente .'); window.location.href=\"login.html\"</script>";
    } else { */
        include 'Funciones.php';
        $con = conectar();
        /* El query valida si el usuario ingresado existe en la base de datos. Se utiliza la funci�n htmlentities para evitar inyecciones SQL. */
        $myusuario = mysqli_query($con, "SELECT username FROM usercontratantes WHERE username = '" . htmlentities($_POST["usuario"]) . "'");
        $nmyusuario = mysqli_num_rows($myusuario);

        //Si existe el usuario, validamos tambi�n la contrase�a ingresada y el estado del usuario... 
        if ($nmyusuario != 0) {
            $sql = "SELECT full_name, id FROM usercontratantes WHERE estado = 1 and username = '" . htmlentities($_POST["usuario"]) . "' AND password = '" . htmlentities($_POST["clave"]) . "'";
            $myclave = mysqli_query($con, $sql);
            $nmyclave = mysqli_num_rows($myclave);
            //Si el usuario y clave ingresado son correctos (y el usuario est� activo en la BD), creamos la sesi�n del mismo. 
            if ($nmyclave != 0) {
                session_start();
                //Guardamos dos variables de sesi�n que nos auxiliar� para saber si se est� o no "logueado" un usuario 
                $_SESSION["autentica"] = "SIP";
                while ($row = mysqli_fetch_assoc($myclave)) {
                    $_SESSION["usuarioactual"] = $row["full_name"];
                    $_SESSION["ide"] = $row["id"];
                };
                header("Location: ../contracts/ingresoContrato_p.php");
            } else {
                echo "<script>alert('La clave del usuario no es correcta.'); window.location.href=\"login.html\"</script>";
            }
        } else {
            echo "<script>alert('El usuario $usuario no existe.'); window.location.href=\"login.html\"</script>";
        //}
    }
}
mysqli_close($con);
