console.log('alerta-global.js cargado');

function showCustomAlert(message) {
    return new Promise((resolve) => {
        const alertEl = document.getElementById('customAlert');
        const messageEl = document.getElementById('alertMessage');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        messageEl.textContent = message;
        alertEl.style.display = 'block';

        confirmBtn.onclick = () => {
            alertEl.style.display = 'none';
            resolve(true);
        };

        cancelBtn.onclick = () => {
            alertEl.style.display = 'none';
            resolve(false);
        };
    });
}

async function verificarAlertas() {
    console.log('Verificando alertas...');
    try {
        const response = await fetch('./logica/verificar_alertas.php');
        const data = await response.json();
        console.log('Datos recibidos:', data);
        if (data.alertas && data.alertas.length > 0) {
            for (const alerta of data.alertas) {
                console.log('Mostrando alerta:', alerta.mensaje);
                const confirmed = await showCustomAlert(alerta.mensaje + "\n\n¿Desea cerrar esta alerta?");
                if (confirmed) {
                    await marcarAlertaProcesada(alerta.id);
                }
            }
        } else {
            console.log('No hay nuevas alertas');
        }
    } catch (error) {
        console.error('Error al verificar alertas:', error);
    }
}

async function marcarAlertaProcesada(alertaId) {
    console.log('Marcando alerta como procesada:', alertaId);
    try {
        const response = await fetch('./logica/marcar_alerta_procesada.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${alertaId}`
        });
        const data = await response.json();
        if (data.success) {
            console.log(data.message);
        } else {
            console.error('Error al marcar la alerta como procesada:', data.message);
        }
    } catch (error) {
        console.error('Error al marcar la alerta como procesada:', error);
    }
}

function iniciarVerificacionPeriodica() {
    console.log('Iniciando verificación periódica de alertas');
    verificarAlertas(); // Verificar inmediatamente
    setInterval(verificarAlertas, 10000); // Verificar cada 10 segundos
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado, iniciando verificación periódica de alertas');
    iniciarVerificacionPeriodica();
});