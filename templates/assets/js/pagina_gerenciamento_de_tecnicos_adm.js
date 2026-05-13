
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


// NOVO COLABORADOR

if (btnColaborador) {

    btnColaborador.addEventListener('click', () => {
        window.location.href = 'pagina_cadastro_tecnicos_administrador.php';
    });
}

//PESQUISA
// if (formPesquisa) {
//   formPesquisa.addEventListener('submit', (event) => {
//        event.preventDefault();
//        const busca = inputPesquisa.value.trim();

//          Em vez de mandar para o Controller, manda para a própria página que exibe os técnicos
//         window.location.href = `pagina_gerenciamento_de_tecnicos_adm.php?busca=${encodeURIComponent(busca)}`;
//     });
// }



document.addEventListener('click', (event) => {

    // BOTÃO EXCLUIR
    if (event.target.classList.contains('excluir')) {

        // PEGA O ID DO TÉCNICO
        const id = event.target.dataset.id;

        // VERIFICA SE O ID EXISTE
        if (!id) {
            alert('ID do técnico não encontrado.');
            return;
        }

        // CONFIRMAÇÃO COM OPÇÃO DE CANCELAR
        // confirm() retorna true para OK e false para Cancelar
        const confirmacao = confirm('Tem certeza que deseja excluir este técnico? Esta ação não pode ser desfeita.');

        if (confirmacao) {
            // Se clicou em OK, ENVIA PARA O CONTROLLER
            window.location.href = `${controller}?acao=excluir&id_tecnico=${id}`;
        } else {
            // Se clicou em Cancelar, apenas fecha o aviso
            console.log('Exclusão cancelada pelo usuário.');
        }
    }


    // BOTÃO EDITAR
    if (event.target.classList.contains('editar')) {
        const id = event.target.dataset.id;

        if (!id) {
            alert('ID do técnico não encontrado.');
            return;
        }

        // REDIRECIONA PARA A PÁGINA DE CADASTRO PASSANDO O ID
        // Certifique-se de que o nome do arquivo abaixo é exatamente o que você usa para cadastrar/editar
        window.location.href = `pagina_cadastro_tecnicos_administrador.php?id=${id}`;
    }

});