const perfil = document.querySelector('.perfil')
const logout = document.querySelector('.logout')


if (perfil) {
    perfil.addEventListener('click', () => {
        window.location.href = '';
    });
}

if (logout) {
    perfil.addEventListener('click', () => {
        window.location.href = '';
    });
}

// FUNÇÃO PARA AMPLIAR FOTOS
document.addEventListener('DOMContentLoaded', function() {
    const imagens = document.querySelectorAll('.fotos img');
    
    const modal = document.createElement('div');
    modal.className = 'modal';
    
    const modalImg = document.createElement('img');
    modalImg.className = 'modal-img';
    
    const closeBtn = document.createElement('button');
    closeBtn.className = 'modal-close';
    closeBtn.innerHTML = '&times;';
    closeBtn.setAttribute('aria-label', 'Fechar');
    
    modal.appendChild(modalImg);
    modal.appendChild(closeBtn);
    document.body.appendChild(modal);
    
    function abrirModal(imagem) {
        modal.style.display = 'flex';
        modalImg.src = imagem.src;
        modalImg.alt = imagem.alt;
        document.body.style.overflow = 'hidden';
    }
    
    function fecharModal() {
        modal.style.display = 'none';
        modalImg.src = '';
        document.body.style.overflow = '';
    }
    
    imagens.forEach(imagem => {
        imagem.addEventListener('click', function() {
            abrirModal(this);
        });
    });
    
    closeBtn.addEventListener('click', fecharModal);
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            fecharModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            fecharModal();
        }
    });
});