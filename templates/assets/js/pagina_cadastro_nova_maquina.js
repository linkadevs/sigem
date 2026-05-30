const form = document.querySelector('form')
const btu = document.getElementById('capacidade_termica')
const inputs = document.querySelectorAll('input, select')
const cancelar = document.querySelector('.cancelar')
const voltar = document.querySelector('.voltar_header')

voltar.addEventListener('click', () => {
    window.location.href = 'gerenciamento_de_maquinas_adm.php'
})

btu.addEventListener('input', () => {

    btu.value = btu.value.replace(/\D/g, '')
    let cursor = btu.value.length
    if (cursor != 0) {
        btu.value = btu.value + ' BTU/h'
    }
    btu.setSelectionRange(cursor, cursor)

})

form.addEventListener('submit', (e) => {
    e.preventDefault()
    if(verificarInputs()) {
        btu.value = btu.value.replace(/\D/g, '')
        form.submit()
    }
})

const verificarInputs = () => {
    let correct = true
    inputs.forEach((input) => {
        if(input.value == '') {
            correct = false
        }
    })
    if(correct == false) {
        alert('Por favor, preencha todos os campos!')
    }
    return correct
}

cancelar.addEventListener('click', () => {
    window.location.href = 'gerenciamento_de_maquinas_adm.php'
})