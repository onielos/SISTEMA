(function() {
    const ToastLib = {
        showToast(type = 'success', message = 'Operación exitosa') {
            // Crear el contenedor de toast si no existe
            if (!document.getElementById('toast-container')) {
                const container = document.createElement('div');
                container.id = 'toast-container';
                container.style.position = 'fixed';
                container.style.left = '50%';
                container.style.bottom = '30px';
                container.style.transform = 'translateX(-50%)';
                container.style.zIndex = '1000';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.classList.add('toast');
            toast.style.minWidth = '300px';
            toast.style.backgroundColor = (type === 'success') ? '#4CAF50' : '#f44336';
            toast.style.color = '#fff';
            toast.style.fontSize = '12px';
            toast.style.borderRadius = '8px';
            toast.style.padding = '16px';
            toast.style.display = 'flex';
            toast.style.alignItems = 'center';
            toast.style.boxShadow = '0 6px 18px rgba(0, 0, 0, 0.2)';
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            toast.style.marginTop = '10px';
            toast.innerHTML = `
                <div class="toast-icon" style="margin-right: 12px;">
                    ${ToastLib.getIcon(type)}
                </div>
                <div class="toast-alert-message">${message}</div>
            `;

            document.getElementById('toast-container').appendChild(toast);

            // Animación para mostrar el toast
            setTimeout(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(-10px)';
            }, 100);

            // Eliminar el toast después de 3 segundos
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(0)';
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }, 3000);
        },

        showConfirm(message = '¿Estás seguro?', onConfirm = () => {}, onCancel = () => {}) {
            // Crear el contenedor de confirmación si no existe
            if (!document.getElementById('confirm-container')) {
                const container = document.createElement('div');
                container.id = 'confirm-container';
                container.style.position = 'fixed';
                container.style.left = '50%';
                container.style.top = '50%';
                container.style.transform = 'translate(-50%, -50%)';
                container.style.backgroundColor = '#fff';
                container.style.color = '#333';
                container.style.padding = '20px';
                container.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.3)';
                container.style.borderRadius = '8px';
                container.style.zIndex = '1000';
                container.style.width = '300px';
                container.style.textAlign = 'center';
                
                document.body.appendChild(container);
            }

            const confirmContainer = document.getElementById('confirm-container');
            confirmContainer.innerHTML = `
                <div style="margin-bottom: 15px;">${message}</div>
                <button id="confirm-yes" style="margin-right: 10px; padding: 8px 16px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Sí</button>
                <button id="confirm-no" style="padding: 8px 16px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">No</button>
            `;

            // Mostrar el contenedor
            confirmContainer.style.display = 'block';

            // Agregar eventos a los botones
            document.getElementById('confirm-yes').onclick = function() {
                confirmContainer.style.display = 'none';
                onConfirm();
            };

            document.getElementById('confirm-no').onclick = function() {
                confirmContainer.style.display = 'none';
                onCancel();
            };
        },

        getIcon(type) {
            if (type === 'success') {
                return `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" width="24" height="24">
                        <path d="M12 0C5.383 0 0 5.383 0 12c0 6.617 5.383 12 12 12 6.617 0 12-5.383 12-12 0-6.617-5.383-12-12-12zm-2 17.586L5.707 13.293l1.414-1.414L10 15.172l6.879-6.879 1.414 1.414L10 17.586z"/>
                    </svg>`;
            } else if (type === 'error') {
                return `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" width="24" height="24">
                        <path d="M12 0C5.383 0 0 5.383 0 12c0 6.617 5.383 12 12 12 6.617 0 12-5.383 12-12 0-6.617-5.383-12-12-12zm5 15.414L15.414 17 12 13.586 8.586 17 7 15.414 10.414 12 7 8.586 8.586 7 12 10.414 15.414 7 17 8.586 13.586 12 17 15.414z"/>
                    </svg>`;
            }
        }
    };

    // Hacer que la librería esté disponible globalmente
    window.ToastLib = ToastLib;
})();
