<?php
//importar la db

require 'include/templates/config/database.php';

$db = conectarDB();
$numero_propiedades = num_propiedades(); 

//consultar
$query = "SELECT *FROM propiedades LIMIT  ".$numero_propiedades;

//obtener resultados
$resultado = mysqli_query($db,$query);


?>


<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
            <div class="anuncio">
               
                   
               <img class="img" loading="lazy" src="imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio">
         

                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad['titulo']; ?></h3>
                    <p><?php echo $propiedad['descripcion']; ?></p>
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

                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!--.contenido-anuncio-->
            </div><!--anuncio-->

            <?php endwhile;?>
        </div> <!--.contenedor-anuncios-->
<?php

//cerrar la conexion

?> 