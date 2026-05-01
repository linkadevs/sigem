const btnVoltar = document.querySelector('.btn_voltar')
const btnCancelar = document.querySelector('.btn_cancelar')
const btnSalvar = document.querySelector('.btn_salvar')

if(btnVoltar){
    btnVoltar.addEventListener('click', () => {
        window.history.back()
    })
}

if(btnCancelar){
    btnCancelar.addEventListener('click', () => {
        window.history.back()
    })
}

if(btnSalvar){
    btnSalvar.addEventListener('click', () => {
        window.location.href = ''
    })
}