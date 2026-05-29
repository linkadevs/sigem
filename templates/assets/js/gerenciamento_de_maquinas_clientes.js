// Aguarda o DOM carregar completamente
document.addEventListener('DOMContentLoaded', function() {
    const limparBtn = document.getElementById('limparBtn');
    
    // Função para verificar se há termo de busca na URL
    function temBuscaAtiva() {
        const urlParams = new URLSearchParams(window.location.search);
        const searchTerm = urlParams.get('search');
        return searchTerm && searchTerm.trim() !== '';
    }
    
    // Exibir o botão "Limpar" apenas se houver busca ativa
    if (temBuscaAtiva() && limparBtn) {
        limparBtn.style.display = 'flex';
    } else if (limparBtn) {
        limparBtn.style.display = 'none';
    }
    
    // Botão voltar
    const voltar = document.querySelector('.voltar');
    if (voltar) {
        voltar.addEventListener('click', () => {
            window.location.href = 'pagina_principal_cliente.php';
        });
    }
});