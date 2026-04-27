const perfil = document.querySelector('.perfil')
const logout = document.querySelector('.logout')
const responsabilizarse = document.querySelector('.responsabilizarse')
const cancelar = document.querySelector('.cancelar')
const concluido = document.querySelector('.concluido')


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

if (responsabilizarse) {
    responsabilizarse.addEventListener('click', () => {
    responsabilizarse.style.display = 'none'
    cancelar.style.display = 'block'
    concluido.style.display = 'block'
    });
}

if (cancelar) {
    cancelar.addEventListener('click', () => {
    responsabilizarse.style.display = 'block'
    cancelar.style.display = 'none'
    concluido.style.display = 'none'
    });
    }
