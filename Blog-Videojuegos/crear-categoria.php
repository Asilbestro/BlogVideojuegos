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
     <h1>Crear categorias</h1>
     <p>
         Añade nuevas categorias al blog para que los usuarios puedan usuarlas al crear sus entradas.
     </p>
     <br>

     <form action="accions/guardar-categoria.php" method="POST">

         <label for="nombre">Nombre de la categoria:</label>
         <input type="text" name="nombre">
         <?php echo isset($_SESSION['errores_categoria']) ? mostrarError($_SESSION['errores_categoria'], 'nombre') : ''; ?>


         <input type="submit" value="Guardar">
     </form>
     <?php borrarErrores(); ?>
 </div>

 <!--Pie de pagina-->
 <?php require_once 'includes/pie.php'; ?>