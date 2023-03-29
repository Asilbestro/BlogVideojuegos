<?php

function mostrarError($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
    }
    return $alerta;
}

function borrarErrores()
{
    $borrado = false;
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = true;
    }
    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $borrado = true;
    }
    if (isset($_SESSION['errores_entrada'])) {
        $_SESSION['errores_entrada'] = null;
        $borrado = true;
    }
    if (isset($_SESSION['errores_categoria'])) {
        $_SESSION['errores_categoria'] = null;
        $borrado = true;
    }
    if (isset($_SESSION['error-login'])) {
        $_SESSION['error-login'] = null;
        $borrado = true;
    }
    return $borrado;
}

function conseguirCategorias($conexion)
{

    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);

    // Array para guardar el objeto que te manda la funcion mysqli_query
    $resultado = array();
    if (isset($categorias) && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }
    return $resultado;
}

//Para mostrar las entradas individualmente cuando entramos al link
function ConseguirEntrada($conexion, $id)
{
    $sql = "SELECT e.*, c.nombre AS categoria, CONCAT(u.nombre,' ',u.apellido) AS 'usuario' FROM entradas e 
     INNER JOIN categorias c ON e.categoria_id = c.id
     INNER JOIN usuarios u ON e.usuario_id = u.id
     WHERE e.id = $id;";

    $entrada = mysqli_query($conexion, $sql);

    $resultado = array();
    if ($entrada && mysqli_num_rows($entrada) >= 1) {
        $resultado = mysqli_fetch_assoc($entrada);
    }
    return $resultado;
}

//Consulta a la base de datos y devuelve un aray con los datos de la consulta
function ConseguirEntradas($conexion, $numEntradas, $categoria = null)
{
    if ($numEntradas > 0) {
        $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e
         INNER JOIN categorias c ON e.categoria_id = c.id 
        ORDER BY e.id DESC LIMIT $numEntradas;";
    } else {
        if ($numEntradas < 1) {
            $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e
        INNER JOIN categorias c ON e.categoria_id = c.id 
        ORDER BY e.id DESC ;";
        }
    }

    if (!empty($categoria)) {
        $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e
         INNER JOIN categorias c ON e.categoria_id = c.id 
         WHERE e.categoria_id = $categoria
         ORDER BY e.id DESC  ;";
    }
    $entradas = mysqli_query($conexion, $sql);

    return $entradas;
}

function conseguirCategoria($conexion, $id)
{

    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categorias = mysqli_query($conexion, $sql);

    // Array para guardar el objeto que te manda la funcion mysqli_query
    $resultado = array();
    if (isset($categorias) && mysqli_num_rows($categorias) >= 1) {
        $resultado = mysqli_fetch_assoc($categorias);
    }
    return $resultado;
}

function entradasMias($conexion, $id)
{
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e 
    INNER JOIN usuarios u ON e.usuario_id = u.id
    INNER JOIN categorias c ON e.categoria_id = c.id
    WHERE u.id = $id;";

    $misEntradas = mysqli_query($conexion, $sql);

    return $misEntradas;
}

function buscarEntradas($conexion, $busqueda)
{
    $sql = "SELECT e.* ,c.nombre AS 'categoria' FROM entradas e 
    INNER JOIN categorias c ON e.categoria_id = c.id
    WHERE e.titulo LIKE '%$busqueda%'";

    $busqueda = mysqli_query($conexion, $sql);

    return $busqueda;
}
