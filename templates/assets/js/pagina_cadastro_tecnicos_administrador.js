const olhofechado = document.querySelector('.olhofechado')
const olhoaberto = document.querySelector('.olhoaberto')
const voltar = document.querySelector('.voltar')
const camposenha = document.querySelector('#senha')


if (voltar) {
    voltar.addEventListener('click', () => {
        window.location.href = 'pagina_gerenciamento_de_tecnicos_adm.php'
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