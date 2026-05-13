const datos = [

    { id:'p1', correcta:'Hola', img:'imag/palabras/hola.png' },

    { id:'p2', correcta:'Adiós', img:'imag/palabras/adios.png' },

    { id:'p3', correcta:'Buen día', img:'imag/palabras/buen_dia.png' },

    { id:'p4', correcta:'Buenas noches', img:'imag/palabras/buenas_noches.png' },

    { id:'p5', correcta:'Mamá', img:'imag/palabras/mama.png' },

    { id:'p6', correcta:'Papá', img:'imag/palabras/papa.png' },

    { id:'p7', correcta:'Uno', img:'imag/palabras/uno.png' },

    { id:'p8', correcta:'Dos', img:'imag/palabras/dos.png' },

    { id:'p9', correcta:'Cinco', img:'imag/palabras/cinco.png' },

    { id:'p10', correcta:'Diez', img:'imag/palabras/diez.png' }
];

const opcionesGenerales =
datos.map(p => p.correcta);

function mezclar(array) {

    return array.sort(() =>
        Math.random() - 0.5
    );
}

const contenedor =
document.getElementById("preguntas");

datos.forEach((p, i) => {

    let incorrectas =
    opcionesGenerales.filter(
        op => op !== p.correcta
    );

    incorrectas =
    mezclar(incorrectas).slice(0, 3);

    let opciones = [
        ...incorrectas,
        p.correcta
    ];

    opciones = mezclar(opciones);

    contenedor.innerHTML += `

    <div class="question-card"
         id="card-${p.id}">

        <div class="question-header">

            <img src="${p.img}"
                 class="question-img"
                 alt="Seña">

            <div>

                <p>
                    <strong>
                        Pregunta ${i+1}
                    </strong>
                </p>

                <p>
                    ¿Qué palabra representa esta seña?
                </p>

                <div class="options-grid">

                    ${opciones.map(op => `

                        <label class="option">

                            <div class="option-content">

                                <input type="radio"
                                       name="${p.id}"
                                       value="${op}">

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

function calificar() {

    let faltantes = false;
    let aciertos = 0;

    const alerta =
    document.getElementById("alerta");

    alerta.style.display = "none";

    datos.forEach(p => {

        const opciones =
        document.getElementsByName(p.id);

        const card =
        document.getElementById(
            "card-" + p.id
        );

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

        alerta.style.display = "block";

        alerta.innerText =
        "⚠️ Contesta todas las preguntas antes de finalizar.";

        alerta.style.color = "#ff4757";

        window.scrollTo(0,0);

        return;
    }

    datos.forEach(p => {

        const opciones =
        document.getElementsByName(p.id);

        const card =
        document.getElementById(
            "card-" + p.id
        );

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
    Math.round(
        (aciertos / datos.length) * 100
    );

    const resultado =
    document.getElementById("resultado");

    resultado.style.display = "block";

    resultado.innerText =
    `Resultado: ${porcentaje}% (${aciertos}/10)`;

    resultado.style.color =
    porcentaje >= 70
    ? "#2ecc71"
    : "#ff4757";

    document.getElementById(
        "btnFinalizar"
    ).style.display = "none";

    const parametros =
    new URLSearchParams();

    parametros.append(
        "modulo",
        "Palabras"
    );

    parametros.append(
        "puntaje",
        porcentaje
    );

    fetch("../backend/g_puntaje.php", {

        method: "POST",

        headers: {
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body: parametros
    });
}