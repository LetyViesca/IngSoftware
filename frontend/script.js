document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function() {
        const sectionTitle = this.parentElement.querySelector('h3').innerText;
        alert('Cargando módulo: ' + sectionTitle);
        
        // Simulación de cambio de pantalla (Flujo actualizado)
        document.querySelector('.hero').innerHTML = `
            <h1>Módulo: ${sectionTitle}</h1>
            <div class="progress-container" style="width: 80%; background: #ddd; height: 10px; margin: 20px auto; border-radius: 5px;">
                <div class="progress-bar" style="width: 50%; background: var(--purple); height: 100%; border-radius: 5px;"></div>
            </div>
            <p>Progreso actual: 50%</p>
        `;
    });
});