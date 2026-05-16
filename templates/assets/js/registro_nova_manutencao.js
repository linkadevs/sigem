// ==============================================
// VARIÁVEIS - ELEMENTOS DO DOM
// ==============================================

// Campos principais
const pressaoAferida = document.getElementById('pressao_aferida')
const botaoFotos = document.getElementById('botaoFotos')
const grid = document.querySelector('.grid')
const form = document.querySelector('form')

// Dados da manutenção
const nomeTecnico = document.getElementById('nome_tecnico')
const nomeAcompanhante = document.getElementById('nome_acompanhante')
const select = document.getElementById('tipo_servico')
const descricaoServico = document.getElementById('descricao_servico')
const testesFinalizacao = document.getElementById('testes_finalizacao')
const dataHora = document.getElementById('data_hora')
const inputFotos = document.getElementById('fotos')
const cancelarBtn = document.getElementById('cancelar')

// Campos de reposição de peças
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

// Tipos de serviço que permitem reposição de peças
const servicosComReposicao = ['manutencao_corretiva', 'manutencao_preventiva', 'inspecao']

// ==============================================
// FUNÇÃO DE NAVEGAÇÃO
// ==============================================
function navegarPara(destino) {
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
    }
}

// ==============================================
// EVENTOS DOS BOTÕES DE NAVEGAÇÃO
// ==============================================
if (paginaPrincipalBtn) paginaPrincipalBtn.addEventListener('click', () => navegarPara('principal'))
if (historicoBtn) historicoBtn.addEventListener('click', () => navegarPara('historico'))
if (botaoVoltar) botaoVoltar.addEventListener('click', () => navegarPara('voltar'))

// ==============================================
// FUNÇÃO: VERIFICAR SE DEVE MOSTRAR REPOSIÇÃO DE PEÇAS
// Se o tipo de serviço permite reposição, mostra o container
// ==============================================
function verificarMostrarReposicao() {
    const tipoSelecionado = select.value
    if (servicosComReposicao.includes(tipoSelecionado)) {
        reposicaoContainer.style.display = 'block'
        mostrarDetalhesPecas(solicitarReposicao.checked)
    } else {
        reposicaoContainer.style.display = 'none'
        mostrarDetalhesPecas(false)
        solicitarReposicao.checked = false
        limparCamposPecas()
    }
}

// ==============================================
// FUNÇÃO: MOSTRAR/ESCONDER DETALHES DAS PEÇAS
// ==============================================
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

// ==============================================
// FUNÇÃO: LIMPAR CAMPOS DE PEÇAS
// ==============================================
function limparCamposPecas() {
    nomePeca.value = ''
    quantidadePeca.value = ''
    descricaoPeca.value = ''
}

// ==============================================
// EVENTO: CHECKBOX SOLICITAR REPOSIÇÃO
// ==============================================
if (solicitarReposicao) {
    solicitarReposicao.addEventListener('change', () => {
        mostrarDetalhesPecas(solicitarReposicao.checked)
    })
}

// ==============================================
// EVENTO: SELECT DE TIPO DE SERVIÇO
// ==============================================
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

// ==============================================
// EVENTO: BOTÃO DE FOTOS - ABRIR SELETOR DE ARQUIVOS
// ==============================================
if (botaoFotos) {
    botaoFotos.addEventListener('click', (e) => {
        e.preventDefault()
        inputFotos.click()
    })
}

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
        
        // Atualizar texto do botão com quantidade de fotos
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

// ==============================================
// EVENTO: BOTÃO CANCELAR - LIMPAR FORMULÁRIO
// ==============================================
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

