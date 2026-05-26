const perfil = document.querySelector('.btn_perfil');
const home = document.querySelector('.btn_home');
const maquinas = document.querySelector('.btn_maquinas');
const clientes = document.querySelector('.btn_clientes');
const chamados = document.querySelector('.btn_chamados');
const manutencoes = document.querySelector('.btn_manutencoes');
const pecas = document.querySelector('.btn_pecas');
const tecnicos = document.querySelector('.btn_tecnicos');
const logout = document.querySelector('.btn_logout');
const blocos = document.querySelectorAll('.bloco');


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

blocos.forEach(bloco => {
    if (bloco) {
        bloco.addEventListener('click', () => { 
            window.location.href = `detalhamento_de_chamados_administrador.php?id_chamado=${bloco.id}`;
        });
    }
});
