<?php

require 'include/templates/config/database.php';

$db = conectarDB();

$email = 'gutierrezvinicius9@gmail.com';
$contraseña ='1234';


$passwordhash = password_hash($contraseña,PASSWORD_DEFAULT);


$query ="INSERT INTO usuarios (gmail, contraseña) VALUES ('$email','$passwordhash')";


$resultado = mysqli_query($db,$query);









?>