
<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesRaicesPHP_inicio/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio  ? 'inicio' :'' ; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesRaicesPHP_inicio/index.php">
                    <img src="/bienesRaicesPHP_inicio/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/bienesRaicesPHP_inicio/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/bienesRaicesPHP_inicio/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>
   
                
            </div> <!--.barra-->

            <?php 
            if ($inicio) {
            echo "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>";
            }
            ?>

           
         
           
        </div>
    </header>