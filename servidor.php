<?php
$mysqli = new mysqli("localhost", "root", "", "colegio");
if ($mysqli->connect_errno) {
    echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{
    $resultado = $mysqli->query("SELECT * FROM alumno");
    $arrayNombres = [];
    for ($num_fila = $resultado->num_rows - 1 ; $num_fila >= 0 ; $num_fila--) { 
        $resultado->data_seek($num_fila);
        $fila = $resultado->fetch_assoc();
        $Nombres = $fila['nombre'];
        array_push($arrayNombres, $Nombres);
    }

    $nombre = $_GET['nombre'];
    $sugerencia = "";
    if ($nombre !== "") {
        //convertir a minusculas
        $nombre= strtolower($nombre);
        $cantidadDecaracteres = strlen($nombre);
        foreach($arrayNombres as $persona){
            $nombreEnServidor = substr($persona, 0, $cantidadDecaracteres);
            if (stristr($nombre, $nombreEnServidor) !== false) {
                if ($sugerencia === "") {
                    $sugerencia = "<li> $persona</li>";
                }else{
                    $sugerencia .= "<li> $persona</li>";
                }
            }
        }
    }
    echo $sugerencia === "" ? "<li>No fue encontrado</li>" : $sugerencia; 
    
}

/* REPASANDO CON FUNCIONES PARA CADESNAS
-----> $cadena = "Los colores primarios"; <------
substr($cadena, 5);
    como resutado obtenemos  =>  olores primarios
_______________________________________________________
substr($cadena, 5, 6);
    Como resultado obtenemos => olores
_______________________________________________________
stristr($cadena, "res");
ahora ver si una cadena está dentro de otra cadena o no
    como resultado obtenemos => res primarios
    AHORA APLICAMOS EN UNA IF:
    if(stristr($cadena, "res")){
        echo "res  ha sido encontrado en la cadena";
    }else{
        echo "res no fue encontrado en la cadena";
    }
_______________________________________________________
 */

?>