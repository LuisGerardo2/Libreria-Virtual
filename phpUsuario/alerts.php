<?php
function mostrar($mensaje): string
{
    return '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./alerts.css">
            <title>Document</title>
        </head>
        <body>
            <div id="custom-alert" class="custom-alert">
                <div class="alert-content">
                    <span id="alert-message"></span>
                    <button id="alert-close" class="alert-close">Cerrar</button>
                </div>
            </div>
        </body>
        <script>
            var alertElement = document.getElementById("custom-alert");
            var alertMessage = document.getElementById("alert-message");
            var alertClose = document.getElementById("alert-close");

            alertMessage.innerText = ' . json_encode($mensaje) . '; 
            alertElement.style.display = "block"; 

            alertClose.onclick = function() {
                alertElement.style.display = "none"; 
            };

            setTimeout(function() {
                alertElement.style.display = "none";
            }, 5000);
        </script>
        </html>';
}

function crear() {
    ?>
    <div id="contenido"></div>
<script>
        // Cargar el archivo HTML y mostrarlo en un contenedor
        fetch('../html/login.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('contenido').innerHTML = data;
            })
            .catch(error => console.error('Error cargando el archivo:', error));
    </script>


<?php
    
}

?>