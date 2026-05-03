const btnVoltar = document.querySelector('.btn_voltar');
const formCadastro = document.getElementById('form_cadastro');
const selectUf = document.getElementById('uf');
const selectCidade = document.getElementById('cidade');

// Botão de voltar
if (btnVoltar) {
    btnVoltar.addEventListener('click', () => {
        window.history.back();
    });
}

// Intercepta o envio para validar
if (formCadastro) {
    formCadastro.addEventListener('submit', (e) => {
        e.preventDefault(); 
        console.log('Todos os campos foram preenchidos corretamente. Salvando...');
        // window.location.href = '';
    });
}

// API IBGE: Carregar Estados
if (selectUf && selectCidade) {
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
        .then(response => response.json())
        .then(estados => {
            estados.forEach(estado => {
                const option = document.createElement('option');
                option.value = estado.sigla; 
                option.textContent = estado.nome;
                selectUf.appendChild(option);
            });
        })
        .catch(erro => console.error("Erro ao carregar estados:", erro));

    // API IBGE: Carregar Cidades quando o Estado muda
    selectUf.addEventListener('change', (e) => {
        const uf = e.target.value;
        
        // Reseta o select de cidades e desabilita temporariamente
        selectCidade.innerHTML = '<option value="" disabled selected>Carregando...</option>';
        selectCidade.disabled = true;

        fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios?orderBy=nome`)
            .then(response => response.json())
            .then(cidades => {
                selectCidade.innerHTML = '<option value="" disabled selected>Cidade</option>';
                cidades.forEach(cidade => {
                    const option = document.createElement('option');
                    option.value = cidade.nome;
                    option.textContent = cidade.nome;
                    selectCidade.appendChild(option);
                });
                selectCidade.disabled = false; // Libera o select pro usuário
            })
            .catch(erro => console.error("Erro ao carregar cidades:", erro));
    });
}