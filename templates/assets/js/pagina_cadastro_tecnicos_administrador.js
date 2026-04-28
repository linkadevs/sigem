const olhofechado = document.querySelector('.olhofechado')
const olhoaberto = document.querySelector('.olhoaberto')
const voltar = document.querySelector('.voltar')
const salvar = document.querySelector('.salvar')
const camposenha = document.querySelector('#senha')


if (voltar) {
    voltar.addEventListener('click', () => {
        window.location.href = ''
    })
}

if (salvar) {
    salvar.addEventListener('click', () => {
        window.location.href = ''
    })
}

function versenha() {
    if (camposenha.type === 'password') {
        camposenha.type = 'text'
        olhofechado.style.display = 'none'
        olhoaberto.style.display = 'block'
    } else {
        camposenha.type = 'password'
        olhofechado.style.display = 'block'
        olhoaberto.style.display = 'none'
    }
}

olhofechado.addEventListener('click', versenha)
olhoaberto.addEventListener('click', versenha)