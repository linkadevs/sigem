const voltar = document.querySelector('.voltar');
const historicos = document.querySelectorAll('.historico');
const chamados = document.querySelectorAll('.chamado');

if (voltar) {
    voltar.addEventListener('click', () => {
        window.location.href = 'pagina_principal_cliente.php';
    });
}

historicos.forEach(historico => {
    if (historico) {
        historico.addEventListener('click', () => { 
            window.location.href = '';
        });
    }
});

chamados.forEach(chamado => {
    if (chamado) {
        chamado.addEventListener('click', () => {  
            window.location.href = '';
        });
    }
});