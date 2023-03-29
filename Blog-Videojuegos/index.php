<!-- Cabecera -->
<?php require_once 'includes/cabecera.php' ?>

<!--barra lateral-->
<?php require_once 'includes/lateral.php' ?>


<!--caja principal -->
<div id="principal">
    <h1>Ultimas entradas</h1>

    <!-- Crea las utlimas 4 entradas en el nav de la pagina -->
    <?php
    $entradas = ConseguirEntradas($db, 4);
    if (!empty($entradas)) :
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
    <?php
        endwhile;
    endif;
    ?>

    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div>
<!-- fin principal -->

<!--Pie de pagina-->
<?php require_once 'includes/pie.php'; ?>