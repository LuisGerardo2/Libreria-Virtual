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
        label { font-family: "Arial Black", sans-serif; }
        .book-detail {
            background: #2a4a3a;
            color: white;
            height: auto;
            width: 400px;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            border-radius: 20%;
        }
    </style>
</head>

<body>


    <!-- Header -->
   
    <?php 
    include('header.html');
   
      $arregloG=array();
    while($array2=$sql2->fetch(PDO::FETCH_ASSOC)) {
      
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
    
    foreach ($arregloG as $genero) {?>
         <a href="change3.php?genero=<?php print(strtoupper($genero)); ?>" class="book-button"><?php print(strtoupper($genero)); ?></a>
         <?php
        // code...
    }

    ?>
   

    </div>

            
            </div>
 <a href="change3.php" class="book-button">TODOS</a>
    <section class="books-section">
        <h2 class="section-title">Intercambio de Libros</h2>
        <div class="books-list">
        <?php 
        $array=array();
        while($array=$sql->fetch(PDO::FETCH_ASSOC)) {
          $comprobar=explode(",", $array['generos']);
          $mayus=array_map('strtoupper', $comprobar);
            if($filtrar) {
            if(in_array($generoa,$mayus)){
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
                
                <button class="book-button" onclick="mostrar(<?php echo "'".$array['titulo']."'";?>);">Detalles </button>
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
                <button class="book-button" onclick="mostrar(<?php echo "'".$array['titulo']."'";?>,<?php echo "'".base64_encode($array['portada'])."'"; ?>,<?php echo "'".$array['autores']."'";?>,<?php echo "'".$array['apublicacion']."'";?>,<?php echo "'".$array['sinopsis']."'";?>,<?php echo "'".$array['resenas']."'";?>);">Detalles </button>
                
            </div>

            <?php

        }
        }


        ?>
       
       
    </section>
<div class="book-detail" id="div" style="display: none;">
   

   
</div>




<div style="height: 60px;"></div>



    <!-- Footer -->
    <footer class="footer" >
        <p>2024 VersaBooks. All rights reserved.</p>
      </footer>

</body>
<script type="text/javascript">
    function mostrar(a,b,c,d,e,f) {
const div=document.getElementById('div');
    div.style.display = 'block';
    div.style.position = 'flex';
    div.innerHTML='<center><h1>'+a+'</h1></center><img src="data:image/jpg;base64,'+''+b+'"'+' style="width: 40%; height: 40%; margin-left: 120px;"><table style="width:100%;"><tr> <td><label>Autor(es):'+c+'</label></td><td><label>Año:'+d+'</label></td></tr><tr><td><label>Sinopsis:'+e+'</label> </td><td><label>Reseña:'+f+'</label></td> </tr></table><br><br><button class="book-button" style="margin-left: 150px" onclick="cerrar();">Cerrar</button>';
    var z=div.offsetHeight;;
    if(z>300){
        div.style.top='10%';
    }

}

function cerrar() {
    document.getElementById('div').style.display = 'none';
}
    
</script>

</html>