const perfil = document.querySelector('.btn_perfil')
const home = document.querySelector('.btn_home')
const maquinas = document.querySelector('.btn_maquinas')
const clientes = document.querySelector('.btn_clientes')
const chamados = document.querySelector('.btn_chamados')
const manutencoes = document.querySelector('.btn_manutencoes')
const pecas = document.querySelector('.btn_pecas')
const tecnicos = document.querySelector('.btn_tecnicos')
const logout = document.querySelector('.btn_logout')

// Redirecionamento ao clicar no card da máquina
const cardsMaquinas = document.querySelectorAll('.card_maquina')

if(cardsMaquinas.length > 0){
    cardsMaquinas.forEach(card => {
        card.addEventListener('click', () => {
            // Substitua com a URL correta na arquitetura MVC do PHP depois
            window.location.href = 'detalhamento_de_chamados_administrador.html'
        })
    })
}

// Botão de Nova Máquina
const btnNovaMaquina = document.querySelector('.btn_nova_maquina')

if(btnNovaMaquina){
    btnNovaMaquina.addEventListener('click', () => {
        // window.location.href = 'cadastro_nova_maquina.html'
    })
}

// Botões do Menu Lateral
const botoesMenu = document.querySelectorAll('aside button')

botoesMenu.forEach(botao => {
    botao.addEventListener('click', () => {
        // window.location.href = ''
    })
})

if(perfil){
    perfil.addEventListener('click', () => {
        window.location.href = ''
    })
}

if(home){
    home.addEventListener('click', () => {
        window.location.href = ''
    })
}

if(maquinas){
    maquinas.addEventListener('click', () => {
        window.location.href = ''
    })
}

if(clientes){
    clientes.addEventListener('click', () => {
        window.location.href = ''
    })
}

if(chamados){
    chamados.addEventListener('click', () => {
        window.location.href = ''
    })
}

if(manutencoes){
    manutencoes.addEventListener('click', () => {
        window.location.href = ''
    })
}

if(pecas){
    pecas.addEventListener('click', () => {
        window.location.href = ''
    })
}

if(tecnicos){
    tecnicos.addEventListener('click', () => {
        window.location.href = ''
    })
}

if(logout){
    logout.addEventListener('click', () => {
        window.location.href = ''
    })
}