
<?php
include "../config.php";
include "../utils.php";
$dbConn = connect($db);
$Query = "SELECT * FROM usuarios";
$statement = $dbConn->prepare($Query);
$statement->execute();
if ($statement === false) {
    die("Error al ejecutar la consulta: " . $mysql->error);
}

   
   
   
    // Si el nombre de usuario no esta usado lo registra  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\style.css">
    <link rel="stylesheet" href="..\css\users.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Document</title>
</head>
<body>
     <!-- Header -->
     <header class="header">
        <div class="header-content">
            <div class="logo">
                VersaBooks
            </div>
            <nav class="menu">
                <a class="active" href="usuarios.html">Usuarios</a>
                <a href="#acerca">Intercambio</a>
                <a href="#intercambio">lectura</a>
            </nav>
            <a href="html/login.html" class="user-icon">
                <i class="fa fa-user-circle"></i>
            </a>
        </div>
    </header>

    <section class="section">
        <h2 class="section-title">Administracion de Usuarios</h2>

        <div class="search-container">
            <div class="search-bar-wrapper">
                <i class="fa fa-search search-icon"></i>
                <input type="text" class="search-bar" placeholder="Buscar usuario...">
            </div>
        </div>


        <!-- Seccion de usuarios -->
        <section class="user-section">
            <div class="user-container">
            <?php
 while($array=$statement->fetch(PDO::FETCH_ASSOC)){

?>
                <div class="user-card">
                    <div class="user-content">
                        <img src="data:image/jpg;base64,<?php echo base64_encode($array['fotoP']) ?> " alt="Foto de Usuario" class="user-photo">
                        <div class="user-info">
                            <h3 class="user-name"><?php print($array['nombre_us']); ?></h3>
                            <p class="user-email"><?php print($array['email']); ?></p>
                        </div>
                        <button class="admin-btn">
                            <i class="fa fa-cog"></i> Admin
                        </button>
                    </div>
                </div>
<?php 
 }
exit; // Finalizar el script después de redirigir

// Cerrar la conexión
$mysql->close();
?>
?>
                <!-- Usuario 2 -->
                


                <!-- Repite más usuarios según sea necesario -->
            </div>
        </section>
        


    </section>

    
    
    
</body>
</html>