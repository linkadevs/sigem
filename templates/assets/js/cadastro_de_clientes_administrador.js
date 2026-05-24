const estadoSelect = document.getElementById('uf');
const cidadeSelect = document.getElementById('cidade');


// Carregar estados
fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
    .then(res => res.json())
    .then(estados => {

        estados.sort((a, b) => a.nome.localeCompare(b.nome));

        estados.forEach(estado => {
            estadoSelect.innerHTML += `
                <option value="${estado.sigla}">
                    ${estado.nome}
                </option>
            `;
        });
    });


// Quando escolher estado
estadoSelect.addEventListener('change', () => {

    const uf = estadoSelect.value;

    cidadeSelect.innerHTML =
        '<option value="">Selecione uma cidade</option>';

    fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
        .then(res => res.json())
        .then(cidades => {

            cidades.forEach(cidade => {

                cidadeSelect.innerHTML += `
                    <option value="${cidade.nome}">
                        ${cidade.nome}
                    </option>
                `;
            });

        });

});