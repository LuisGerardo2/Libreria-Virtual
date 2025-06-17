// Obtener elementos del DOM
const showPopupBtn = document.getElementById('showPopupBtn');
const popup = document.getElementById('popup');
const closePopupBtn = document.getElementById('closePopupBtn');

// Función para mostrar el popup
showPopupBtn.addEventListener('click', () => {
  popup.style.display = 'flex'; // Muestra el popup
});

// Función para cerrar el popup
closePopupBtn.addEventListener('click', () => {
  popup.style.display = 'none'; // Oculta el popup
});

// También permite cerrar el popup haciendo clic fuera del contenido
window.addEventListener('click', (event) => {
  if (event.target === popup) {
    popup.style.display = 'none'; // Oculta
