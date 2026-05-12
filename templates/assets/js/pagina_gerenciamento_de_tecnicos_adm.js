
const home = document.querySelector('.btn_home');
const perfil = document.querySelector('.btn_perfil');
const maquinas = document.querySelector('.btn_maquinas');
const clientes = document.querySelector('.btn_clientes');
const chamados = document.querySelector('.btn_chamados');
const manutencoes = document.querySelector('.btn_manutencoes');
const pecas = document.querySelector('.btn_pecas');
const tecnicos = document.querySelector('.btn_tecnicos');
const logout = document.querySelector('.btn_logout');

const btnColaborador = document.querySelector('.btn_colaborador');

const formPesquisa = document.querySelector('.conteudo_superior form');
const inputPesquisa = document.querySelector('.pesquisar');

/* =========================================================
   ROTAS DO CONTROLLER
========================================================= */

const controller = '../Controller/GerenciamentoTecController.php';

if (home) {
    home.addEventListener('click', () => {
        window.location.href = 'pagina_principal_adm.php';
    });
}

if (perfil) {
    perfil.addEventListener('click', () => {
        window.location.href = 'perfil_do_adm.php';
    });
}

if (maquinas) {

    maquinas.addEventListener('click', () => {
        window.location.href = 'gerenciamento_de_maquinas_adm.php';
    });
}

if (clientes) {

    clientes.addEventListener('click', () => {
        window.location.href = 'pagina_gerenciamento_clientes.php';
    });
}

if (chamados) {

    chamados.addEventListener('click', () => {
        window.location.href = 'pagina_acompanhamento_de_chamados_adm.php';
    });
}

if (manutencoes) {
    
    manutencoes.addEventListener('click', () => {
        window.location.href = 'gerenciamento_de_manutencoes_adm.php';
    });
}

if (pecas) {

    pecas.addEventListener('click', () => {

        window.location.href = 'pagina_gerenciamento_de_pecas_administrador.php';
    });
}

if (tecnicos) {

    tecnicos.addEventListener('click', () => {

        window.location.href = 'pagina_gerenciamento_de_tecnicos_adm.php';
    });
}

if (logout) {

    logout.addEventListener('click', () => {

        window.location.href = 'pagina_inicial.php';
    });
}

/* =========================================================
   NOVO COLABORADOR
========================================================= */

if (btnColaborador) {

    btnColaborador.addEventListener('click', () => {

        window.location.href = 'pagina_cadastro_tecnico.php';
    });
}

/* =========================================================
   PESQUISA
========================================================= */

if (formPesquisa) {

    formPesquisa.addEventListener('submit', (event) => {

        event.preventDefault();

        const busca = inputPesquisa.value.trim();

        /* =========================
           ENVIA PARA O CONTROLLER
        ========================= */

        window.location.href =
            `${controller}?busca=${encodeURIComponent(busca)}`;
    });
}

/* =========================================================
   EDITAR E EXCLUIR
========================================================= */

document.addEventListener('click', (event) => {

    /* =====================================================
       BOTÃO EXCLUIR
    ===================================================== */

    if (event.target.classList.contains('excluir')) {

        const id = event.target.dataset.id;

        if (!id) {

            alert('ID do técnico não encontrado.');
            return;
        }

        const confirmar = confirm(
            'Deseja realmente excluir este técnico?'
        );

        if (confirmar) {

            /* =============================================
               ENVIA PARA O CONTROLLER
            ============================================= */

            window.location.href =
                `${controller}?acao=excluir&id=${id}`;
        }
    }

    /* =====================================================
       BOTÃO EDITAR
    ===================================================== */

    if (event.target.classList.contains('editar')) {

        const id = event.target.dataset.id;

        if (!id) {

            alert('ID do técnico não encontrado.');
            return;
        }

        /* =============================================
           REDIRECIONA PARA O FORMULÁRIO
           COM O ID DO TÉCNICO
        ============================================= */

        window.location.href =
            `${controller}?acao=buscarPorId&id=${id}`;
    }
});

/* =========================================================
   ALERTAS DE SUCESSO E ERRO
========================================================= */

const parametros = new URLSearchParams(window.location.search);

const sucesso = parametros.get('sucesso');
const erro = parametros.get('erro');

/* =========================================================
   SUCESSOS
========================================================= */

if (sucesso === 'cadastrado') {

    alert('Técnico cadastrado com sucesso!');
}

if (sucesso === 'editado') {

    alert('Técnico atualizado com sucesso!');
}

if (sucesso === 'excluido') {

    alert('Técnico excluído com sucesso!');
}

/* =========================================================
   ERROS
========================================================= */

if (erro === 'delete') {

    alert('Erro ao excluir técnico.');
}

if (erro === 'cadastro') {

    alert('Erro ao cadastrar técnico.');
}

if (erro === 'update') {

    alert('Erro ao atualizar técnico.');
}

if (erro === 'camposvazios') {

    alert('Preencha todos os campos.');
}

if (erro === 'camposinvalidos') {

    alert('Campos inválidos.');
}

if (erro === 'idinvalido') {

    alert('ID inválido.');
}

if (erro === 'emailexistente') {

    alert('Este email já está cadastrado.');
}