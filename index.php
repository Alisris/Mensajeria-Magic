<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajería</title>
</head>
<body>
    <h1>Mensajería</h1>

    <!-- Mostrar los mensajes guardados -->
    <h2>Conversación</h2>
    <div id="conversation">
        <!-- Los mensajes se mostrarán aquí -->
    </div>

    <!-- Formulario para enviar un mensaje -->
    <form id="mensajeForm">
        <label for="mensaje">Escribe tu mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" cols="50" required></textarea><br>
        <button type="submit">Enviar Mensaje</button>
    </form>

    <br>

    <!-- Botón para guardar los mensajes en un archivo de texto -->
    <button id="downloadBtn" style="display: none;">Descargar Conversación</button>

    <script>
        // Obtener el contenedor de la conversación
        const conversationDiv = document.getElementById('conversation');
        const downloadBtn = document.getElementById('downloadBtn');

        // Función para cargar los mensajes desde localStorage
        function loadMessages() {
            const messages = JSON.parse(localStorage.getItem('messages')) || [];
            conversationDiv.innerHTML = '';  // Limpiar el contenedor
            messages.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.textContent = `${msg.timestamp} - ${msg.message}`;
                conversationDiv.appendChild(messageDiv);
            });

            // Mostrar el botón de descarga si hay mensajes
            downloadBtn.style.display = messages.length > 0 ? 'inline' : 'none';
        }

        // Función para guardar el mensaje en localStorage
        function saveMessage(message) {
            const messages = JSON.parse(localStorage.getItem('messages')) || [];
            const timestamp = new Date().toLocaleString();
            messages.push({ timestamp, message });
            localStorage.setItem('messages', JSON.stringify(messages));
        }

        // Función para descargar los mensajes como un archivo
        function downloadMessages() {
            const messages = JSON.parse(localStorage.getItem('messages')) || [];
            const content = messages.map(msg => `${msg.timestamp} - ${msg.message}`).join("\n");
            const blob = new Blob([content], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'mensajeria/mensajes_conversacion.txt';  // Nombre del archivo a descargar
            a.click();
            URL.revokeObjectURL(url);  // Revocar el objeto URL después de usarlo
        }

        // Manejar el envío del formulario
        document.getElementById('mensajeForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que se recargue la página
            const mensaje = document.getElementById('mensaje').value;
            if (mensaje) {
                saveMessage(mensaje);  // Guardar el mensaje
                loadMessages();  // Recargar los mensajes
                document.getElementById('mensaje').value = '';  // Limpiar el textarea
            }
        });

        // Manejar el clic en el botón de descarga
        downloadBtn.addEventListener('click', function() {
            downloadMessages();  // Descargar los mensajes como archivo
        });

        // Cargar los mensajes cuando la página se recarga
        loadMessages();
    </script>
</body>
</html>
