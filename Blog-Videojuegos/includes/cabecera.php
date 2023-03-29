<!-- Conexion con archivo de conexion a la base de datos -->
<?php require_once 'accions/conexion.php'; ?>

<!-- Conexion con el archivo de funciones -->
<?php require_once 'accions/helpers.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/estilos.css">
    <link rel="shortcut icon" href="./proyecto-php/assets/img/ps4-controller.png">
</head>

<body>

    <!--Cabecera -->
    <header id="cabecera">
        <!--LOGO -->
        <div id="logo1">
            <a href="index.php">
                <img src="./assets/img/mario3.png" alt="Blog de Videojuegos">
            </a>
        </div>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <?php

                $categorias = conseguirCategorias($db);
                if (!empty($categorias)) :
                    while ($categoria = mysqli_fetch_assoc($categorias)) :
                ?>
                        <li>
                            <a href="categoria.php?id=<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></a>
                        </li>
                <?php
                    endwhile;
                endif;
                ?>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>
    <!-- Es lo que le procede a la cabecera, pero lo dejo aquí así dejo el código mas limio del index principal -->
    <div id="contenedor">