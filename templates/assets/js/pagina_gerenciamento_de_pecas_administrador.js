const perfil = document.querySelector('.btn_perfil');
const maquinas = document.querySelector('.btn_maquinas');
const clientes = document.querySelector('.btn_clientes');
const chamados = document.querySelector('.btn_chamados');
const home = document.querySelector('.btn_home');
const manutencoes = document.querySelector('.btn_manutencoes');
const pecas = document.querySelector('.btn_pecas');
const tecnicos = document.querySelector('.btn_tecnicos');
const logout = document.querySelector('.btn_logout');
const cancelarbtn = document.querySelectorAll('.cancelar');
const concluirbtn = document.querySelectorAll('.concluir');


if (home) {
    home.addEventListener('click', () => {
        window.location.href = 'pagina_principal_adm.php'
    })
}

if (perfil) {
    perfil.addEventListener('click', () => {
        window.location.href = 'perfil_do_adm.php'
    })
}

if (maquinas) {
    maquinas.addEventListener('click', () => {
        window.location.href = 'gerenciamento_de_maquinas_adm.php'
    })
}

if (clientes) {
    clientes.addEventListener('click', () => {
        window.location.href = 'pagina_gerenciamento_clientes.php'
    })
}

if (chamados) {
    chamados.addEventListener('click', () => {
        window.location.href = 'pagina_acompanhamento_de_chamados_adm.php'
    })
}

if (manutencoes) {
    manutencoes.addEventListener('click', () => {
        window.location.href = 'gerenciamento_de_manutencoes_adm.php'
    })
}

if (pecas) {
    pecas.addEventListener('click', () => {
        window.location.href = 'pagina_gerenciamento_de_pecas_administrador.php'
    })
}

if (tecnicos) {
    tecnicos.addEventListener('click', () => {
        window.location.href = 'pagina_gerenciamento_de_tecnicos_adm.php'
    })
}

if (logout) {
    logout.addEventListener('click', () => {
        window.location.href = 'pagina_inicial.php'
    })
}


// =======================================
// PESQUISA
// =======================================

// --- COMMIT: Correção do destino da pesquisa ---
const formularioPesquisa = document.querySelector('.formulario-pesquisa');

if (formularioPesquisa) {
    formularioPesquisa.addEventListener('submit', (event) => {
        event.preventDefault(); // Para a submissão padrão

        const valorPesquisa = document.querySelector('.pesquisar').value;

        // Vá para a página que MOSTRA os dados (View)
        window.location.href = `pagina_gerenciamento_de_pecas_administrador.php?busca=${valorPesquisa}`;
    });
}




// =======================================
// CONCLUIR SOLICITAÇÃO
// =======================================

concluirbtn.forEach(botao => {

    botao.addEventListener('click', async () => {

        try {

            const idSolicitacao = botao.dataset.id;

            const resposta = await fetch(
            '../Controller/PecasController.php',
                {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json'
                    },

                    body: JSON.stringify({
                        id: idSolicitacao,
                        status: 'concluído'
                    })
                }
            );

const texto = await resposta.text();

console.log(texto);

const dados = JSON.parse(texto);
            

            if (dados.sucesso) {

                const bloco = botao.closest('.bloco');

                const statusTexto =
                    bloco.querySelector('.status-texto');

                const cancelar =
                    bloco.querySelector('.cancelar');

                statusTexto.textContent = 'Concluído';

                botao.disabled = true;

                botao.textContent = 'Concluído';

                if (cancelar) {
                    cancelar.style.display = 'none';
                }

            } else {

                alert('Erro ao atualizar status');

            }

        } catch (erro) {

            console.error(erro);

            alert('Erro no servidor');

        }

    });

});




// =======================================
// CANCELAR SOLICITAÇÃO
// =======================================

cancelarbtn.forEach(botao => {

    botao.onclick = async () => {

        const idSolicitacao =
            botao.dataset.id;


        const resposta = await fetch(

            '../Controller/PecasController.php',

            {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({

                    id: idSolicitacao,

                    status: 'em_aberto'

                })

            }

        );


 const texto = await resposta.text();

console.log(texto);

const dados = JSON.parse(texto);

        if (dados.sucesso) {

            const bloco =
                botao.closest('.bloco');


            // remove solicitação inteira
            bloco.remove();

        }

    };

});