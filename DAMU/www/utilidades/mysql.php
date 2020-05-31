<?php
$configuración = array(
    'bbdd' => array(
        'host' => 'db',
        'usuario' => 'root',
        'contraseña' => 'test',
        'basedatos' => 'myDb',
        'codificación' => 'utf8'
    ),
);

function Conectar($configuracion = array())
{
    $conexion=mysqli_connect($configuracion['host'], $configuracion['usuario'],
        $configuracion['contraseña'],$configuracion['basedatos']);
    mysqli_set_charset($conexion,$configuracion['codificación']);
    return ($conexion);
}

function Desconectar($conexion)
{
    mysqli_close($conexion);
    unset($conexion);
}

function Actualizar($conexion, $sql)
{
    return (mysqli_query($conexion, $sql));
}

function Consultar($conexion, $sql)
{
    $resultado = mysqli_query($conexion, $sql);
    if($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH))
    {
        do{
            $datos[] = $fila;
        }while($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH));
    }
    else
    {
        $datos = null;
    }
    mysqli_free_result($resultado);
    return ($datos);
}
//funcion para consulta de nombres de usuario
 function Mostrarusu () {
	$conexion = mysqli_connect('db', 'root', 'test', 'myDb') or die("Problemas con la conexion");
$registros = mysqli_query($conexion, "SELECT nombre, id FROM users")
	or die("Problemas en la consulta:".mysqli_error($conexion));
echo "<h1>Lista de Usuarios Registrados </h1>";	
echo "<table class='table table-striped' style='background-color: white' font color='red'>";
echo "<tr><th>Nombre Usuario</th><th>Id usuario</th>";
while ($reg = mysqli_fetch_array($registros)) {
  //$img = $reg['img'];
	echo "<tr>";
		echo "<td>" . $reg['nombre'] . "</td>";
		echo "<td>" .  $reg['id'] . "</td>";
	echo "</tr>";
   
}
echo "</table>";
}

/*function existeUsuario($conexion, $sqlUsuario)
{
    
    $resultado2 = mysqli_query($conexion, $sqlUsuario)
     if($fila = mysqli_fetch_array($resultado2, MYSQLI_BOTH))
    {
        do{
            $datos[] = $fila;
        }while($fila = mysqli_fetch_array($resultado2, MYSQLI_BOTH));
    }
    else
    {
        $datos = null;
    }

}*/
?>
