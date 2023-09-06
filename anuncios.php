<?php

require 'include/funciones.php';

incluirTemplate('header');

?>

    <main class="contenedor seccion">

        <h2>Casas y Depas en Venta</h2>

        <?php 
        include 'include/templates/anuncios.php';
        ?>
          

        </div> <!--.contenedor-anuncios-->
    </main>

<?php
incluirTemplate('footer');
?>