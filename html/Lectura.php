<?php
require("valida.php");
include "../config.php";
include "../utils.php";
error_reporting(0);
$dbConn =  connect($db);
$filtrar=false;
$generoa="";
if(isset($_GET['genero'])){
    $filtrar=true;
    $generoa=$_GET['genero'];

}

$sql = $dbConn->prepare("SELECT * FROM libros;");
   $sql->execute();
   $sql->setFetchMode(PDO::FETCH_ASSOC);
  
  $sql2 = $dbConn->prepare("SELECT * FROM libros;");
   $sql2->execute();
   $sql2->setFetchMode(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VersaBooks</title>
    <link rel="stylesheet" href="..\css/style.css">
    <link rel="stylesheet" href="..\css/change.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
          /* Estilos para la ventana emergente (modal) */
          .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            width: 80%;
            max-width: 900px;
            position: relative;
            overflow: hidden;
        }

        /* Contenedor del visor de PDF *
    /* Ajustar el visor PDF para agregar desplazamiento */
    #pdfViewer {
        width: 100%;
        height: 600px;justify-content: center; /* Centrar horizontalmente */

        overflow-y: auto;
        overflow-x: hidden;
        border: 1px solid #ddd;
        padding: 10px;
        box-sizing: border-box;
        background-color: #f5f5f5;
    }

        .controls {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .controls button {
            padding: 10px;
            background-color: #2092B8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .controls button:hover {
            background-color: #157a94;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #333;
            cursor: pointer;
        }
    </style>
</head>

<body>
    
    <?php 
   include('header.html');
      $arregloG=array();
    while($array2=$sql2->fetch(PDO::FETCH_ASSOC)) {
      if($array2['contenido']==null){
       
      }else{
        
        $generos=explode(",",$array2['generos']);
        foreach ($generos as $nombreG) {
            if (in_array($nombreG, $arregloG)){

                // code...
            }else{
                array_push($arregloG, $nombreG);
            }
            // code...
        }
    }

    }

    foreach ($arregloG as $genero) {?>
         <a href="Lectura.php?genero=<?php print(strtoupper($genero)); ?>" class="book-button"><?php print(strtoupper($genero)); ?></a>
         <?php
        // code...
    }

    ?>
 <a href="Lectura.php" class="book-button">TODOS</a>
    <section class="books-section">
        <h2 class="section-title">Intercambio de Libros</h2>
        <div class="books-list">
        <?php 
        while($array=$sql->fetch(PDO::FETCH_ASSOC)) {
            if($array['contenido']==null || isset($array2['contenido']) ){}else{
          $comprobar=explode(",", $array['generos']);
          $mayus=array_map('strtoupper', $comprobar);
            if($filtrar) {
            if(in_array($generoa,$mayus)){
                // code...
            
            
            ?>
            <div class="book">
                <img src="data:image/jpg;base64,<?php echo base64_encode($array['portada'])?>" alt="Libro 1" class="book-image">
                <h3 class="book-title"><?php print($array['titulo']); ?></h3>
                <?php 
                $autors=explode(",", $array['autores']);
                for($i=0;$i<count($autors);$i++){
                    ?>
                    <p class="book-author"><?php print($autors[$i]); ?></p>
                <?php
                }

                ?>
                
                <a href="#" class="book-button" onclick="mostrarModal(<?php print($array['id_Libro']);?>)">Leer</a>
            </div>

            <?php
        }
        }else{
            ?>
<div class="book">
                <img src="data:image/jpg;base64,<?php echo base64_encode($array['portada'])?>" alt="Libro 1" class="book-image">
                <h3 class="book-title"><?php print($array['titulo']); ?></h3>
                <?php 
                $autors=explode(",", $array['autores']);
                for($i=0;$i<count($autors);$i++){
                    ?>
                    <p class="book-author"><?php print($autors[$i]); ?></p>
                <?php
                }

                ?>
                
                <a href="#" class="book-button" onclick="mostrarModal(<?php print($array['id_Libro']);?>)">Leer</a>
            </div>

            <?php
        }
    }
        }

        ?>
        
            
            
           
            
        </div>
    </section>
    


    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <!-- Contenedor para el visor de PDF -->
            <div id="pdfViewer"></div>
            <div class="controls">
                <button id="prevPageBtn">Anterior</button>
                <button id="nextPageBtn">Siguiente</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!--  <footer class="footer">
        <p>2024 VersaBooks. All rights reserved.</p>
      </footer> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

<script>
    var pdfDoc = null;
    var currentPage = 1;
    var totalPages = 0;

    function mostrarModal(id) {
        
        const modal = document.getElementById('modal');
        modal.style.display = 'flex';  // Mostrar el modal

        // Cargar el PDF usando PDF.js
        const url = `ver_libro.php?id=${id}`;
        pdfjsLib.getDocument(url).promise.then(function (pdf) {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            renderPage(currentPage);
        }).catch(function(error) {
            alert("Erro cargar el PDF: " + error.message);
        });
    }

    function renderPage(pageNum) {
        pdfDoc.getPage(pageNum).then(function (page) {
            var scale = 1.3;
            var viewport = page.getViewport({ scale: scale });

            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            page.render({
                canvasContext: ctx,
                viewport: viewport
            });

            var pdfViewer = document.getElementById('pdfViewer');
            pdfViewer.innerHTML = '';  // Limpiar el visor
            pdfViewer.appendChild(canvas);  // Agregar la nueva página

            document.getElementById('prevPageBtn').disabled = currentPage === 1;
            document.getElementById('nextPageBtn').disabled = currentPage === totalPages;
        });
    }

    document.getElementById('prevPageBtn').addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            renderPage(currentPage);
        }
    });

    document.getElementById('nextPageBtn').addEventListener('click', function () {
        if (currentPage < totalPages) {
            currentPage++;
            renderPage(currentPage);
        }
    });

    function cerrarModal() {
        const modal = document.getElementById('modal');
        modal.style.display = 'none';  // Ocultar el modal
        pdfDoc = null; 
        url=""; // Limpiar el documento PDF
    }
</script>

</body>

</html>