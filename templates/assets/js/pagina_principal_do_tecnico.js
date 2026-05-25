
//redirecionamento do logout
//redirecionamnto para o perfil


document.querySelector('.logoutDiv').addEventListener('click', () => {
    window.location.href = '/sigem/index.php';
});

document.querySelector('.perfilBtn').addEventListener('click', () => {
    window.location.href = 'perfil_do_tecnico.php';
});