<!-- Cabecera -->
<?php require_once 'includes/cabecera.php' ?>

<!--barra lateral-->
<?php require_once 'includes/lateral.php' ?>

<?php
$categoria = conseguirCategoria($db, $_GET['id']);
if (!isset($categoria['id'])) {
    header("Location: index.php");
}
?>


<!--caja principal -->
<div id="principal">

    <h1>Entradas de <?= $categoria['nombre'] ?></h1>

    <!-- Crea las utlimas 4 entradas en el nav de la pagina -->
    <?php
    $entradas = ConseguirEntradas($db, 0, $_GET['id']);
    if (!empty($entradas) && mysqli_num_rows($entradas) >= 1) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
                <a href="entrada-unica.php?id=<?= $entrada['id'] ?>">
                    <h2><?= $entrada['titulo'] ?></h2>
                    <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>
                    <p>
                        <?= substr($entrada['descripcion'], 0, 180) . '...' ?>
                        <br><br>
                    </p>
                </a>
            </article>

        <?php endwhile; ?>
    <?php else : ?>

        <br>
        <div>
            <p class="epigrafe">No hay entradas en esta categoria, si desea puede escribir en esta categoría, en crear entrada</p>
        </div>

    <?php endif; ?>
</div>
<!-- fin principal -->

<!--Pie de pagina-->
<?php require_once 'includes/pie.php'; ?>