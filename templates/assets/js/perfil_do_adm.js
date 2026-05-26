const btnVoltar = document.querySelector('.btn_voltar')
const btnCancelar = document.querySelector('.btn_cancelar')

if(btnVoltar){
    btnVoltar.addEventListener('click', () => {
        window.location.href = 'pagina_principal_adm.php';
    })
}

if(btnCancelar){
    btnCancelar.addEventListener('click', () => {
        window.location.href = 'pagina_principal_adm.php';
    })
}

