<?php
require("valida.php");
include "../config.php";
include "../utils.php";
error_reporting(0);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido");
}

$idL = $_GET['id'];
$dbConn = connect($db);
$sql = $dbConn->prepare("SELECT * FROM libros WHERE id_Libro = :id");
$sql->bindParam(':id', $idL, PDO::PARAM_INT);
$sql->execute();
$array = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>VersaBooks</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/change.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        label { font-family: "Arial Black", sans-serif; }
        .book-detail {
            background: rgb(60, 179, 113, .6);
            
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            border-radius: 20%;
        }
    </style>
</head>
<body>
    <div class="book-detail" id="div">
        <center><strong><?= htmlspecialchars($array['titulo']) ?></strong></center>
        <?php if ($array['portada']) { ?>
            <img src="data:image/jpg;base64,<?= base64_encode($array['portada']) ?>" style="width: 40%; height: 40%; margin-left: 120px;">
        <?php } else { ?>
            <img src="../img/no-portada.jpg" style="width: 40%; height: 40%; margin-left: 120px;">
        <?php } ?>
        <table style="width: 100%;">
            <tr>
                <td><label>Autor(es):</label> <?= htmlspecialchars($array['autores']) ?></td>
                <td><label>Año:</label> <?= htmlspecialchars($array['apublicacion']) ?></td>
            </tr>
            <tr>
                <td><label>Sinopsis:</label> <?= htmlspecialchars($array['sinopsis']) ?></td>
                <td><label>Reseña:</label> <?= htmlspecialchars($array['resenas']) ?></td>
            </tr>
        </table><br><br>
        <button class="book-author" style="margin-left: 40%;" onclick="cerrar();">Cerrar</button>
    </div>
    <script>
        function cerrar() {
            document.getElementById('div').style.display = 'none';
        }
    </script>
</body>
</html>
