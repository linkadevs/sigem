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

function baixarQR() {
    const qrImage = document.getElementById('qrCodeImage').src;

    const link = document.createElement('a');
    link.href = qrImage;
    
    link.download = 'qrcode.png';
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}