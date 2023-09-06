<?php

session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: /bienesRaicesPHP_inicio/index.php');
    exit;
}



require '../include/funciones.php';

incluirTemplate('header');
//importar la conexion a la db
require '../include/templates/config/database.php';
$db = conectarDB();


$resultado = $_GET['resultado'] ?? null;


//escribir el query
$query = "SELECT *FROM propiedades";


//consultar la db
$resultado2 = mysqli_query($db,$query);

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $id = $_POST['id'];

    $id=filter_var($id,FILTER_VALIDATE_INT);

    if($id){

        $query = "SELECT imagen FROM propiedades where id= ".$id;

        $resultado = mysqli_query($db,$query);
        $propiedad = mysqli_fetch_assoc($resultado);


        if(!unlink('../imagenes/'.$propiedad['imagen'])){
            echo "Error al eliminar la imagen: ".$_SERVER['DOCUMENT_ROOT'].'/bienesRaicesPHP_inicio/imagenes/'.$propiedad['imagen'];
        }
      

        //eliminar la propiedad;
        $query = "DELETE FROM propiedades where id =".$id;
        $resultado = mysqli_query($db,$query);

       if($resultado)
       {
        header('location:/bienesRaicesPHP_inicio/admin/index.php?resultado=3');
       }
    }

}


?>


<main class="contenedor seccion">

<h1>Admin</h1>   

<?php 
if (intval($resultado) === 1) { 
?>
    <p class="alerta exito alerta-exito-auto-cerrable">Anuncio creado correctamente</p>
<?php 
} else if (intval($resultado) === 2) { 
?>
    <p class="alerta exito alerta-exito-auto-cerrable">Anuncio actualizado correctamente</p>
<?php 
} else if (intval($resultado) === 3) {
?>
    <p class="alerta exito alerta-exito-auto-cerrable">Anuncio eliminado correctamente</p>
<?php 
}
?>




<a href="/bienesRaicesPHP_inicio/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

<table class="propiedades">
  <thead>

<tr>

<th>ID</th>
<th>Titulo</th>
<th>Imagen</th>
<th>Precio</th>
<th>Acciones</th>

</tr>

</thead>

<tbody> <!--traer los datos-->


<?php while($propiedad = mysqli_fetch_assoc($resultado2)): ?>

<tr>
    <td><?php echo $propiedad['id']; ?></td>
    <td><?php echo $propiedad['titulo']; ?></td>
    <td><img src="/bienesRaicesPHP_inicio/imagenes/<?php echo $propiedad['imagen']; ?>" class="img-tabla"></td>
    <td><?php echo $propiedad['precio']; ?></td>
    <td>
        <form method="POST" class="w-100">

        <input type="hidden" name="id" value="<?php echo $propiedad['id'] ?>">

        <input type="submit" class="boton-rojo-block" value="Eliminar">

        </form>
        <a href="/bienesRaicesPHP_inicio/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id'];?>" class="boton-verde-block">Actualizar</a>
    </td>
</tr>

<?php endwhile; ?>

</tbody>
</table>
</main>

<?php
mysqli_close($db);
incluirTemplate('footer');
?>