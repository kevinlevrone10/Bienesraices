<?php

require 'app.php';

function incluirTemplate(string $nombre , bool $inicio=false)
{
include TEMPLATES_URL."/$nombre.php";
}


function logeado(){
    
    session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: /bienesRaicesPHP_inicio/index.php');
    exit;
}
}