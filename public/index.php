<?php

//print_r($_SERVER['REQUEST_URI']);

// route :
/**
 * route :
 * 
 * envoyer vers le bon endroit du site avec potentiellement des params (mais pas obligatoire)
 */
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<meta http-equiv='X-UA-Compatible' content='ie=edge'>";
echo "<title>Portfolio</title>";
echo "</head>";

$tokens = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));

include ('../install/install.php');

/*

if (isset($tokens[1])) {
    echo ("Yeet route : ". $route);
}
else {
    echo ("domaj route : ". $route);
}*/