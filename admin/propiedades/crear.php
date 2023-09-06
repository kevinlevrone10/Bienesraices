<?php

session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: /bienesRaicesPHP_inicio/index.php');
    exit;
}

require '../../include/templates/config/database.php';

$db =conectarDB();

$consulta = "select *from vendedores";
$resultado = mysqli_query($db,$consulta);

//var_dump($_POST);

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedor_id = '';


date_default_timezone_set('America/Managua');
if($_SERVER['REQUEST_METHOD']==='POST')
{
$titulo = mysqli_real_escape_string($db, $_POST['titulo']);
$precio = mysqli_real_escape_string($db, $_POST['precio']);
$descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
$habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
$wc = mysqli_real_escape_string($db, $_POST['baños']);
$estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
$vendedor_id = mysqli_real_escape_string($db, $_POST['vendedor']);
$imagen = $_FILES['imagen'];
$tamano_archivo = $_FILES['imagen']['size'];
$name = $_FILES['imagen']['name'];

    // Validar campos obligatorios
    $camposObligatorios = ['titulo', 'precio', 'descripcion', 'habitaciones', 'baños', 'estacionamiento',  'vendedor'];
    $camposVacios = [];
    foreach($camposObligatorios as $campo){
        if(empty($_POST[$campo])){
            $camposVacios[] = $campo;
        }
    }

    if ($_FILES['imagen']['error'] !== UPLOAD_ERR_OK || empty($_FILES['imagen']['name'])) {
        $camposVacios[] = 'imagen';
    }
    
    if(!empty($camposVacios)){
    $mensaje = "Los siguientes campos son obligatorios: " . implode(', ', $camposVacios);
    }else{

        $carpeta = "../../imagenes/";

        if(!is_dir($carpeta)){
            mkdir($carpeta);
        }
        
        //subir la imagen

        $nombre  =md5(uniqid(rand(),true)).".jpg"; // crea el nombre unico
        move_uploaded_file($imagen['tmp_name'],$carpeta.$nombre); // aqui la mete en la carpeta

        $query = "INSERT INTO propiedades (titulo, precio,imagen, descripcion, habitaciones, baños, estacionamientos, creado, vendedores_id) 
        VALUES ('$titulo', '$precio', '$nombre', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', NOW(), '$vendedor_id')";
        $resultado =mysqli_query($db ,$query);
    }

    if($resultado && empty($camposVacios) ){
        header('location:/bienesRaicesPHP_inicio/admin/index.php?resultado=1');
    } 

}
   

require '../../include/funciones.php';

incluirTemplate('header');

?>

<?php 
 echo $creado;
 ?>




<main class="contenedor seccion">

<h1>Crear</h1>   
<a href="/bienesRaicesPHP_inicio/admin/index.php" class="boton boton-verde">Volver</a>



<?php   if(!empty($camposVacios)){ ?>
<div class="Alerta error alerta-exito-auto-cerrable"><?php echo $mensaje;?></div>
<?php } ?>

<?php   if($tamano_archivo>1000000){ ?>
<div class="Alerta error"><?php echo "Imagen muy grande"; ?></div>
<?php } ?>


<form class="formulario" method="post" action="/bienesRaicesPHP_inicio/admin/propiedades/crear.php"  enctype="multipart/form-data">

    <fieldset>
        <legend>Información general</legend>

        <label for="titulo">Titulo: </label>
        <input type="text" placeholder="Titulo propiedad" name="titulo" id="titulo" value="<?php echo $titulo; ?>">

        <label for="precio">Precio: </label>
        <input type="number" placeholder="Precio propiedad" name="precio" id="precio" value="<?php echo $precio; ?>">

        <label for="imagen">Imagen: </label>
        <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

        <label for="descripcion">Descripción: </label>
        <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
    </fieldset>

    <fieldset>
        <legend>Información de la propiedad</legend>

        <label for="habitaciones">habitaciones</label>
        <input type="number" name="habitaciones" id="habitaciones" placeholder="Número de habitaciones" min="1" value="<?php echo $habitaciones; ?>">

        <label for="baños">Baños</label>
        <input type="number" name="baños" id="baños" placeholder="Ej: 2" min="1" value="<?php echo $wc; ?>">

        <label for="estacionamiento">estacionamiento</label>
        <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" value="<?php echo $estacionamiento; ?>">
    </fieldset>

    <fieldset>
        <legend>Vendedor's</legend>

        <select name="vendedor">
        <option value="">--selecione---</option>
        <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
        <option value="<?php echo $vendedor['id']; ?>" <?php if ($vendedor_id == $vendedor['id']) echo "selected"; ?>>
        <?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']; ?>
        </option>
        <?php endwhile; ?>
        </select>

    </fieldset>
    
    <div class="centrado">
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </div>

</form>

</main>

<?php
incluirTemplate('footer');
?>