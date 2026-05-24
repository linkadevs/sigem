const perfil = document.querySelector('.btn_perfil');
const maquinas = document.querySelector('.btn_maquinas');
const clientes = document.querySelector('.btn_clientes');
const chamados = document.querySelector('.btn_chamados');
const manutencoes = document.querySelector('.btn_manutencoes');
const pecas = document.querySelector('.btn_pecas');
const tecnicos = document.querySelector('.btn_tecnicos');
const logout = document.querySelector('.btn_logout');
const pmocs = document.querySelectorAll('.pmoc');


if(perfil){
perfil.addEventListener('click',() => {
    window.location.href=''
})
}

if(maquinas){
    maquinas.addEventListener('click', ()=>{
        window.location.href=''
    })
}

if(clientes){
    clientes.addEventListener('click', ()=>{
        window.location.href = ''
    })
}

if(chamados){
    chamados.addEventListener('click', ()=>{
        window.location.href=''
    })
}

if(manutencoes){
    manutencoes.addEventListener('click', () => {
        window.location.href=''
    })
}

if(pecas){
    pecas.addEventListener('click',()=>{
        window.location.href=''
    })
}

if(tecnicos){
    tecnicos.addEventListener('click', ()=>{
        window.location.href=''
    })
}

if(logout){
    logout.addEventListener('click', ()=>{
        window.location.href=''
    })
}

pmocs.forEach(pmoc => {
    if (pmoc) {
        pmoc.addEventListener('click', () => { 
            window.location.href = '';
        });
    }
});