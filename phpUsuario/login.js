// Función para mostrar la alerta personalizada

function showCustomAlert(message) {
    var alertElement = document.getElementById("custom-alert");
    var alertMessage = document.getElementById("alert-message");
    var alertClose = document.getElementById("alert-close");

    alertMessage.innerText = message; // Establecer el mensaje de la alerta
    alertElement.style.display = "block"; // Mostrar la alerta

    // Cerrar la alerta cuando el usuario hace clic en el botón de cerrar
    alertClose.onclick = function() {
        alertElement.style.display = "none"; // Ocultar la alerta
    };

    // Cerrar la alerta automáticamente después de 5 segundos (opcional)
    setTimeout(function() {
        alertElement.style.display = "none";
    }, 5000);
}
