<!-- Si no esta la logueado, redirige al index.php -->
<?php require_once 'accions/redireccion.php'; ?>

<!-- Cabecera de la pagina -->
<?php require_once 'includes/cabecera.php'; ?>

<!-- Botones laterales -->
<?php require_once 'includes/lateral.php'; ?>


<!-- Cuerpo principal  -->
<div id="principal">
    <h1>Crear entradas</h1>
    <p>
        Añade su aporte a la comunidad, Puede escribir lo que desea acerca de algún juego o suceso del mundo del gaming.

    </p>
    <br>

    <form action="accions/guardar-entrada.php" method="POST">

        <label for="titulo">Título:</label>
        <input type="text" name="titulo">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>

        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" cols="30" rows="10"></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php $categorias = conseguirCategorias($db);
            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) :
            ?>
                    <option value="<?= $categoria['id'] ?>">
                        <?= $categoria['nombre'] ?>
                    </option>

                <?php endwhile; ?>
            <?php endif; ?>

        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>


        <input type="submit" value="Guardar">
    </form>

    <?php borrarErrores(); ?>
</div>

<!--Pie de pagina-->
<?php require_once 'includes/pie.php'; ?>