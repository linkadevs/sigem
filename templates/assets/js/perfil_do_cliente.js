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

const olhoAberto = document.getElementById('olhoaberto')
const olhoFechado = document.getElementById('olhofechado')
const senhaAberta = document.getElementById('senha_desbloqueada')
const senhaFechada = document.getElementById('senha_bloqueada')

function alternarVisualizacao() {
    if (senhaAberta.style.display === 'none') {

        senhaAberta.style.display = 'block';
        senhaFechada.style.display = 'none';
        olhoAberto.style.display = 'none';
        olhoFechado.style.display = 'block';
    } else {

        senhaAberta.style.display = 'none';
        senhaFechada.style.display = 'block';
        olhoAberto.style.display = 'block';
        olhoFechado.style.display = 'none';
    }
}


olhoAberto.addEventListener('click', () => {
    alternarVisualizacao();
});

olhoFechado.addEventListener('click', () => {
    alternarVisualizacao();
});