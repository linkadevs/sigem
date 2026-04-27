<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/assets/css/Visualização-do-código.css">
    <title>Cadastro de Máquina</title>
</head>
<body>
    <div class="background">
        <figure>
            <img src="../templates/assets/img/fundo-desktop-cadastro.png" alt="">
        </figure>
    </div>

    <header>
        <div class="voltar_header">
            <figure>
                <img src="../templates/assets/img/seta_voltar.png" alt="Voltar">
            </figure>
            
            <h1>Voltar</h1>
        </div>
    </header>
        
    <main>
        <div class="card_main">
            <div class="titulo_card">
                <h1>Código da máquina</h1>
                <p>Copie e salve o QR code abaixo da sua nova máquina (Você poderá acessar o código da máquina posteriormente na página de gerenciamento de máquinas)</p>
            </div>
            
            <figure class="qrcode">
                <img src="../templates/assets/img/qr-code.png" alt="QR Code" id="qrCodeImage">
            </figure>
            <div class="codigo_maquina">
                <h1 id="textoParaCopiar">001</h1>

                <figure>
                    <img src="../templates/assets/img/copiar.png" alt="Copie Aqui!" id="feedbackIcone" onclick="copiar()">
                    <img src="../templates/assets/img/icone-check.png" alt="Texto copiado!" id="iconeCheck" style="display: none;">
                </figure>
            </div>

            <p class="textoCopiado" style="display: none;  width: 100% ;margin: 0; text-align: center;">Texto Copiado!</p>
            
            <div class="botoes_card">
                <button class="sair">Sair</button>
                <button type="submit" class="salvar" onclick="baixarQR()">Salvar QR Code</button>
            </div>
            
        </div>
        </main>
        
        <footer>
            
        </footer>
        <script src="../templates/assets/js/Visualização-do-código.js"></script>
    </body>
</html>