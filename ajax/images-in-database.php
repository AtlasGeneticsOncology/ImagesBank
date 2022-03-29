<?php

include 'conexion.php';

$connection=new mysqli($hostname, $username, $password, $database);

// if (!$con) {
//     die("La conexión ha fallado: " . mysqli_connect_error());
// }
// echo "Conexión satisfactoria";
// mysqli_close($con);


// echo json_encode(array("error"=>True));

$image = $_REQUEST["q"];

//$newimage=filter_var($image, FILTER_SANITIZE_ENCODED); 
 $newimage=filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);

if(isset($image) && $image!="" && $image == $newimage) {

    $query=$connection->query("SELECT * FROM images WHERE legend LIKE '%{$image}%' LIMIT 16");
    $image = array();

    while($row=$query->fetch_assoc()){
        $image['name'][] = $row['filename'];
        $image['legend'][] = $row['legend'];
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($image);

}
else
{
    echo "ERROR";
}








