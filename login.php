<?php
require 'include/templates/config/database.php';
$db = conectarDB();

// Comprobar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contraseña = $_POST['password'];

    $campos = ['email', 'password'];
    $errores = [];
    
    foreach ($campos as $campo) {
        if (empty($_POST[$campo])) {
            $errores[] = "El campo $campo está vacío";
        }
    }
    
    if (!empty($errores)) {
        $mensaje = "Los siguientes campos son obligatorios: " . implode(', ', $errores);
        ?>
        <div class="Alerta error alerta-exito-auto-cerrable"><?php echo $mensaje; ?></div>
        <?php
    } else {
        // Realizar la consulta en la base de datos para verificar las credenciales
        $query = "SELECT contraseña FROM usuarios WHERE gmail = '$email'";
        $resultado = mysqli_query($db, $query);

        if (mysqli_num_rows($resultado) === 1) {
            $fila = mysqli_fetch_assoc($resultado);
            $hashAlmacenado = $fila['contraseña'];
            if (password_verify($contraseña, $hashAlmacenado)) {
                $mensajes = "Acceso concedido.";
                $en = true;
                session_start(); 
                $_SESSION['login'] = true;
                header('location:/bienesRaicesPHP_inicio/admin/index.php');
            } else {
                $mensaje2 = "contraseña incorrecta";
            }

           

        
        } else {
            $mensaje2 = "Acceso no concedido.";
        }
    }
}

mysqli_close($db);
?>

<?php
require 'include/funciones.php';
incluirTemplate('header');
?>

<?php if (!empty($camposVacios)) { ?>
<div class="Alerta error alerta-exito-auto-cerrable"><?php echo $mensaje; ?></div>
<?php } ?>


<main class="contenedor seccion contenido-centrado">

    <h1>Iniciar sesión</h1>


    <?php
    if ($en) {
        ?>
        <p class="alerta exito alerta-exito-auto-cerrable"> <?php echo $mensajes; ?> </p>
    <?php } else if (isset($mensaje2)) { ?>
        <p class="alerta error alerta-exito-auto-cerrable"><?php echo $mensaje2; ?></p>
    <?php } ?>


    <form class="formulario" method="POST">
        <fieldset>
            <legend>Email y contraseña</legend>

            <label for="email">Email</label>
            <input type="email" placeholder="Tu Email" id="email" name="email">

            <label for="password">Contraseña</label>
            <input type="password" placeholder="Tu Contraseña" id="password" name="password">
        </fieldset>

        <input type="submit" value="Iniciar sesión" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>
