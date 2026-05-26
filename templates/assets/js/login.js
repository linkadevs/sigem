const senhaInput = document.getElementById('Senha')
const olhoFechado = document.querySelector('.olho1')
const olhoAberto = document.querySelector('.olho2')
const setaVoltar = document.querySelector('.setaVoltar')

olhoFechado.addEventListener('click', () => {
    olhoFechado.style.display = 'none'
    olhoAberto.style.display = 'flex'
    senhaInput.type = 'text'
})

olhoAberto.addEventListener('click', () => {
    olhoFechado.style.display = 'flex'
    olhoAberto.style.display = 'none'
    senhaInput.type = 'password'
})

setaVoltar.addEventListener('click', () => {
    window.location.href = '../index.php'
})