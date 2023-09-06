<?php

require 'include/funciones.php';
incluirTemplate('header');

$id=$_GET['id'];
$id = filter_var($id,FILTER_VALIDATE_INT);


require './include/templates/config/database.php';

$db = conectarDB();

$query = "SELECT * FROM propiedades WHERE id =".$id;


$resultado = mysqli_query($db,$query);


?>


<?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <main class="contenedor seccion contenido-centrado">

        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad['baños']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad['estacionamientos']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                        </li>
                    </ul>

                    <p><?php echo $propiedad['descripcion'] ?></p>

           
        </div>
       
        
    </main>
    <?php endwhile;?>

<?php
incluirTemplate('footer');
?>