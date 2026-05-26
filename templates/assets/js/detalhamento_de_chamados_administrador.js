const btnVoltar = document.querySelector('.voltar');
if (btnVoltar) {
    btnVoltar.addEventListener('click', () => {
        window.history.back();
    });
}

const galeriaImagens = document.querySelectorAll('.fotos img');
const modal = document.getElementById('imageModal');
const modalImg = document.getElementById('modalImg');
const closeModal = document.getElementById('closeModal');

if (galeriaImagens.length > 0 && modal) {
    galeriaImagens.forEach(img => {
        img.addEventListener('click', () => {
            modalImg.src = img.src;
            modal.style.display = 'flex';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
}

const perfil = document.querySelector('.btn_perfil');
const maquinas = document.querySelector('.btn_maquinas');
const clientes = document.querySelector('.btn_clientes');
const chamados = document.querySelector('.btn_chamados');
const manutencoes = document.querySelector('.btn_manutencoes');
const pecas = document.querySelector('.btn_pecas');
const tecnicos = document.querySelector('.btn_tecnicos');
const logout = document.querySelector('.btn_logout');
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