const pressaoAferida = document.getElementById('pressao_aferida')
const botaoFotos = document.getElementById('botaoFotos')
const grid = document.querySelector('.grid')
const form = document.querySelector('form')
const cancelar = document.getElementById('cancelar')
const nomeTecnico = document.getElementById('nome_tecnico')
const nomeAcompanhante = document.getElementById('nome_acompanhante')
const select = document.getElementById('tipo_servico')
const descricaoServico = document.getElementById('descricao_servico')
const testesFinalizacao = document.getElementById('testes_finalizacao')
const dataHora = document.getElementById('data_hora')
const inputFotos = document.getElementById('fotos')
const voltarBtn = document.querySelector('.botaoVoltar')
const reposicao = document.getElementById('reposicao_pecas_container')
const reposicaoCheckbox = document.getElementById('solicitar_reposicao')
const detalhes = document.querySelector('.detalhes-pecas')

const nomePeca = document.getElementById('nome_peca')
const quantidadePeca = document.getElementById('quantidade_peca')
const descricaoPeca = document.getElementById('descricao_peca')

cancelar.addEventListener('click', () => {
    if(!confirm('O registro de manutenção é obrigatório após o serviço. Ao clicar em "cancelar" você está será responsabilizado pela ausência desse registro.')){
        window.location.href = 'pagina_principal_do_tecnico.php';
    }
})

voltarBtn.addEventListener('click', () => {
    if(!confirm('O registro de manutenção é obrigatório após o serviço. Ao clicar em "cancelar" você está será responsabilizado pela ausência desse registro.')){
        window.location.href = 'pagina_principal_do_tecnico.php'
    }
})

botaoFotos.addEventListener('click', (e) => {
    e.preventDefault()
    inputFotos.click()
})

// Isso é para mudar a cor do texto do SELECT quando o usuário selecionar algo.

select.addEventListener('change', () => {
    let selectedOption = select.options[select.selectedIndex]
    if (selectedOption.value === 'placeholder') {
        select.style.color = '#A0AAAF'
    } else {
        select.style.color = '#000000'
    }
})

// Caso alguém venha editar
// No banco utilizaremos apenas o número da pressão
// Mas o usuário verá o número E "PSI" no input.
// Para isso, o input que ele vê e clica é o que será adicionado "PSI" sempre que ele digitar algo
// E tem um input "hidden" que não aparece pro usuário, e que guarda apenas o número que ele digitou, sem o PSI, para mandar pro banco.

pressaoAferida.addEventListener('input', () => {
    // 1. Salva apenas o que é número no input hidden
    // O regex /\D/g remove tudo que não for dígito
    let apenasNumeros = pressaoAferida.value.replace(/\D/g, '');
    pressaoAferida.value = apenasNumeros;
});

pressaoAferida.addEventListener('blur', () => {
    // 2. Quando o usuário sai do campo, adiciona o "PSI" visualmente
    if (pressaoAferida.value !== "") {
        let valor = pressaoAferida.value.replace(' PSI', ''); // Evita duplicar
        pressaoAferida.value = `${valor} PSI`;
    }
});

pressaoAferida.addEventListener('focus', () => {
    // 3. Quando ele clica de volta, remove o "PSI" para ele editar só o número
    pressaoAferida.value = pressaoAferida.value.replace(' PSI', '');
});



// mudar cor do texto data e hora quando tiver algo digitado.
dataHora.addEventListener('input', () => {
    if (dataHora.value == "") {
        dataHora.style.color = '#A0AAAF'
    } else {
        dataHora.style.color = '#000000'
    }
})



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
    if (reposicaoCheckbox.checked === false) {
        if (nomeTecnico.value === "" || nomeAcompanhante.value === "" || select.value === "placeholder" || descricaoServico.value === "" || pressaoAferida.value === "" || testesFinalizacao.value === "" || dataHora.value === "" || inputFotos.files.length === 0) {
            alert('Por favor, preencha todos os campos e selecione pelo menos uma foto antes de enviar o formulário.')
        } else {
            pressaoAferida.value = pressaoAferida.value.replace(' PSI', '')
            form.submit()
        }
    } else {
        if (nomeTecnico.value === "" || nomeAcompanhante.value === "" || select.value === "placeholder" || descricaoServico.value === "" || pressaoAferida.value === "" || testesFinalizacao.value === "" || dataHora.value === "" || inputFotos.files.length === 0 || nomePeca.value === "" || quantidadePeca === "" || descricaoPeca === "") {
            alert('Por favor, preencha todos os campos e selecione pelo menos uma foto antes de enviar o formulário.')
        } else {
            pressaoAferida.value = pressaoAferida.value.replace(' PSI', '')
            form.submit()
        }
    }
}

select.addEventListener('change', () => {
    if(select.value != 'instalacao' && select.value != 'placeholder') {
        reposicao.style.display = 'flex'
    } else {
        reposicao.style.display = 'none'
        reposicaoCheckbox.checked = false
        detalhes.style.display = 'none'
    }
})


reposicaoCheckbox.addEventListener('change', () => {
    if(reposicaoCheckbox.checked) {
        detalhes.style.display = 'flex'
    } else {
        detalhes.style.display = 'none'
    }
})

// ==============================================
// EVENTO: INPUT DE FOTOS - PREVIEW DAS IMAGENS
// ==============================================
if (inputFotos) {
    inputFotos.addEventListener('change', () => {
        grid.innerHTML = ''
        const files = Array.from(inputFotos.files)
        
        files.forEach((element, index) => {
            const url = URL.createObjectURL(element)
            const figure = document.createElement('figure')
            figure.innerHTML = `<img id="${index}" src="${url}" alt="Foto da manutenção">`
            
            // Remover foto ao clicar
            figure.addEventListener('click', () => {
                if (confirm('Deseja remover esta foto?')) {
                    const dt = new DataTransfer()
                    const remainingFiles = files.filter((_, i) => i !== index)
                    remainingFiles.forEach(file => dt.items.add(file))
                    inputFotos.files = dt.files
                    inputFotos.dispatchEvent(new Event('change'))
                }
            })
            
            grid.appendChild(figure)
        })
    })}

select.dispatchEvent(new Event('change'));