<!-- Cabecera -->
<?php require_once 'includes/cabecera.php' ?>

<!--barra lateral-->
<?php require_once 'includes/lateral.php' ?>

<!-- Si no hay nada en post[buscqueda] que rediriga al busqueda y ni deje acceder a la página -->
<?php if (!isset($_POST['busqueda'])) {
    header("Location: index.php");
}
?>

<!--caja principal -->
<div id="principal">

    <h1>Busqueda encontrada de : <?= $_POST['busqueda'] ?></h1>

    <!-- Crea las utlimas 4 entradas en el nav de la pagina -->
    <?php
    $busqueda = buscarEntradas($db, $_POST['busqueda']);
    if (!empty($busqueda) && mysqli_num_rows($busqueda) >= 1) :
        while ($array_busqueda = mysqli_fetch_assoc($busqueda)) :
    ?>
            <article class="entrada">
                <a href="entrada-unica.php?id=<?= $array_busqueda['id'] ?>">
                    <h2><?= $array_busqueda['titulo'] ?></h2>
                    <span class="fecha"><?= $array_busqueda['categoria'] . ' | ' . $array_busqueda['fecha'] ?></span>
                    <p>
                        <?= substr($array_busqueda['descripcion'], 0, 180) . '...' ?>
                        <br><br>

                    </p>
                </a>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <br>
        <div class="epigrafe">No se encontraron entradas con ese nombre</div>

    <?php endif; ?>
</div>
<!-- fin principal -->

<!--Pie de pagina-->
<?php require_once 'includes/pie.php'; ?>