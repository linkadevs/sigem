const perfil = document.querySelector('.btn_perfil');
const maquinas = document.querySelector('.btn_maquinas');
const clientes = document.querySelector('.btn_clientes');
const chamados = document.querySelector('.btn_chamados');
const manutencoes = document.querySelector('.btn_manutencoes');
const pecas = document.querySelector('.btn_pecas');
const tecnicos = document.querySelector('.btn_tecnicos');
const logout = document.querySelector('.btn_logout');
const cancelarbtn = document.querySelectorAll('.cancelar');
const concluirbtn = document.querySelectorAll('.concluir');
const home = document.querySelector('.btn_home')


if(perfil){
perfil.addEventListener('click',() => {
    window.location.href='perfil_do_adm.php'
})
}

if(home){
    home.addEventListener('click', () => {
        window.location.href = 'pagina_principal_adm.php'
    })
}

if(maquinas){
    maquinas.addEventListener('click', ()=>{
        window.location.href='gerenciamento_de_maquinas_adm.php'
    })
}

if(clientes){
    clientes.addEventListener('click', ()=>{
        window.location.href = 'pagina_gerenciamento_clientes.php'
    })
}

if(chamados){
    chamados.addEventListener('click', ()=>{
        window.location.href='pagina_acompanhamento_de_chamados_adm.php'
    })
}

if(manutencoes){
    manutencoes.addEventListener('click', () => {
        window.location.href='gerenciamento_de_manutencoes_adm.php'
    })
}

if(pecas){
    pecas.addEventListener('click',()=>{
        window.location.href='pagina_gerenciamento_de_pecas_administrador.php'
    })
}

if(tecnicos){
    tecnicos.addEventListener('click', ()=>{
        window.location.href='pagina_gerenciamento_de_tecnicos_adm.php'
    })
}

if(logout){
    logout.addEventListener('click', ()=>{
        window.location.href='../index.php'
    })
}

const controller = '../Controller/PecasController.php';



document.addEventListener('click', (event) => {

    // BOTÃO CANCELAR
    if (event.target.classList.contains('cancelar')) {

        // PEGA O ID 
        const id = event.target.dataset.id;

        // VERIFICA SE O ID EXISTE
        if (!id) {
            alert('ID da Solicitação não encontrada.');
            return;
        }

        // CONFIRMAÇÃO COM OPÇÃO DE CANCELAR
        const confirmacao = confirm('Tem certeza que deseja cancelar esta solicitação de Peça? Esta ação não poderá ser desfeita e a solicitação será excluída do banco de dados ');

            if (confirmacao) {
            // Se clicou em OK, ENVIA PARA O CONTROLLER
            window.location.href = `${controller}?acao=excluir&id_solicitacao_pecas=${id}`;
        } else {
            // Se clicou em Cancelar, apenas fecha o aviso
            console.log('Exclusão cancelada pelo usuário.');
        }
    }


 if (event.target.classList.contains('concluir')) {

        const id = event.target.dataset.id;

        if (!id) {

            alert('ID da solicitação não encontrado.');
            return;
        }

        const confirmacao = confirm(
            'Deseja concluir esta solicitação?'
        );

        if (confirmacao) {
            window.location.href = `${controller}?acao=concluir&id_solicitacao_pecas=${id}`;
        }
    }

    });
