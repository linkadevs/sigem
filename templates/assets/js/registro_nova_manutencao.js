const pressaoAferida = document.getElementById('pressao_aferida')
const botaoFotos = document.getElementById('botaoFotos')
const grid = document.querySelector('.grid')
const form = document.querySelector('form')

const nomeTecnico = document.getElementById('nome_tecnico')
const nomeAcompanhante = document.getElementById('nome_acompanhante')
const select = document.getElementById('tipo_servico')
const descricaoServico = document.getElementById('descricao_servico')
const testesFinalizacao = document.getElementById('testes_finalizacao')
const dataHora = document.getElementById('data_hora')
const inputFotos = document.getElementById('fotos')
const cancelarBtn = document.getElementById('cancelar')

// Elementos de reposição de peças
const reposicaoContainer = document.getElementById('reposicao_pecas_container')
const solicitarReposicao = document.getElementById('solicitar_reposicao')
const detalhesPecasContainer = document.getElementById('detalhes_pecas_container')
const nomePeca = document.getElementById('nome_peca')
const quantidadePeca = document.getElementById('quantidade_peca')
const descricaoPeca = document.getElementById('descricao_peca')
const requiredPecaSpans = document.querySelectorAll('.required-peca')

// Botões de navegação
const paginaPrincipalBtn = document.querySelector('.pagina-principal')
const historicoBtn = document.querySelector('.historico')
const botaoVoltar = document.querySelector('.botaoVoltar')

// Tipos de serviço que devem exibir a opção de reposição de peças
const servicosComReposicao = ['manutencao_corretiva', 'manutencao_preventiva', 'inspecao']

// Função para navegação
function navegarPara(destino) {
    console.log(`Navegando para: ${destino}`)
    switch(destino) {
        case 'principal':
            alert('Redirecionando para a página principal...')
            break
        case 'historico':
            alert('Redirecionando para o histórico...')
            break
        case 'voltar':
            alert('Voltando para a página anterior...')
            break
        default:
            break
    }
}

// Eventos de navegação
if (paginaPrincipalBtn) paginaPrincipalBtn.addEventListener('click', () => navegarPara('principal'))
if (historicoBtn) historicoBtn.addEventListener('click', () => navegarPara('historico'))
if (botaoVoltar) botaoVoltar.addEventListener('click', () => navegarPara('voltar'))

// Função para verificar se deve mostrar o campo de reposição de peças
function verificarMostrarReposicao() {
    const tipoSelecionado = select.value
    if (servicosComReposicao.includes(tipoSelecionado)) {
        reposicaoContainer.style.display = 'block'
        if (solicitarReposicao.checked) {
            mostrarDetalhesPecas(true)
        } else {
            mostrarDetalhesPecas(false)
        }
    } else {
        reposicaoContainer.style.display = 'none'
        mostrarDetalhesPecas(false)
        solicitarReposicao.checked = false
        limparCamposPecas()
    }
}

// Função para mostrar/esconder os campos detalhados de peças
function mostrarDetalhesPecas(mostrar) {
    if (mostrar) {
        detalhesPecasContainer.style.display = 'block'
        requiredPecaSpans.forEach(span => span.style.display = 'inline')
        nomePeca.required = true
        quantidadePeca.required = true
        descricaoPeca.required = true
    } else {
        detalhesPecasContainer.style.display = 'none'
        requiredPecaSpans.forEach(span => span.style.display = 'none')
        nomePeca.required = false
        quantidadePeca.required = false
        descricaoPeca.required = false
        limparCamposPecas()
    }
}

// Função para limpar os campos de peças
function limparCamposPecas() {
    nomePeca.value = ''
    quantidadePeca.value = ''
    descricaoPeca.value = ''
}

// Evento para quando o checkbox de solicitar reposição muda
if (solicitarReposicao) {
    solicitarReposicao.addEventListener('change', () => {
        mostrarDetalhesPecas(solicitarReposicao.checked)
    })
}

// Evento para quando o tipo de serviço muda
if (select) {
    select.addEventListener('change', () => {
        let selectedOption = select.options[select.selectedIndex]
        if (selectedOption.value === 'placeholder') {
            select.style.color = '#A0AAAF'
        } else {
            select.style.color = '#000000'
        }
        verificarMostrarReposicao()
    })
}

// Botão de fotos
if (botaoFotos) {
    botaoFotos.addEventListener('click', (e) => {
        e.preventDefault()
        inputFotos.click()
    })
}

