const blocos = document.querySelectorAll('.bloco');
const voltar = document.querySelector('.seta_voltar')
const perfil = document.querySelector('.perfil')
const logout = document.querySelector('.logout')


voltar.addEventListener('click', () => {
    window.location.href = 'pagina_principal_do_tecnico.php'
})

perfil.addEventListener('click', () => {
    window.location.href = 'perfil_do_tecnico.php'
})

logout.addEventListener('click', () => {
    window.location.href = '../index.php'
})

blocos.forEach(bloco => {
    bloco.addEventListener('click', () => {

        const id = bloco.id;

        const form = document.createElement('form');
        form.method = 'POST';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_chamado';
        input.value = id;

        form.appendChild(input);

        document.body.appendChild(form);

        form.submit();
    });
});