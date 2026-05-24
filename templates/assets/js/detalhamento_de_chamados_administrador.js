const btnVoltar = document.querySelector('.voltar');
if (btnVoltar) {
    btnVoltar.addEventListener('click', () => {
        window.history.back();
    });
}

const galeriaImagens = document.querySelectorAll('.fotos img');
const modal = document.getElementById('imageModal');
const modalImg = document.getElementById('modalImg');
const closeModal = document.getElementById('closeModal');

if (galeriaImagens.length > 0 && modal) {
    galeriaImagens.forEach(img => {
        img.addEventListener('click', () => {
            modalImg.src = img.src;
            modal.style.display = 'flex';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
}