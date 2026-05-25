const blocos = document.querySelectorAll('.bloco');

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