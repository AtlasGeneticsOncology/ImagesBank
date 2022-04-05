<?php
include 'conexion.php';

header('Content-Type: application/json; charset=utf-8');

$allowedCategories = array("hematological", "tumors", "genes", "cancer", "case", "deep", "teaching");

if (!isset($_REQUEST['q']) || empty($_REQUEST['q']) || $_REQUEST['q']==" ") {
    echo json_encode(array("error" => true, "message" => "Parameters are not valid"));
    die();
}


$querySearch = filter_var($_REQUEST["q"], FILTER_SANITIZE_SPECIAL_CHARS);



$QUERY = "SELECT * FROM images WHERE legend LIKE '%{$querySearch}%' ";


if (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) {
    $category = filter_var($_REQUEST['category'], FILTER_SANITIZE_SPECIAL_CHARS);
    
    if (!in_array(strtolower($category), $allowedCategories)) {
        echo json_encode(array("error" => "true", "message" => "Category is not valid"));
        die();
    }
    
    $QUERY .= " AND `category` = '{$category}' ";
}
$images_per_page=16;

$page = $_REQUEST['pages'];

$image = array();

$from = ($page - 1)*$images_per_page;

#$limit = $page * $images_per_page;

$query = $connection->query($QUERY . " LIMIT ".$from.",".$images_per_page);
#$query = $connection->query($QUERY);

while ($row = $query->fetch_assoc()) {
    $image['name'][] = $row['filename'];
    if (strlen($row['legend']) > 150){
        $image['legend'][] = substr($row['legend'],0,150)."...";
    }
    else{
        $image['legend'][] = substr($row['legend'],0,150);
    }
    $image['link'][] = fnGetLinkToImage($row['idAtlas'],$row['category'],$row['title']);
    $image['categories'][] = fnGetPathCategory(array_search($row['category'],$allowedCategories));
    $image['title'][] = $row['title'];
}

$countimage=$connection->query("SELECT COUNT(idImage) FROM images WHERE legend LIKE '%{$querySearch}%'");

$total=$countimage->fetch_row();

settype($total[0], 'integer');

$image['total']= ceil($total[0] / $images_per_page);


if(count($image) == 0){
    echo json_encode(array("error"=>true,"message"=>"Images is not found"));
    die();
}

echo json_encode($image);
