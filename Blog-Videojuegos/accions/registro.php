<?php
if (isset($_POST)) {

    //Conexion a la base de datos
    require_once 'conexion.php';

    //Si no existe sesion, iniciarla
    if (!isset($_SESSION)) {
        session_start();
    }

    //Recoger los valores del formulario
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;


    //Array de errores
    $errores = array();

    //validación los datos antes de enviarlos a la BD
    //Validacion de nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }
    //Validacion de apellidos
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "El apellido no es válido";
    }
    //Validacion de email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = "El email no es válido";
    }
    //Validacion de contraseña
    if (!empty($password)) {
        $password_validado = true;
    } else {
        $password_validado = false;
        $errores['password'] = "La contraseña está vacía";
    }


    //Comprobar si el email ya existe
    $sql = "SELECT id, email FROM usuarios WHERE email = '$email';";

    //Hace la consulta a la base de datos
    $existe_email = mysqli_query($db, $sql);

    //El objeto que recibe de la funcion, le meto en la variable $existe_email
    //Invico a la funcion mysqli_fetch_assoc() para que me hago un array asociativo, y ese array lo guardo en la 
    //variable $existe_usuario
    $existe_usuario = mysqli_fetch_assoc($existe_email);


    //Si  'email' dentro del array $existe_usuario, es distinto al campo usuario[email](que son los datos guardados de la base de datos)
    //me indica que no se encuentra en la base de datos, por lo tanto, entra y ejecuta lo que esta dentro de la condicion, si no musetra
    // que ya existe ese usuario.
    if ($existe_usuario['email'] <> $email) {

        //Si no hay errores guardar el usuarios en la base de datos
        if (count($errores) == 0) {
            $guardar_usuario = true;

            //Cifrando la contraseña para mandarla a la BD
            $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

            //Mandando los datos del usuario a la BD
            $sql = "INSERT INTO usuarios VALUES (NULL, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
            $guardar = mysqli_query($db, $sql);

            // Si se mando a la base de datos muestra por pantalla la realizacion de la misma
            if ($guardar) {
                $_SESSION['completado'] = 'El registro se completó con éxito';
            } else {
                $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
            }
        } else {
            //Informar el error
            $_SESSION['errores'] = $errores;
        }
    } else {
        $_SESSION['errores']['general'] = "El usuario ya existe!!";
    }
}
header('Location: ../index.php');
