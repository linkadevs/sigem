document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form");
    const inputCodigo = document.getElementById("Codigo");
    const cForm = document.querySelector(".Cform");
    const maquinaEncontrada = document.querySelector(".maquina_encontrada");

    const caixa1 = document.querySelector(".caixa_bloqueada1");
    const caixa2 = document.querySelector(".caixa_bloqueada2");

    const cadeado1 = document.querySelector(".cadeado1");
    const cadeado2 = document.querySelector(".cadeado2");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const codigo = inputCodigo.value.trim();

        if (codigo !== "") {
            cForm.innerHTML = "";
            cForm.appendChild(maquinaEncontrada);

            maquinaEncontrada.style.display = "flex";

            if (cadeado1) cadeado1.style.display = "none";
            if (cadeado2) cadeado2.style.display = "none";

            caixa1.style.cursor = "pointer";
            caixa2.style.cursor = "pointer";
        }
    });
});