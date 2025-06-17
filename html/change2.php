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
</head>

<body>
    
    <?php 
   include('header.html');
      $arregloG=array();
    while($array2=$sql2->fetch(PDO::FETCH_ASSOC)) {
      if($array2['contenido']==null || isset($array2['contenido']) ){
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
         <a href="change2.php?genero=<?php print(strtoupper($genero)); ?>" class="book-button"><?php print(strtoupper($genero)); ?></a>
         <?php
        // code...
    }

    ?>
 <a href="change2.php" class="book-button">TODOS</a>
    <section class="books-section">
        <h2 class="section-title">Intercambio de Libros</h2>
        <div class="books-list">
        <?php 
        while($array=$sql->fetch(PDO::FETCH_ASSOC)) {
            if($array['contenido']==null || isset($array2['contenido']) ){
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
                
                <a href="#" class="book-button">Detalles</a>
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
                
                <a href="#" class="book-button">Detalles</a>
            </div>

            <?php
        }
    }
        }

        ?>
        
            
            
           
            
        </div>
    </section>
    




    <!-- Footer -->
    <!--  <footer class="footer">
        <p>2024 VersaBooks. All rights reserved.</p>
      </footer> -->

</body>

</html>