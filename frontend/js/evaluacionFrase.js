const datos = [

    {
        id:'p1',
        correcta:'¿Cuál es tu nombre?',
        img:'imag/frases/nombre.png'
    },

    {
        id:'p2',
        correcta:'De nada',
        img:'imag/frases/de_nada.png'
    },

    {
        id:'p3',
        correcta:'Ayuda',
        img:'imag/frases/ayuda.png'
    },

    {
        id:'p4',
        correcta:'Lo siento',
        img:'imag/frases/lo_siento.png'
    },

    {
        id:'p5',
        correcta:'Tengo sed',
        img:'imag/frases/sed.png'
    },

    {
        id:'p6',
        correcta:'Con permiso',
        img:'imag/frases/con_permiso.png'
    },

    {
        id:'p7',
        correcta:'¿De dónde eres?',
        img:'imag/frases/de_donde.png'
    },

    {
        id:'p8',
        correcta:'¿Cuánto cuesta?',
        img:'imag/frases/cuanto_cuesta.png'
    },

    {
        id:'p9',
        correcta:'Estoy enfermo',
        img:'imag/frases/enfermo.png'
    },

    {
        id:'p10',
        correcta:'Me gusta',
        img:'imag/frases/me_gusta.png'
    }
];

const contenedor = document.getElementById("preguntas");

function actualizarProgreso() {

    let respondidas = 0;

    datos.forEach(p => {

        const opciones =
        document.getElementsByName(p.id);

        opciones.forEach(op => {

            if(op.checked){
                respondidas++;
            }
        });
    });

    let porcentaje =
    (respondidas / datos.length) * 100;

    document.getElementById(
        "progresoBarra"
    ).style.width = porcentaje + "%";

    document.getElementById(
        "textoProgreso"
    ).innerText =
    respondidas +
    " de " +
    datos.length +
    " preguntas respondidas";
}

datos.forEach((p, i) => {

    contenedor.innerHTML += `

    <div class="question-card"
         id="card-${p.id}">

        <div class="question-header">

            <img src="${p.img}"
                 class="question-img">

            <div style="flex:1;">

                <p>
                    <strong>
                        Pregunta ${i+1}
                    </strong>
                </p>

                <p>
                    ¿Qué frase representa esta seña?
                </p>

                <div class="options-grid">

                    <label class="option">

                        <div class="option-content">

                            <input type="radio"
                                   name="${p.id}"
                                   value="${p.correcta}"
                                   onclick="actualizarProgreso()">

                            <span>
                                ${p.correcta}
                            </span>

                        </div>

                    </label>

                    <label class="option">

                        <div class="option-content">

                            <input type="radio"
                                   name="${p.id}"
                                   value="Otras señas"
                                   onclick="actualizarProgreso()">

                            <span>
                                Otras señas
                            </span>

                        </div>

                    </label>

                    <label class="option">

                        <div class="option-content">

                            <input type="radio"
                                   name="${p.id}"
                                   value="No corresponde
                                   onclick="actualizarProgreso()"">

                            <span>
                                No corresponde
                            </span>

                        </div>

                    </label>

                    <label class="option">

                        <div class="option-content">

                            <input type="radio"
                                   name="${p.id}"
                                   value="No sé"
                                   onclick="actualizarProgreso()">

                            <span>
                                No sé
                            </span>

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

    document.getElementById(
        "mensajeError"
    ).style.display = "none";

    datos.forEach(p => {

        const opciones =
        document.getElementsByName(p.id);

        const card =
        document.getElementById(
            "card-" + p.id
        );

        let respondida = false;

        opciones.forEach(op => {

            if (op.checked) {
                respondida = true;
            }

        });

        if (!respondida) {

            card.classList.add("error");

            faltantes = true;

        } else {

            card.classList.remove("error");
        }
    });

    if (faltantes) {

        document.getElementById(
            "mensajeError"
        ).style.display = "block";

        window.scrollTo(0, 0);

        return;
    }

    datos.forEach(p => {

        const opciones =
        document.getElementsByName(p.id);

        const card =
        document.getElementById(
            "card-" + p.id
        );

        opciones.forEach(op => {

            if (op.checked) {

                if (op.value === p.correcta) {

                    aciertos++;

                    card.classList.add(
                        "correcto"
                    );

                } else {

                    card.classList.add(
                        "incorrecto"
                    );
                }
            }
        });
    });

    let porcentaje =
    Math.round(
        (aciertos / datos.length) * 100
    );

    const parametros =
    new URLSearchParams();

    parametros.append(
        'modulo',
        'Frases'
    );

    parametros.append(
        'puntaje',
        porcentaje
    );

    fetch("../backend/g_puntaje.php", {

        method: 'POST',

        headers: {
            'Content-Type':
            'application/x-www-form-urlencoded'
        },

        body: parametros

    })

    .then(response => response.json())

    .then(data => {

        if (data.status === "success") {

            const res =
            document.getElementById(
                "resultado"
            );

            res.style.display = "block";

            res.innerText =
            `Resultado: ${aciertos} / 10 (${porcentaje}%)`;

            res.style.color =
            porcentaje >= 70
            ? "#00c853"
            : "#ff4757";

            res.style.background =
            porcentaje >= 70
            ? "#e8f5e9"
            : "#ffebee";

            document.getElementById(
                "btnFinalizar"
            ).style.display = "none";

            window.scrollTo(0, 0);

            document.getElementById(
    "btnProgreso"
).innerHTML = `
    <a href="progreso.php" class="btn-main">
        Ir al progreso
    </a>
`;

        } else {

            alert(
                "Error al guardar: " +
                data.message
            );
        }

    })

    .catch(error => {

        console.error(
            "Error:",
            error
        );

        alert(
            "Error de conexión al guardar el progreso."
        );

    });
}