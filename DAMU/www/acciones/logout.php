<?php session_start();?>
<?php
ob_start();?>
<!DOCTYPE html>
 <head>
 <meta charset="UTF-8">
 <title>Logout</title>
 </head>
 <body> 
<?php    
    echo "<pre>";          
    $_SESSION['iniciada'] = false;
    header("location:../index.php");
    echo "</pre>";
?>
 </body>
</html>
<?php
ob_end_flush();
?>
