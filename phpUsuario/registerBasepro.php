<?php
session_start();

echo '<script type="text/javascript">alert("Te has registrado correctamente, se refrescara la pagina para que inices sesion");</script>';
$mysql = new mysqli("localhost", "root", "", "libros");

// Verificar la conexión
if ($mysql->connect_error) {
    die("Error de conexión: " . $mysql->connect_error);
}

// Obtener datos del formulario de registro
$nombre_cu = $_SESSION['name'];
$nombre_us = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

print_r($_SESSION);
$sql = "INSERT INTO usuarios (nombre_cs, nombre_us, email, password) VALUES (?, ?, ?, ?)";
$stmt = $mysql->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssss", $nombre_cu, $nombre_us, $email, $password);

    if ($stmt->execute()) {
        echo '<script type="text/javascript">alert("Te has registrado correctamente, se refrescara la pagina para que inices sesion");location.replace("login.html")
                // body...
        </script>';
    } else {
        echo "Error al insertar usuario: " . $stmt->error;
    }
} else {
    echo "Error en la preparación de la consulta: " . $mysql->error;
}

$stmt->close();
$mysql->close();
?>
