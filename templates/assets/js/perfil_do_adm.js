const btnVoltar = document.querySelector('.btn_voltar')
const btnCancelar = document.querySelector('.btn_cancelar')

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

