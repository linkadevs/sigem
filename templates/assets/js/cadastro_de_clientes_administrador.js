const btnVoltar = document.querySelector('.btn_voltar')
const btnSalvar = document.querySelector('.btn_salvar')

if(btnVoltar){
    btnVoltar.addEventListener('click', () => {
        // Volta pra página anterior no histórico, mas você pode mudar pro window.location.href padrão
        window.history.back()
    })
}

if(btnSalvar){
    btnSalvar.addEventListener('click', () => {
        // Coloque aqui o window.location.href da próxima página depois de salvar
        console.log('Cliente salvo com sucesso')
    })
}