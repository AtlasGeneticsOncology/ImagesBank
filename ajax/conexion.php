<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'practica';

$connection=new mysqli($hostname, $username, $password, $database);



if (!$connection) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}


function fnFriendlyURL(string $str)
{
    //return preg_replace('/\W+/', '-', strtolower($str));
    //return strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $str), '-'));
    return strtolower(trim(preg_replace('/[^a-zA-Z0-9;()\+]+/', '-', $str), '-'));
}

function fnGetLinkToImage(int $idAtlas,string $category,string $title){

    $URL="https://atlasgeneticsoncology.org/";

    $categories = array("hematological", "tumors", "genes", "cancer", "case", "deep", "teaching");
    $linksCategories = array("haematological","solid-tumor","gene"."cancer-prone-disease","case-report","deep-insight","teaching");
    
    $positionCategory = array_search($category,$categories);

    $slug = fnFriendlyURL($title);

    return $URL."/{$linksCategories[$positionCategory]}/{$slug}";


}