<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include "../config.php";
include "../utils.php";
$dbConn =  connect($db);


// Obtener datos del formulario
$nombre_cu = $_POST['name'];
$nombre_us = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Buscar el usuario en la base de datos
$Query = "SELECT * FROM usuarios WHERE nombre_us =:nombre_us";
$statement = $dbConn->prepare($Query);
$statement->bindValue(':nombre_us',$_POST['username']);
$statement->execute();

if ($statement === false) {
    die("Error al ejecutar la consulta: " . $mysql->error);
}
$array=$statement->fetch(PDO::FETCH_ASSOC);
echo $statement->rowCount();
if ($statement->rowCount()> 0 ) {
     // Obtener la fila de resultados
    
    // Verificar la contraseña
    if ($email==$array['email']){
        
        echo '<script> alert("Lo sentimos el nombre de usuario o correo ya estan ocupados");window.location.replace("register.html");</script>';
        }else{ 
        echo '<script> alert("Nombre de usuario ocupado");location.replace("register.html"); </script>';
        
    }
        exit; // Finalizar el script después de redirigir
        
} else {
    // Si el nombre de usuario no esta usado lo registra
       $_SESSION['name']=$nombre_cu ;
        $_SESSION['username']=$nombre_us;
        $_SESSION['email']=$email;
        $_SESSION['password']=$password;
        header('Location: ../phpUsuario/registerBasepro.php') ;
?>
<?php
    
    exit; // Finalizar el script después de redirigir
}

// Cerrar la conexión
$mysql->close();
?>
