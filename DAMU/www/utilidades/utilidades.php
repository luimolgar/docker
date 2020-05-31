<?php
function Depurar($variable)
{
    $depuracion = debug_backtrace();
    echo "<br>";
    echo "<pre>";
    echo $depuracion[0]['file'] . " " . $depuracion[0]['line'] . "<br>";
    print_r($variable);
    echo "</pre>";
    echo "<br>";
}
?>