<?php
if (isset($_POST)) {

    //Conexion a la base de datos
    require_once 'conexion.php';

    //Recoger los valores del formulario de actualización
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

    $guardar_usuario = true;

    //Si no hay errores guardar el usuarios en la base de datos
    if (count($errores) == 0) {
        $usuario = $_SESSION['usuario']; //Ya tengo los datos del usuario en un array asociativo dentro de la variable usuario

        $guardar_usuario = true;

        //Comprobar si el email ya existe
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email';";


        $existe_email = mysqli_query($db, $sql);
        $existe_usuario = mysqli_fetch_assoc($existe_email);



        //Encrypting password
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        //update user to send database

        $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellidos', email = '$email', password = '$password_segura'  
         WHERE id = '$usuario[id]';";
        $guardar = mysqli_query($db, $sql);

        if ($guardar) {
            //Se actualiza la session, ya que los datos han sido cambiados
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellido'] = $apellidos;
            $_SESSION['usuario']['email'] = $email;
            $_SESSION['usuario']['password'] = $password_segura;

            $_SESSION['completado'] = 'Tus datos se actualizarón correctamente';
        } else {
            $_SESSION['errores']['general'] = "Fallo al actualizar tus datos ";
        }
    } else {
        //Informar el error
        $_SESSION['errores'] = $errores;
    }
}

header('Location: ../mis-datos.php');
