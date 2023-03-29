<!-- Formulario de identificacion -->
<aside id="sidebar">

    <div id="buscador" class="bloque">
        <h3>Buscar</h3>

        <!--  Buscador  -->
        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda" />

            <input type="submit" value="Entrar">
        </form>
    </div>

    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido']; ?></h3>

            <!-- Botones para distintas funcionalidades -->
            <a href="crear-entradas.php" class="boton">Crear entradas</a>
            <a href="crear-categoria.php" class="boton boton-verde">Crear categoría</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="mis-entradas.php" class="boton ">Mis entradas</a>
            <a href="accions/cerrar.php" class="boton boton-rojo">Cerrrar sesión</a>

        </div>
    <?php endif; ?>

    <!-- Si no existe la sesion va a mostrar los datos para loguearse -->
    <?php if (!isset($_SESSION['usuario'])) : ?>

        <div id="login" class="bloque">
            <h3>Identificate</h3>
            <!-- Alertas no coinciden las credenciales de usuarios y password -->
            <?php if (isset($_SESSION['error-login'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error-login']; ?>
                </div>
            <?php endif; ?>

            <!-- Formuario para loguearse -->
            <form action="accions/login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />

                <label for="password">Contraseña</label>
                <input type="password" name="password" />

                <input type="submit" value="Entrar">
            </form>
        </div>

        <!-- Formulario para registrarse-->
        <div id="register" class="bloque">
            <h3>Registrate</h3>

            <!-- Mostrra los errores que se puedan producir -->
            <?php if (isset($_SESSION['completado'])) : ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <form action="accions/registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
                <!-- si existe el error, lo va a mostrar en el index -->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" />
                <!-- si existe el error, lo va a mostrar en el index -->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>


                <label for="email">Email</label>
                <input type="email" name="email" />
                <!-- si existe el error, lo va a mostrar en el index -->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>


                <label for="password">Contraseña</label>
                <input type="password" name="password" />
                <!-- comprobando si existe el campo contraseña es correcto, si no mostrara el error -->
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>


                <input type="submit" name="submit" value="Registrar">
            </form>
            <!-- Funcion de helpers.php, para borrar los errores ya mostados-->
            <?php borrarErrores(); ?>
        </div>
    <?php endif ?>
</aside>