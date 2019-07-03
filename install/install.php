<?php

/**
 * install :
 * 
 * Ce framework doit être automatisé et optimisé au maximum, donc création des tables utiles de base ici
 * le but est que si jamais j'ai un souci je puisse restart la base entière
 */
require '../db/db.php';

$db = new DB();

$testnom = "test";
$testvariable = [
    "name" => "VARCHAR (20)",
    "age" => "DOUBLE"
];


$reussite = $db->CreateDatabase($testnom);
if(!$reussite[0]) {
    print_r($reussite[1]);
}
//DB->query($query);