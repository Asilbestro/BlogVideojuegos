<?php
//   Si no esta la logueado, redirige al index.php
require_once 'accions/redireccion.php';

// Cabecera de la pagina
require_once 'includes/cabecera.php';

// Botones laterales
require_once 'includes/lateral.php';
?>

<!-- Cuerpo principal  -->
<div id="principal">
    <h1>Mis datos</h1>

    <!-- Mostrar lso errores -->
    <br>
    <?php if (isset($_SESSION['completado'])) : ?>
        <div class="alerta alerta-exito">
            <?= $_SESSION['completado'] ?>
        </div>
    <?php elseif (isset($_SESSION['errores']['general'])) : ?>
        <div class="alerta alerta-error">
            <?= $_SESSION['errores']['general'] ?>
        </div>
    <?php endif; ?>

    <form action="accions/actualizar-usuario.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre']; ?>" />

        <!-- Comprobando si existe y si no muestra el error del nombre -->
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellido']; ?>" />

        <!-- Comprobando si existe y si no muestra el error del apellidos -->
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?= $_SESSION['usuario']['email']; ?>" />

        <!-- Comprobando si existe y si no muestra el error del email -->
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>


        <label for="password">Contraseña</label>
        <input type="password" name="password" />

        <!-- Comprobando si existe y si no muestra el error del password -->
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>


        <input type="submit" name="submit" value="Actualizar">
        <br>
        <p class="epigrafe">
            Si desea actualizar unos de sus datos recuerde que debe ingresar todos los datos inlcluyendo la contraseña actual, o si desea cambiarla, ingresar la nueva contraseña.

        </p>
    </form>
    <!-- Funcion para borrar los errores. que se aloja en helpers.php -->
    <?php borrarErrores(); ?>



</div>

<!--Pie de pagina-->
<?php require_once 'includes/pie.php'; ?>