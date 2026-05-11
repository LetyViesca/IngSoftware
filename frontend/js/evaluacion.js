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

datos.forEach((p, i) => {

    contenedor.innerHTML += `
    <div class="question-card" id="card-${p.id}">

        <div class="question-header">

            <img src="${p.img}" class="question-img">

            <div style="flex:1;">

                <p><strong>Pregunta ${i+1}</strong></p>

                <p>¿Qué letra es esta?</p>

                <div class="options-grid">

                    <label class="option">

                        <div class="option-content">

                            <input type="radio"
                                   name="${p.id}"
                                   value="${p.correcta}">

                            <span>${p.correcta}</span>

                        </div>

                    </label>

                    <label class="option">

                        <div class="option-content">

                            <input type="radio"
                                   name="${p.id}"
                                   value="M">

                            <span>M</span>

                        </div>

                    </label>

                    <label class="option">

                        <div class="option-content">

                            <input type="radio"
                                   name="${p.id}"
                                   value="R">

                            <span>R</span>

                        </div>

                    </label>

                    <label class="option">

                        <div class="option-content">

                            <input type="radio"
                                   name="${p.id}"
                                   value="T">

                            <span>T</span>

                        </div>

                    </label>

                </div>

            </div>
        </div>
    </div>
    `;
});

function calificar() {

    let faltantes = false;
    let aciertos = 0;

    const resultado =
    document.getElementById("resultado");

    resultado.innerText = "";

    datos.forEach(p => {

        const opciones =
        document.getElementsByName(p.id);

        const card =
        document.getElementById("card-" + p.id);

        let respondida = false;

        card.classList.remove(
            "error",
            "correct",
            "incorrect"
        );

        opciones.forEach(op => {
            if (op.checked) {
                respondida = true;
            }
        });

        if (!respondida) {

            card.classList.add("error");

            faltantes = true;
        }
    });

    if (faltantes) {

        resultado.innerText =
        "⚠️ Contesta todas las preguntas antes de finalizar.";

        resultado.style.color = "#ff4757";

        window.scrollTo(0,0);

        return;
    }

    datos.forEach(p => {

        const opciones =
        document.getElementsByName(p.id);

        const card =
        document.getElementById("card-" + p.id);

        let seleccionada = "";

        opciones.forEach(op => {

            if (op.checked) {
                seleccionada = op.value;
            }
        });

        if (seleccionada === p.correcta) {

            aciertos++;

            card.classList.add("correct");

        } else {

            card.classList.add("incorrect");
        }
    });

    let porcentaje =
    Math.round((aciertos / datos.length) * 100);

    resultado.innerText =
    "Resultado: " +
    porcentaje +
    "% (" +
    aciertos +
    "/10)";

    resultado.style.color =
    porcentaje >= 70
    ? "#2ecc71"
    : "#ff4757";

    document.getElementById(
        "btnFinalizar"
    ).style.display = "none";

    document.getElementById(
    "btnProgreso"
).innerHTML = `

    <a href="progreso.php"
       class="btn-main">

        Ir al progreso

    </a>

`;

    fetch("../backend/g_puntaje.php", {

        method: "POST",

        headers: {
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body:
        "puntaje=" + porcentaje +
        "&modulo=Abecedario"
    });
}