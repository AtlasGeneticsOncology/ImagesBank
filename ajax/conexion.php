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
    return strtolower(trim(preg_replace('/[^a-zA-Z0-9;()\+]+/', '-', $str), '-'));
}

function fnGetLinkToImage(int $idAtlas,string $category,string $title){

    $URL="https://atlasgeneticsoncology.org/";

    $categories = array("hematological", "tumors", "genes", "cancer", "case", "deep", "teaching");
    $linksCategories = array("haematological","solid-tumor","gene","cancer-prone-disease","case-report","deep-insight","teaching");
    
    $positionCategory = array_search($category,$categories);

    $slug = fnFriendlyURL($title);

    return $URL."/{$linksCategories[$positionCategory]}/{$idAtlas}/{$slug}";


}

function fnGetPathCategory(int $category){
    $paths= array('cards_haematological','cards_tumours','cards_genes','cards_cancer_prone_diseases','cards_case_reports','cards_deep','cards_teaching');

    return $paths[$category];
}