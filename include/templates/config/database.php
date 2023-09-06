<?php


function conectarDB ():mysqli{
    $db = mysqli_connect('localhost','root','ruth','bienesraices_crud');

    if(!$db)
    {
    echo"no se hizo";
    exit;
    }

    return $db;
    
}

function num_propiedades():int
{
$num_propiedades = 3;

return $num_propiedades;

}