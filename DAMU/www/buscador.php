<?php
ob_start();
?>
<?php

    //Variable que contendrá el resultado de la búsqueda

    $texto = "";

    //Variable que contendrá el número de resgistros encontrados

    $registros = "»";

    if($_POST){

    $busqueda = trim($_POST['buscar']);

    $entero = 0;

    if (empty($busqueda)){

    $texto = 'Búsqueda sin resultados';

    }else{

        // Si hay información para buscar, abrimos la conexión
        $conexion = mysqli_connect('db', 'root', 'test', 'myDb') or die("Problemas con la conexión");
        //Ejecución de la consulta
        $consulta = mysqli_query($conexion, "SELECT nombreuser, img, date_format(fecha,'%d/%m/%Y') as fecha2
                                                FROM documentos where nombreuser = '" .$busqueda. "' order by fecha2 desc")
        or die("Problemas en la consulta:".mysqli_error($conexion));

        //Si hay resultados…

        if (mysqli_num_rows($consulta) > 0){

            // Se recoge el número de resultados

            $registros = '<p>HEMOS ENCONTRADO ' . mysqli_num_rows($consulta) . ' registros </p>';

            // Se almacenan las cadenas de resultado
            echo "<table class='table table-striped' style='background-color: white'>";
                echo "<tr><th>Subido por:</th><th>Fecha de nómina/contrato:</th>";
                while($fila = mysqli_fetch_assoc($consulta)){
                $img = $fila['img'];
                        echo "<tr>";
                            echo "<td>" . $fila['nombreuser'] . "</td>";
                            echo "<td>" . $fila['fecha2'] . "</td>";
                            echo "<td>" . " <img src='recursos/$img' border='0' width='300' height='100'>" . "</td>";
                        echo "</tr>";

               // $texto .= $fila['nombreuser'] . '<br />'; //Imprime el nombre del usuario que ha subido la foto tantas veces como documentos haya

                }

        }else{ 
            $texto = "Este usuario no existe o no tiene documentos subidas";
        }
        mysqli_close($conexion);
        }

    }


// Resultado, número de registros y contenido.

echo $registros;
echo $texto;

echo "<br>";
echo "<a href=\"index.php\">Volver a inicio</a>";

?>

<?php
ob_end_flush();
?>
