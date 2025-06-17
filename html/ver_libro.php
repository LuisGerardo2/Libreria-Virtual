<?php
// Conectar a la base de datos
$mysql = new mysqli("localhost", "root", "", "libros");

// Verificar la conexión
if ($mysql->connect_error) {
    die("Error de conexión: " . $mysql->connect_error);
}

// Obtener el id del libro desde la URL
$id_Libro = isset($_GET['id']) ? $_GET['id'] : 0;

// Preparar la consulta para obtener el contenido del libro (PDF)
$query = "SELECT contenido FROM libros WHERE id_Libro = ?";
$stmt = $mysql->prepare($query);
$stmt->bind_param("i", $id_Libro);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($contenido);

if ($stmt->fetch()) {
    // Establecer las cabeceras para que se descargue el archivo PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="libro.pdf"');
    echo $contenido;
} else {
    echo "No se encontró el contenido del libro.";
}

// Cerrar la conexión
$stmt->close();
$mysql->close();
?>