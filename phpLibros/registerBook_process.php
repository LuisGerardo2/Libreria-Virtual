<?php 

$servidor="localhost";
$clave="";
$base="libros";
$conn = new mysqli($servidor, "root", $clave);
$conn->set_charset("utf8mb4");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$db = mysqli_select_db( $conn, $base ) or die ( "Upps! Pues va a ser que no se ha encontrado la base ");
$titulo= utf8_decode($_POST['titulo']);
$autores=utf8_decode($_POST['autores']);
$apublicacion=utf8_decode($_POST['apublicacion']);
$generos=strtoupper(utf8_decode($_POST['generos']));
$sinopsis=utf8_decode($_POST['sinopsis']);
$resenas=utf8_decode($_POST['resenas']);
//$Cantidad=utf8_decode($_POST['CANTIDAD']);
$portada=addslashes(file_get_contents($_FILES['portada']['tmp_name']));
$archivo = file_get_contents($_FILES["contenido"]["tmp_name"]); 
$tipo    = $_FILES["contenido"]["type"];

$sql ="INSERT INTO libros(titulo,autores,apublicacion,generos,sinopsis,resenas,portada,contenido,tipo) VALUES ('$titulo','$autores','$apublicacion','$generos','$sinopsis','$resenas','$portada',?,'$tipo');";
$stmt = $conn->prepare($sql);
            
// Verificar si la preparación de la consulta fue exitosa
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("s", $archivo);

// Intentar ejecutar la consulta
if ($stmt->execute()) {
} else {
    echo "<p style='text-align: center; color: red;'>Error al actualizar el contenido del libro: " . $stmt->error . "</p>";
}

$stmt->close();

$conn->close();
?>