const botaoFotos = document.getElementById('botaoFotos')
const grid = document.querySelector('.grid')
const form = document.querySelector('form')

const nome = document.getElementById('nome')
const data = document.getElementById('data')
const uf = document.getElementById('uf')
const cidade = document.getElementById('cidade')
const descricao = document.getElementById('descricao')
const inputFotos = document.getElementById('fotos')

botaoFotos.addEventListener('click', (e) => {
    e.preventDefault()
    inputFotos.click()
})

if (data.value == "") {
    data.style.color = '#A0AAAF'
} else {
    data.style.color = '#094C71'
}
// mudar cor do texto data e hora quando tiver algo digitado.
data.addEventListener('input', () => {
    if (data.value == "") {
        data.style.color = '#A0AAAF'
    } else {
        data.style.color = '#094C71'
    }
})


grid.innerHTML = ''
Array.from(inputFotos.files).forEach((element, index) => {
    const url = URL.createObjectURL(element)
    grid.innerHTML += `
    <figure>
        <img id="${index}" src="${url}" alt="Foto da manutenção">
    </figure>
    `
})
if (inputFotos.files.length > 0) {
    botaoFotos.style.color = '#000000'
    botaoFotos.innerHTML = `${inputFotos.files.length} fotos selecionadas.`
} else {
    botaoFotos.style.color = '#A0AAAF'
    botaoFotos.innerHTML = 'Selecione fotos da manutenção'
}


// Fazer as fotos selecionadas aparecer em baixo e manipular o texto do botão
inputFotos.addEventListener('change', () => {
    grid.innerHTML = ''
    Array.from(inputFotos.files).forEach((element, index) => {
        const url = URL.createObjectURL(element)
        grid.innerHTML += `
        <figure>
            <img id="${index}" src="${url}" alt="Foto da manutenção">
        </figure>
        `
    })
    if (inputFotos.files.length > 0) {
        botaoFotos.style.color = '#000000'
        botaoFotos.innerHTML = `${inputFotos.files.length} fotos selecionadas.`
    } else {
        botaoFotos.style.color = '#A0AAAF'
        botaoFotos.innerHTML = 'Selecione fotos da manutenção'
    }
})



form.addEventListener('submit', (e) => {
    e.preventDefault()
    verificarCampos()
})

const verificarCampos = () => {
    if (nome.value == "" || data.value == "" || uf.value == "" || cidade.value == "" || descricao.value == "" || inputFotos.files.length == 0) {
        alert('Por favor, preencha todos os campos e selecione pelo menos uma foto antes de enviar o formulário.')
    } else {
        form.submit()
    }
}