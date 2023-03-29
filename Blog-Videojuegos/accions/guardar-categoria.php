<?php

if (isset($_POST)) {
    //Conexion a la base de datos
    require_once 'conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

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

    if (count($errores) == 0) {
        $sql = "INSERT INTO categorias VALUES(NULL, '$nombre');";
        $guardar = mysqli_query($db, $sql);

        //Redireccion a la pagina principal
        header("Location: ../index.php");
    } else {
        header("Location: ../crear-categoria.php");
        $_SESSION['errores_categoria'] = $errores;
    }
}
