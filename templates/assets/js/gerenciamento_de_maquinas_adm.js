const perfil = document.querySelector('.btn_perfil')
const home = document.querySelector('.btn_home')
const maquinas = document.querySelector('.btn_maquinas')
const clientes = document.querySelector('.btn_clientes')
const chamados = document.querySelector('.btn_chamados')
const manutencoes = document.querySelector('.btn_manutencoes')
const pecas = document.querySelector('.btn_pecas')
const tecnicos = document.querySelector('.btn_tecnicos')
const logout = document.querySelector('.btn_logout')
const maquinasLista = document.querySelectorAll('.card_maquina')

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

maquinasLista.forEach((maquina) => {
    maquina.addEventListener('click', () => {
        const informacao = document.getElementById(`info-${maquina.id}`)
        if(informacao.style.display === 'none') {
            informacao.style.display = 'flex'
        } else {
            informacao.style.display = 'none'
        }
    })
})