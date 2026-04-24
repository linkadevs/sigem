const voltar = document.querySelector('.voltar')
const historico = document.querySelector('.historico')
const  chamado = document.querySelector('.chamado')

if (voltar) {
    voltar.chamadoaddEventListener('click', () => {
        window.location.href = '';
    });
}

if (historico) {
    historico.addEventListener('click', () => {
        window.location.href = '';
    });
}

if (chamado) {
    chamado.addEventListener('click', () => {
        window.location.href = '';
    });
}