// Fazer as fotos selecionadas aparecerem e manipular o texto do botão
if (inputFotos) {
    inputFotos.addEventListener('change', () => {
        grid.innerHTML = ''
        const files = Array.from(inputFotos.files)
        
        files.forEach((element, index) => {
            const url = URL.createObjectURL(element)
            const figure = document.createElement('figure')
            figure.innerHTML = `<img id="${index}" src="${url}" alt="Foto da manutenção">`
            
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
        
        if (inputFotos.files.length > 0) {
            botaoFotos.style.color = '#000000'
            botaoFotos.style.backgroundColor = '#e8f4fd'
            botaoFotos.innerHTML = `${inputFotos.files.length} foto(s) selecionada(s)`
        } else {
            botaoFotos.style.color = '#A0AAAF'
            botaoFotos.style.backgroundColor = '#F9F9F9'
            botaoFotos.innerHTML = 'Selecione fotos da manutenção'
        }
    })
}

// Evento para o botão cancelar
if (cancelarBtn) {
    cancelarBtn.addEventListener('click', () => {
        if (confirm('Tem certeza que deseja cancelar? Todas as informações serão perdidas.')) {
            form.reset()
            grid.innerHTML = ''
            if (botaoFotos) {
                botaoFotos.innerHTML = 'Selecione fotos da manutenção'
                botaoFotos.style.color = '#A0AAAF'
                botaoFotos.style.backgroundColor = '#F9F9F9'
            }
            if (select) select.style.color = '#A0AAAF'
            verificarMostrarReposicao()
            
            if (nomeAcompanhante) nomeAcompanhante.value = ''
            if (descricaoServico) descricaoServico.value = ''
            if (pressaoAferida) pressaoAferida.value = ''
            if (testesFinalizacao) testesFinalizacao.value = ''
        }
    })
}

// Validação do formulário
function verificarCampos() {
    // Validar campos básicos
    if (!nomeAcompanhante || !select || !descricaoServico || !pressaoAferida || !testesFinalizacao || !inputFotos) {
        return false
    }
    
    if (nomeAcompanhante.value.trim() === "" || 
        select.value === "placeholder" || 
        descricaoServico.value.trim() === "" || 
        pressaoAferida.value.trim() === "" || 
        testesFinalizacao.value.trim() === "" || 
        inputFotos.files.length === 0) {
        
        alert('Por favor, preencha todos os campos obrigatórios (*) e selecione pelo menos uma foto antes de enviar o formulário.')
        
        const primeiroCampoVazio = document.querySelector('input:not([disabled])[required]:invalid, select[required]:invalid, textarea[required]:invalid')
        if (primeiroCampoVazio) {
            primeiroCampoVazio.scrollIntoView({ behavior: 'smooth', block: 'center' })
            primeiroCampoVazio.focus()
        }
        return false
    }
    
    // Validar campos de reposição de peças se necessário
    const tipoSelecionado = select.value
    if (servicosComReposicao.includes(tipoSelecionado) && solicitarReposicao && solicitarReposicao.checked) {
        if (!nomePeca || !quantidadePeca || !descricaoPeca) return false
        
        if (nomePeca.value.trim() === "" || 
            quantidadePeca.value.trim() === "" || 
            descricaoPeca.value.trim() === "") {
            alert('Por favor, preencha todos os campos da peça em falta (nome, quantidade e descrição).')
            return false
        }
        
        if (parseInt(quantidadePeca.value) <= 0) {
            alert('A quantidade da peça deve ser maior que zero.')
            return false
        }
    }
    
    // Validar pressão aferida (PSI)
    const pressao = parseFloat(pressaoAferida.value)
    if (isNaN(pressao) || pressao < 0) {
        alert('Por favor, insira um valor válido para a pressão aferida em PSI.')
        return false
    }
    
    // Validar se pressão está dentro de uma faixa razoável (opcional)
    if (pressao > 10000) {
        if (!confirm('Atenção: O valor da pressão está muito alto (' + pressao + ' PSI). Tem certeza que este valor está correto?')) {
            return false
        }
    }
    
    return true
}

// Função para formatar e validar a pressão em tempo real
if (pressaoAferida) {
    pressaoAferida.addEventListener('input', () => {
        let valor = parseFloat(pressaoAferida.value)
        
        if (isNaN(valor)) {
            return
        }
        
        // Limitar a 2 casas decimais
        if (pressaoAferida.value.includes('.')) {
            const partes = pressaoAferida.value.split('.')
            if (partes[1] && partes[1].length > 2) {
                pressaoAferida.value = parseFloat(pressaoAferida.value).toFixed(2)
            }
        }
        
        // Não permitir valores negativos
        if (valor < 0) {
            pressaoAferida.value = 0
        }
        
        // Remover caracteres não numéricos (exceto ponto e números)
        let valorStr = pressaoAferida.value.replace(/[^\d.-]/g, '')
        if (valorStr.split('-').length > 2) {
            valorStr = valorStr.replace(/-/g, '')
        }
        pressaoAferida.value = valorStr
    })
    
    // Validar ao sair do campo
    pressaoAferida.addEventListener('blur', () => {
        let valor = parseFloat(pressaoAferida.value)
        if (!isNaN(valor) && valor >= 0) {
            // Manter apenas 2 casas decimais
            pressaoAferida.value = parseFloat(valor.toFixed(2))
        }
    })
}

// Envio do formulário
if (form) {
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        
        if (verificarCampos()) {
            // Sincronizar valores dos campos desabilitados com os hidden fields
            const nomeTecnicoHidden = document.getElementById('nome_tecnico_hidden')
            const dataHoraHidden = document.getElementById('data_hora_hidden')
            
            if (nomeTecnicoHidden && nomeTecnico) nomeTecnicoHidden.value = nomeTecnico.value
            if (dataHoraHidden && dataHora) dataHoraHidden.value = dataHora.value
            
            // Adicionar a unidade PSI ao valor da pressão se necessário
            const pressaoFinal = document.getElementById('pressao_aferida')
            if (pressaoFinal && pressaoFinal.value) {
                console.log(`Pressão registrada: ${pressaoFinal.value} PSI`)
            }
            
            alert('Formulário enviado com sucesso!\nPressão: ' + pressaoAferida.value + ' PSI')
            // form.submit() // Descomente para enviar realmente
        }
    })
}

// Prevenir envio duplicado
let enviando = false
if (form) {
    form.addEventListener('submit', (e) => {
        if (enviando) {
            e.preventDefault()
            return
        }
        enviando = true
        setTimeout(() => {
            enviando = false
        }, 3000)
    })
}

// Inicializar a verificação ao carregar a página
verificarMostrarReposicao()