// ==============================================
// FUNÇÃO: VERIFICAR TODOS OS CAMPOS OBRIGATÓRIOS
// Retorna true se todos os campos estiverem preenchidos
// Mostra alert específico para cada campo vazio
// ==============================================
function verificarCampos() {
    // ==============================================
    // 1. VERIFICA CAMPOS PRINCIPAIS
    // ==============================================
    
    // Acompanhante
    if (!nomeAcompanhante || nomeAcompanhante.value.trim() === "") {
        alert('❌ Campo obrigatório: Acompanhante do serviço')
        if (nomeAcompanhante) nomeAcompanhante.focus();
        return false;
    }
    
    // Tipo de serviço (select)
    if (!select || select.value === "placeholder") {
        alert('❌ Campo obrigatório: Selecione um tipo de serviço')
        if (select) select.focus();
        return false;
    }
    
    // Descrição do serviço
    if (!descricaoServico || descricaoServico.value.trim() === "") {
        alert('❌ Campo obrigatório: Descrição do serviço')
        if (descricaoServico) descricaoServico.focus();
        return false;
    }
    
    // Pressão aferida
    if (!pressaoAferida || pressaoAferida.value.trim() === "") {
        alert('❌ Campo obrigatório: Pressão aferida (PSI)')
        if (pressaoAferida) pressaoAferida.focus();
        return false;
    }
    
    // Testes e finalização
    if (!testesFinalizacao || testesFinalizacao.value.trim() === "") {
        alert('❌ Campo obrigatório: Testes e finalização')
        if (testesFinalizacao) testesFinalizacao.focus();
        return false;
    }
    
    // Fotos
    if (!inputFotos || inputFotos.files.length === 0) {
        alert('❌ Campo obrigatório: Selecione pelo menos uma foto')
        if (botaoFotos) botaoFotos.focus();
        return false;
    }
    
    // ==============================================
    // 2. VERIFICA CAMPOS DE PEÇAS (SE CHECKBOX MARCADO)
    // ==============================================
    const tipoSelecionado = select.value;
    if (servicosComReposicao.includes(tipoSelecionado) && solicitarReposicao && solicitarReposicao.checked) {
        
        // Nome da peça
        if (!nomePeca || nomePeca.value.trim() === "") {
            alert('❌ Campo obrigatório: Nome da peça em falta')
            if (nomePeca) nomePeca.focus();
            return false;
        }
        
        // Quantidade da peça
        if (!quantidadePeca || quantidadePeca.value.trim() === "") {
            alert('❌ Campo obrigatório: Quantidade da peça')
            if (quantidadePeca) quantidadePeca.focus();
            return false;
        }
        
        // Verifica se quantidade é maior que zero
        if (parseInt(quantidadePeca.value) <= 0) {
            alert('❌ A quantidade da peça deve ser maior que zero')
            if (quantidadePeca) quantidadePeca.focus();
            return false;
        }
        
        // Descrição da peça
        if (!descricaoPeca || descricaoPeca.value.trim() === "") {
            alert('❌ Campo obrigatório: Descrição da peça em falta')
            if (descricaoPeca) descricaoPeca.focus();
            return false;
        }
    }
    
    // ==============================================
    // 3. VALIDAÇÃO ADICIONAL DA PRESSÃO
    // ==============================================
    const pressao = parseFloat(pressaoAferida.value);
    if (isNaN(pressao)) {
        alert('❌ Pressão aferida deve ser um número válido')
        if (pressaoAferida) pressaoAferida.focus();
        return false;
    }
    
    if (pressao < 0) {
        alert('❌ Pressão aferida não pode ser negativa')
        if (pressaoAferida) pressaoAferida.focus();
        return false;
    }
    
    // ==============================================
    // 4. TUDO OK
    // ==============================================
    return true;
}

// ==============================================
// VALIDAÇÃO DA PRESSÃO EM TEMPO REAL
// ==============================================
if (pressaoAferida) {
    // Enquanto digita: limita a 2 casas decimais
    pressaoAferida.addEventListener('input', () => {
        let valor = parseFloat(pressaoAferida.value)
        if (isNaN(valor)) return
        
        if (pressaoAferida.value.includes('.')) {
            const partes = pressaoAferida.value.split('.')
            if (partes[1] && partes[1].length > 2) {
                pressaoAferida.value = parseFloat(pressaoAferida.value).toFixed(2)
            }
        }
        
        if (valor < 0) pressaoAferida.value = 0
        
        let valorStr = pressaoAferida.value.replace(/[^\d.-]/g, '')
        if (valorStr.split('-').length > 2) {
            valorStr = valorStr.replace(/-/g, '')
        }
        pressaoAferida.value = valorStr
    })
    
    // Ao sair do campo: formata o valor
    pressaoAferida.addEventListener('blur', () => {
        let valor = parseFloat(pressaoAferida.value)
        if (!isNaN(valor) && valor >= 0) {
            pressaoAferida.value = parseFloat(valor.toFixed(2))
        }
    })
}

// ==============================================
// ENVIO DO FORMULÁRIO
// ==============================================
let enviando = false

if (form) {
    form.addEventListener('submit', (e) => {
        e.preventDefault() // Impede o envio normal para validar primeiro
        
        if (enviando) {
            alert('Aguarde, o formulário já está sendo enviado...')
            return
        }
        
        if (verificarCampos()) {
            enviando = true
            
            // Sincroniza campos hidden
            const nomeTecnicoHidden = document.getElementById('nome_tecnico_hidden')
            const dataHoraHidden = document.getElementById('data_hora_hidden')
            
            if (nomeTecnicoHidden && nomeTecnico) nomeTecnicoHidden.value = nomeTecnico.value
            if (dataHoraHidden && dataHora) dataHoraHidden.value = dataHora.value
            
            form.submit() // Envia o formulário
        }
    })
}

// ==============================================
// INICIALIZAÇÃO
// ==============================================
verificarMostrarReposicao()