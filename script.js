function sendText() {
  const textInput = document.getElementById('text-input').value;

  // Verificar si el campo de texto está vacío
  if (textInput.trim() === "") {
    alert("Por favor, escribe algo antes de enviar.");
    return;
  }

 // Redirigir a Proyecto 2 con el texto como parámetro en la URL
      window.location.href = `https://alisris.github.io/Mensajero-Magic/index.html?text=${encodeURIComponent(textInput)}`;
    }
