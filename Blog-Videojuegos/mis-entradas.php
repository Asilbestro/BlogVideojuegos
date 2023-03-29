<!-- Cabecera de la pagina -->
<?php require_once 'includes/cabecera.php'; ?>

<!-- Fomrularios de la pagina -->
<?php require_once 'includes/lateral.php'; ?>

<!--caja principal -->
<div id="principal">
    <h1>Mis entradas</h1>
    <br>

    <?php $entradasPropias = entradasMias($db, $_SESSION['usuario']['id']);  ?>

    <?php if (mysqli_num_rows($entradasPropias) >= 1) : ?>
        <?php while ($arrayEntradas = mysqli_fetch_assoc($entradasPropias)) : ?>
            <article class="entrada">
                <a href="entrada-unica.php?id=<?= $arrayEntradas['id'] ?>">
                    <h2><?= $arrayEntradas['titulo'] ?></h2>
                    <span class="fecha"><?= $arrayEntradas['categoria'] . ' | ' . $arrayEntradas['fecha'] ?></span>
                    <p>
                        <?= substr($arrayEntradas['descripcion'], 0, 180) . '...' ?>
                        <br><br>
                    </p>
                </a>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <div>
            <p class=" epigrafe">Aún no has creado ninguna entrada, si desea crear una, vaya a crear entradas y podra crear una.</p>
        </div>
    <?php endif; ?>

</div>
<!-- fin principal -->

<!--Pie de pagina-->
<?php require_once 'includes/pie.php'; ?>