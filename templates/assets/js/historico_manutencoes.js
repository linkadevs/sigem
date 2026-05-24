const btnVoltar = document.querySelector('.btn_voltar')
const btnPesquisar = document.querySelector('.btn_pesquisar')

if(btnVoltar){
    btnVoltar.addEventListener('click', () => {
        window.history.back()
    })
}

if(btnPesquisar){
    btnPesquisar.addEventListener('click', (e) => {
        e.preventDefault()
        // Lógica de pesquisa futura
    })
}