// [Sprint 5 - RNF-03] Fisher-Yates shuffle
function shuffleArray(arr) {
  for (let i = arr.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [arr[i], arr[j]] = [arr[j], arr[i]];
  }
  return arr;
}

// [Sprint 5 - RNF-02] Cargar preguntas desde backend
let datos = [];
const contenedor = document.getElementById("preguntas");

async function loadPreguntas(modId = 3) {
    try {
        const resp = await fetch('controllers/get_preguntas.php?id_Modulo=' + modId);
        if (!resp.ok) throw new Error('Error al cargar preguntas');
        const json = await resp.json();

        datos = json.map((q, idx) => ({
            id: 'p' + (idx+1),
            correcta: q.respuesta_correcta,
            img: q.imagen,
            opciones: [q.respuesta_correcta, q.opcion1, q.opcion2, q.opcion3]
        }));

        renderPreguntas();
    } catch (err) {
        contenedor.innerHTML = '<p style="color:#ff4757; text-align:center;">No fue posible cargar las preguntas.</p>';
        console.error(err);
    }
}

document.addEventListener("change", e => {

    if(e.target.type === "radio"){

        const opciones =
        e.target.closest(".options-grid")
        .querySelectorAll(".option");

        opciones.forEach(op => {
            op.style.border =
            "1px solid #eee";
        });

        e.target.closest(".option")
        .style.border =
        "2px solid #8a4fff";
    }
});

function actualizarProgreso() {

    let respondidas = 0;

    datos.forEach(p => {

        const opciones = document.getElementsByName(p.id);

        opciones.forEach(op => {
            if (op.checked) respondidas++;
        });
    });

    let porcentaje = (respondidas / datos.length) * 100;

    document.getElementById("progresoBarra").style.width = porcentaje + "%";

    document.getElementById("textoProgreso").innerText =
        respondidas + " de " + datos.length + " preguntas respondidas";
}

function renderPreguntas() {
    contenedor.innerHTML = '';

    datos.forEach((p, i) => {
        let opciones = shuffleArray([...p.opciones]);

        contenedor.innerHTML += `

        <div class="question-card" id="card-${p.id}">

            <div class="question-header">

                <img src="${p.img}" class="question-img">

                <div style="flex:1;">

                    <p><strong>Pregunta ${i+1}</strong></p>

                    <p>¿Qué frase representa esta seña?</p>

                    <div class="options-grid">

                        ${opciones.map(op => `
                        <label class="option">
                            <div class="option-content">
                                <input type="radio" name="${p.id}" value="${op}" onclick="actualizarProgreso()">
                                <span>${op}</span>
                            </div>
                        </label>
                        `).join('')}

                    </div>

                </div>

            </div>

        </div>
        `;
    });
}

// Cargar preguntas del módulo Frases (id 3)
loadPreguntas(3);

function calificar() {

    let faltantes = false;
    let aciertos = 0;

    document.getElementById("mensajeError").style.display = "none";

    // validar respuestas
    datos.forEach(p => {

        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);

        let respondida = false;

        opciones.forEach(op => {
            if (op.checked) respondida = true;
        });

        if (!respondida) {
            card.classList.add("error");
            faltantes = true;
        } else {
            card.classList.remove("error");
        }
    });

    if (faltantes) {
        document.getElementById("mensajeError").style.display = "block";
        window.scrollTo(0, 0);
        return;
    }

    // calificar
    datos.forEach(p => {

        const opciones = document.getElementsByName(p.id);
        const card = document.getElementById("card-" + p.id);

        opciones.forEach(op => {

            if (op.checked) {

                if (op.value === p.correcta) {
                    aciertos++;
                    card.classList.add("correcto");
                } else {
                    card.classList.add("incorrecto");
                }
            }
        });
    });

    let porcentaje = Math.round((aciertos / datos.length) * 100);

    // 🔥 MOSTRAR MODAL (igual que abecedario)
    const modal = document.getElementById("modalResultado");
    const textoModal = document.getElementById("textoModal");

    if (porcentaje >= 70) {
        textoModal.innerHTML = `🏆 Excelente trabajo<br>Obtuviste ${porcentaje}%`;
    } else {
        textoModal.innerHTML = `📚 Sigue practicando<br>Obtuviste ${porcentaje}%`;
    }

    modal.style.display = "flex";

    // resultado visual
    const res = document.getElementById("resultado");
    res.innerText = `Resultado: ${aciertos} / 10 (${porcentaje}%)`;
    res.style.color = porcentaje >= 70 ? "#00c853" : "#ff4757";

    document.getElementById("btnFinalizar").style.display = "none";

    document.getElementById("btnProgreso").innerHTML = `
        <a href="index.php?page=progreso" class="btn-main">Ir al progreso</a>
    `;

    const parametros = new URLSearchParams();
    parametros.append("action", "guardar_progreso");
    parametros.append("puntaje", porcentaje);
    parametros.append("modulo", "Frases");

    // guardar backend
    fetch("index.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: parametros
    });
}

function cerrarModal(){

    document.getElementById(
        "modalResultado"
    ).style.display = "none";
}