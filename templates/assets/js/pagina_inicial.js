
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form");
    const inputCodigo = document.getElementById("Codigo");
    const cForm = document.querySelector(".Cform");
    const maquinaEncontrada = document.querySelector(".maquina_encontrada");

    const caixa1 = document.querySelector(".caixa_bloqueada1");
    const caixa2 = document.querySelector(".caixa_bloqueada2");

    const btnNova = document.querySelector(".btnNovaManutencao");
    const btnHistorico = document.querySelector(".btnHistorico");

    const cadeado1 = document.querySelector(".cadeado1");
    const cadeado2 = document.querySelector(".cadeado2");

    const cadeadoMobile1 = document.querySelector(".cadeado_nova_manutencao");
    const cadeadoMobile2 = document.querySelector(".cadeado_historico");

    let desbloqueado = false;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const codigo = inputCodigo.value.trim();

        if (codigo !== "") {
            desbloqueado = true;

            cForm.innerHTML = "";
            cForm.appendChild(maquinaEncontrada);

            maquinaEncontrada.style.display = "flex";

            // desktop
            if (cadeado1) cadeado1.style.opacity = "0";
            if (cadeado2) cadeado2.style.opacity = "0";

            // mobile
            if (cadeadoMobile1) cadeadoMobile1.style.opacity = "0";
            if (cadeadoMobile2) cadeadoMobile2.style.opacity = "0";

            if (caixa1) caixa1.style.cursor = "pointer";
            if (caixa2) caixa2.style.cursor = "pointer";

            if (btnNova) btnNova.style.cursor = "pointer";
            if (btnHistorico) btnHistorico.style.cursor = "pointer";
        }
    });

    // caixas desktop
    if (caixa2) {
        caixa2.addEventListener("click", function () {
            if (desbloqueado) {
                window.location.href = "/registro_manutencao";
            }
        });
    }

    if (caixa1) {
        caixa1.addEventListener("click", function () {
            if (desbloqueado) {
                window.location.href = "/historico_maquina";
            }
        });
    }

    if (btnNova) {
        btnNova.addEventListener("click", function () {
            if (desbloqueado) {
                window.location.href = "/registro_manutencao";
            }
        });
    }

    if (btnHistorico) {
        btnHistorico.addEventListener("click", function () {
            if (desbloqueado) {
                window.location.href = "/historico_maquina";
            }
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const text2 = document.querySelector(".texto2");

    if (text2) {
        text2.addEventListener("click", function () {
            window.location.href = "/cadastro_maquina";
        });
    }
});


/* redirecionamento para novo chamado */
document.addEventListener("DOMContentLoaded", function () {
    const btn_chamado = document.querySelector(".btn_abrir_chamado");

    if (btn_chamado) {
        btn_chamado.addEventListener("click", function () {
            window.location.href = "/novo_chamado";
        });
    }
});