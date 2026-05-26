const voltar = document.querySelector('.voltar');
if (voltar) {
    voltar.addEventListener('click', () => {
        window.location.href = 'pagina_principal_cliente.php';
    });
}