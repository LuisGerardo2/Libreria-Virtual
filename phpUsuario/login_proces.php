<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include "../config.php";
include "../utils.php";
include "alerts.php";

try {
    $dbConn = connect($db);

    // Obtener datos del formulario
    $variable = $_POST['username'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $Query = "SELECT * FROM usuarios WHERE nombre_us = :nombre_us OR email = :email";
    $statement = $dbConn->prepare($Query);
    $statement->bindValue(':nombre_us', $variable);
    $statement->bindValue(':email', $variable);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $array = $statement->fetch(PDO::FETCH_ASSOC);

        if (($variable == $array['email'] || $variable == $array['nombre_us']) && $password == $array['password']) {
            $_SESSION['user']=$variable;
            header('Location:../html/change3.php');
        } else {
            
            ?>
            
            <?php
            crear();
            echo mostrar("Contraseña incorrecta. Por favor, inténtalo de nuevo.");
        }
    } else {
        crear();
        echo mostrar("Al parecer ese usuario no existe. Te invitamos a que te registres");
    }
} catch (Exception $e) {
    die("Error en el proceso: " . $e->getMessage());
}
?>
