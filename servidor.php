<?php
$mysqli = new mysqli("localhost", "root", "", "colegio");
if ($mysqli->connect_errno) {
    echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{
    echo "Conexion exitosa <br>";
    $resultado = $mysqli->query("SELECT * FROM alumno");
    $arrayNombres = [];
    for ($num_fila = $resultado->num_rows - 1 ; $num_fila >= 0 ; $num_fila--) { 
        $resultado->data_seek($num_fila);
        $fila = $resultado->fetch_assoc();
        $listaNombres = $fila['nombre'];
        array_push($arrayNombres, $listaNombres);
    } 
}
$nombre = $_POST['nombre'];
$sugerencia = "";
if($nombre !== ""){
    $nombre = strtolower($nombre);
    foreach($arrayNombres as $personas){
        $nombreEnServidor = substr($personas, 0, $cantidadCaracteres);
        if (stristr($nombre, $nombreEnServidor) !== false) {
            if ($sugerencia === "") {
                $sugerencia = $personas;
            }else{
                $sugerencia .= ", $personas";
            }
        }
    }
}
?>