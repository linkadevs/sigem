const voltar = document.querySelectorAll('.voltar_header h1, .voltar_header figure, .sair')

voltar.forEach(element => {
    element.addEventListener('click', () => {
        window.location.href = 'pagina_principal_adm.php'
    })
})

function copiar() {
    const elemento = document.getElementById("textoParaCopiar");
    const texto = elemento ? elemento.textContent.trim() : "";
    const icone = document.getElementById("feedbackIcone");
    const iconeCheck = document.getElementById("iconeCheck");
    const textoCopiado = document.querySelector('.textoCopiado');

    if (!texto) {
        console.log("Nenhum texto para copiar");
        return;
    }

    navigator.clipboard.writeText(texto).then(() => {
        const originalSrc = icone ? icone.src : null;
        if (icone) icone.src = iconeCheck.src
        if (textoCopiado) textoCopiado.style.display = 'block';
        
        setTimeout(() => {
            if (icone && originalSrc) icone.src = originalSrc; 
            if (textoCopiado) textoCopiado.style.display = 'none';
        }, 2000);
        
        console.log("Texto copiado!");
    }).catch(err => {
        console.error("Erro ao copiar:", err);
    });
}

function baixarComTexto() {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    const img = document.getElementById('qrCodeImage');
    const texto = document.getElementById('textoParaCopiar').innerText;

    canvas.width = 400; 
    canvas.height = 450; 

    ctx.fillStyle = "white";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.drawImage(img, 50, 20, 300, 300);

    ctx.fillStyle = "black";
    ctx.font = "bold 40px Arial";
    ctx.textAlign = "center";
    ctx.fillText(texto, canvas.width / 2, 380);
    
    const link = document.createElement('a');
    link.download = `qrcode-${texto}.png`;
    link.href = canvas.toDataURL('image/png');
    link.click();
}

