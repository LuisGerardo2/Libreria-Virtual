<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VersaBooks</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <!-- Barra de navegación -->
    <header>
        <div class="logo">
            <h1>VersaBooks</h1>
        </div>
    
        <!-- Contenedor central para los enlaces -->
        <nav class="nav-links">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Acerca</a></li>
                <li><a href="#">Intercambio</a></li>
                <li><a href="#">Lectura</a></li>
            </ul>
        </nav>
    
        <!-- Enlace de Accede alineado a la derecha -->
        <div class="accede-link">
            <a href="#">Accede</a>
        </div>
    </header>
    

    <!-- Contenedor del formulario de crear cuenta -->
    <div class="container-form">
        <div class="form-container">
            <h2>Crear una Cuenta</h2>
            <p>Únase a VersaBooks y comience su viaje de lectura</p>

            <!-- Formulario -->
            <form action="registerBook_process.php" method="POST" enctype="multipart/form-data">
                <label for="titulo">Título del Libro</label>
                <input type="text" id="titulo" name="titulo" required>

                <label for="autores">Autores</label>
                <input type="text" id="autores" name="autores" placeholder="Autor1, Autor2" required>

                <label for="apublicacion">Año de Publicación</label>
                <input type="number" id="apublicacion" name="apublicacion" required>

                <label for="generos">Géneros</label>
                <input type="text" id="generos" name="generos" placeholder="Romance, drama, aventura,..." required>

                <label for="sinopsis">Sinopsis</label>
                <textarea id="sinopsis" name="sinopsis" required></textarea>

                <label for="reseñas">Reseñas</label>
                <textarea id="resenas" name="resenas" required></textarea>

                <label for="portada">Sube una portada del libro</label>
                <input type="file" id="portada" name="portada" required>

                <label for="virtual">Virtual</label>
                <input type="checkbox" id="virtual" name="virtual" value="Virtual" onchange="verificar();">


                    <div style="display: none;" id="libroV">
               
               
                <label for="contenido">Contenido del Libro</label>
                <input type="file" id="contenido" name="contenido">

               </div>

                <button type="submit" class="submit-button">Crear Libro</button>
            </form>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>2024 Versa Books. All rights reserved.</p>
    </footer>
</body>
<script type="text/javascript">
    function verificar() {
        var virtual=document.getElementById('virtual');
        var lv=document.getElementById('libroV');
               if (virtual.checked){
             
             lv.style.display="block";}else{lv.style.display="none";

             }
    }
</script>
</html>
