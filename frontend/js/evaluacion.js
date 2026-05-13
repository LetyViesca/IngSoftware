/**
 * ARCHIVO: frontend/js/evaluacion.js
 * REFACTORIZACIÓN: Validación obligatoria + Resaltado de errores + Persistencia
 */

const datos = [
    { id:'p1', correcta:'A', img:'imag/abecedario/a.png' },
    { id:'p2', correcta:'B', img:'imag/abecedario/b.png' },
    { id:'p3', correcta:'C', img:'imag/abecedario/c.png' },
    { id:'p4', correcta:'D', img:'imag/abecedario/d.png' },
    { id:'p5', correcta:'E', img:'imag/abecedario/e.png' },
    { id:'p6', correcta:'F', img:'imag/abecedario/f.png' },
    { id:'p7', correcta:'G', img:'imag/abecedario/g.png' },
    { id:'p8', correcta:'H', img:'imag/abecedario/h.png' },
    { id:'p9', correcta:'I', img:'imag/abecedario/i.png' },
    { id:'p10', correcta:'J', img:'imag/abecedario/j.png' }
];

const contenedor = document.getElementById("preguntas");

// Renderizado de preguntas
datos.forEach((p, i) => {
    contenedor.innerHTML += `
    <div class="question-card" id="card-${p.id}">
        <div class="question-header">
            <img src="${p.img}" class="question-img">
            <div style="flex:1;">
                <p><strong>Pregunta ${i+1}</strong></p>
                <p>¿Qué letra es esta?</p>
                <div class="options-grid">
                    ${['A', 'M', 'R', 'T'].map(letra => {
                        // Aseguramos que la opción correcta de cada objeto 'p' esté en la lista
                        // (Aquí podrías aleatorizar si quisieras)
                        let valorFinal = (letra === 'A') ? p.correcta : letra; 
                        return `
                        <label class="option">
                            <div class="option-content">
                                <input type="radio" name="${p.id}" value="${valorFinal}">
                                <span>${valorFinal}</span>
                            </div>
                        </label>`;
                    }).join('')}
                </div>
            </div>
        </div>
    </div>`;
});

function calificar() {
    let faltantes = false;
    let aciertos = 0;
    const resultado = document.getElementById("resultado");
    resultado.innerText = "";

    // 1. VALIDACIÓN: Revisar si hay preguntas sin contestar (Checklist Punto 4)
    datos.forEach(p => {
        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);
        let respondida = false;

        // Limpiamos estilos de intentos previos
        card.classList.remove("error", "correct", "incorrect");
        card.style.border = "1px solid #ddd"; // Reset visual

        opciones.forEach(op => {
            if (op.checked) respondida = true;
        });

        if (!respondida) {
            // APLICAR RESALTADO EN ROJO (Checklist Punto 4)
            card.classList.add("error");
            card.style.border = "2px solid #ff4757";
            card.style.backgroundColor = "#fff5f5";
            faltantes = true;
        }
    });

    if (faltantes) {
        resultado.innerText = "Por favor, contesta todas las preguntas antes de finalizar.";
        resultado.style.color = "#ff4757";
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return; // BLOQUEAR ENVÍO (Checklist Punto 4)
    }

    // 2. CALIFICACIÓN: Si todo está contestado, evaluamos
    datos.forEach(p => {
        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);
        let seleccionada = "";

        opciones.forEach(op => {
            if (op.checked) seleccionada = op.value;
        });

        if (seleccionada === p.correcta) {
            aciertos++;
            card.classList.add("correct");
            card.style.border = "2px solid #2ecc71";
            card.style.backgroundColor = "#fafffa";
        } else {
            card.classList.add("incorrect");
            card.style.border = "2px solid #ff4757";
            card.style.backgroundColor = "#fff5f5";
        }
    });

    // 3. MOSTRAR RESULTADOS Y PERSISTENCIA
    let porcentaje = Math.round((aciertos / datos.length) * 100);
    resultado.innerText = `Evaluación Finalizada: ${porcentaje}% (${aciertos}/${datos.length})`;
    resultado.style.color = porcentaje >= 70 ? "#2ecc71" : "#ff4757";

    document.getElementById("btnFinalizar").style.display = "none";

    // Envío seguro al backend (Ruta de la nueva arquitectura)
    fetch("../backend/g_puntaje.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `puntaje=${porcentaje}&modulo=Abecedario`
    })
    .then(res => console.log("Puntaje guardado exitosamente"))
    .catch(err => console.error("Error al guardar puntaje"));
}