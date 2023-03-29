<?php
if (isset($_POST)) {

    require_once 'conexion.php';

    //Dandole valores a las variables
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? mysqli_real_escape_string($db, $_POST['categoria']) : false;
    $usuario = $_SESSION['usuario']['id'];

    // Array donde iran los errores
    $errores = array();

    // Validacion
    if (empty($_POST['titulo'])) {
        $errores['titulo'] = 'El titulo no es válido';
    }

    if (empty($_POST['descripcion'])) {
        $errores['descripcion'] = 'La descrpcion no es válida';
    }

    if (empty($categoria && is_numeric($categoria))) {
        $errores['categoria'] = 'La categoria no es válida';
    }

    if (count($errores) == 0) {
        if (isset($_GET['editar'])) {
            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];

            $sql =  "UPDATE entradas SET titulo='$titulo', descripcion = '$descripcion', categoria_id =$categoria  
            WHERE id = $entrada_id AND usuario_id = $usuario_id;";
        } else {
            $sql = "INSERT INTO entradas VALUES(NULL, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
        }
        $guardar = mysqli_query($db, $sql);

        header("Location: ../index.php");
    } else {

        $_SESSION["errores_entrada"] = $errores;

        if (isset($_GET['editar'])) {
            header("Location: ../editar-entrada.php?id=" . $_GET['editar']);
        } else {
            header("Location: ../crear-entradas.php");
        }
    }
}
