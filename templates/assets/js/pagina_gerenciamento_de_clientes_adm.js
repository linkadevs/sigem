
const home = document.querySelector('.btn_home');
const perfil = document.querySelector('.btn_perfil');
const maquinas = document.querySelector('.btn_maquinas');
const clientes = document.querySelector('.btn_clientes');
const chamados = document.querySelector('.btn_chamados');
const manutencoes = document.querySelector('.btn_manutencoes');
const pecas = document.querySelector('.btn_pecas');
const tecnicos = document.querySelector('.btn_tecnicos');
const logout = document.querySelector('.btn_logout');
const btnCriarCliente = document.querySelector('.criarCliente');
const formPesquisa = document.querySelector('.conteudo_superior form');
const inputPesquisa = document.querySelector('.pesquisar');


if (home) { home.addEventListener('click', () => { window.location.href = 'pagina_principal_adm.php'; }); }
if (perfil) { perfil.addEventListener('click', () => { window.location.href = 'perfil_do_adm.php'; }); }
if (maquinas) { maquinas.addEventListener('click', () => { window.location.href = 'gerenciamento_de_maquinas_adm.php'; }); }
if (clientes) { clientes.addEventListener('click', () => { window.location.href = 'pagina_gerenciamento_clientes.php'; }); }
if (chamados) { chamados.addEventListener('click', () => { window.location.href = 'pagina_acompanhamento_de_chamados_adm.php'; }); }
if (manutencoes) { manutencoes.addEventListener('click', () => { window.location.href = 'gerenciamento_de_manutencoes_adm.php'; }); }
if (pecas) { pecas.addEventListener('click', () => { window.location.href = 'pagina_gerenciamento_de_pecas_administrador.php'; }); }
if (tecnicos) { tecnicos.addEventListener('click', () => { window.location.href = 'pagina_gerenciamento_de_tecnicos_adm.php'; }); }
if (logout) { logout.addEventListener('click', () => { window.location.href = 'pagina_inicial.php'; }); }

const controller = '../Controller/GerenciamentoClienteController.php';
// NOVO CLIENTE
 if (btnCriarCliente) 
{ btnCriarCliente.addEventListener('click', () => {
     window.location.href = 'cadastro_de_clientes_administrador.php'; }); } 




     document.addEventListener('click', (event) => {

    // BOTÃO EXCLUIR
    if (event.target.classList.contains('excluir')) {

        // PEGA O ID DO CLIENTE
        const id = event.target.dataset.id;

        // VERIFICA SE O ID EXISTE
        if (!id) {
            alert('ID do cliente não encontrado.');
            return;
        }

        // CONFIRMAÇÃO COM OPÇÃO DE CANCELAR
        // confirm() retorna true para OK e false para Cancelar
        const confirmacao = confirm('Tem certeza que deseja excluir este cliente? Esta ação não poderá ser desfeita.');

        if (confirmacao) {
            // Se clicou em OK, ENVIA PARA O CONTROLLER
            window.location.href = `${controller}?acao=excluir&id_cliente=${id}`;
        } else {
            // Se clicou em Cancelar, apenas fecha o aviso
            console.log('Exclusão cancelada pelo usuário.');
        }
    }


    // BOTÃO EDITAR
    if (event.target.classList.contains('editar')) {
        const id = event.target.dataset.id;

        if (!id) {
            alert('ID do cliente não encontrado.');
            return;
        }

        // REDIRECIONA PARA A PÁGINA DE CADASTRO PASSANDO O ID
        window.location.href = `cadastro_de_clientes_administrador.php?id=${id}`;
    }

});