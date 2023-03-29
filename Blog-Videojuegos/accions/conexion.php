<?php
//conexion
$servidor = "localhost";
$usuario = 'root';
$password = '';
$basededatos = 'blog';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");

//Iniciar la sesion para indicar si hay errores en el formulario
if (!isset($_SESSION)) {
    session_start();
}


// $servidor = "localhost";
// $usuario = 'root';
// $password = '';
// $basededatos = 'blog';