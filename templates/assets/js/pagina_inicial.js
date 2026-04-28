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


/*redicionamento para a pagina de registro de manutenção e  a página de ver historico da maquina*/
document.addEventListener("DOMContentLoaded", function () {
    const caixa1 = document.querySelector(".caixa_bloqueada1");
    const caixa2 = document.querySelector(".caixa_bloqueada2");

    caixa2.addEventListener("click", function () {
        window.location.href = "/registro_manutencao";
    });

    caixa1.addEventListener("click", function () {
        window.location.href = "/historico_maquina";
    });

});

/*redirecionamento para a página de cadastro de máquina*/
document.addEventListener("DOMContentLoaded", function () {
    const text2 = document.querySelector(".texto2");

    text2.addEventListener("click", function () {
        window.location.href = "/cadastro_maquina";
    });
});

/*redirecionamento para novo chamado*/
document.addEventListener("DOMContentLoaded", function () { 
    const btn_chamado = document.querySelector(".btn_abrir_chamado");

    btn_chamado.addEventListener("click", function () {
        window.location.href = "/novo_chamado";
    });
});


