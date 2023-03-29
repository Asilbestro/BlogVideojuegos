<?php
//Iniciar la sesion y la conexion a la base de datos
require_once 'conexion.php';

//Recoger datos del formulario
if (isset($_POST)) {

    //Borrar error antiguo
    if (isset($_SESSION['error-login'])) {
        $_SESSION['error-login'] = null;
    }

    //Recoger datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Consulta para comprobar la passwod
    $sql = "SELECT * FROM usuarios WHERE email = '$email';";
    $login = mysqli_query($db, $sql);

    //Si se encuentra un campo en la base de datos, crea una sesion
    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);

        //comprobar si la contraña es la misma, la que ingresa el usuario y la cifrada de la base de datos
        $verify = password_verify($password, $usuario['password']);

        if ($verify) {
            //Utilizar una sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
        } else {
            //Si no son las mismas va a abrir una session con el error, para mostrarlo en el index
            $_SESSION['error-login'] = "Login incorrecto!!";
        }
    } else {
        //Mensaje de error
        $_SESSION['error-login'] = "Login incorrecto!!";
    }
}
//Redirigir al index.php
header('Location: ../index.php');
