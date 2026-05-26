
//redirecionamento do logout
//redirecionamnto para o perfil


document.querySelector('.logoutDiv').addEventListener('click', () => {
    window.location.href = '../index.php';
});

document.querySelector('.perfilBtn').addEventListener('click', () => {
    window.location.href = 'perfil_cliente.php';
});