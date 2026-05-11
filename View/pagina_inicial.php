<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sigem/templates/assets/css/pagina_inicial.css">
    <title>Página Inicial</title>
</head>

<body>
    <div class="imagem_de_fundo"></div>
    
    <main>
        <div class="container">
            <div class="container_bloque_imagem">
                <figure class="image1">
                    <img src="/sigem/templates/assets/img/image1.png" alt="Imagem de fundo 2">
                </figure>
                <div class="conjunto">
                    <div class="barra_seta_decorativa">
                        <h2 class="titulo">Gerencie a manutenção da sua empresa!</h2>
                        <figure class="seta_decorativa">
                            <img src="/sigem/templates/assets/img/seta_decorativa.png" alt="seta decorativa">
                        </figure>
                    </div>

                    <div class="caixas_bloqueadas">
                        <div class="caixa_bloqueada1">
                            <h3>Histórico de manutenções</h3>
                            <figure class="cadeado1">
                                <img src="/sigem/templates/assets/img/cadeado1.png" alt="cadeado">
                            </figure>
                        </div>

                        <div class="caixa_bloqueada2">
                            <h3>Registrar nova manutenção</h3>
                            <figure class="cadeado2">
                                <img src="/sigem/templates/assets/img/cadeado2.png" alt="cadeado">
                            </figure>
                            <figure class="chave">
                                <img src="/sigem/templates/assets/img/chave_de_fenda.png" alt="chave de fenda">
                            </figure>
                        </div>
                    </div>
                </div>
                
                <div class="maquina_encontrada" style="display: none;">
                    <h2>Máquina encontrada!</h2>
                    <h3 class="subtitulo_maquina">Essas são as informações da última manutenção realizada</h3>
                    <div class="maquina-info">
                        <p><strong>Máquina 001</strong></p>
                        <p><strong>Tipo de serviço:</strong> Manutenção corretiva</p>
                        <p><strong>Nome do técnico:</strong> José Silva de Jesus</p>
                        <p><strong>Data:</strong> 30/04/2026</p>
                    </div>
                    <button class="btn_abrir_chamado" id="btnabrirchamado">Abrir novo chamado</button>
                    <figure class="logo2">
                        <img src="/sigem/templates/assets/img/logo2.png" alt="Logo">
                    </figure>
                </div>
            </div>

            <div class="Cform">
                <h1>Bem-vindo!</h1>
                <h2 class="subtitulo">Identifique a máquina que deseja consultar</h2>
                <figure class="linha_azul">
                    <img src="/sigem/templates/assets/img/linha_azul.png" alt="linha azul no form">
                </figure>

                <form class="form">
                    <div class="input_codigo">
                        <label for="Codigo">Código de Identificação</label>
                        <input type="text" id="Codigo" name="Codigo"
                            placeholder="Insira o número de identificação da máquina" required>
                    </div>
                    <div class="btn_envio">
                        <button type="submit">Enviar!</button>
                    </div>
                </form>

                <p class="texto1">A máquina ainda não foi cadastrada?</p>
                <p class="texto2">Realize o cadastro!</p>

                <figure class="logo">
                    <img src="/sigem/templates/assets/img/logo.png" alt="Logo">
                </figure>

                <div class="btn_login">
                    <button type="button" onclick="window.location.href='login.html'">
                        Login
                        <img src="/sigem/templates/assets/img/seta_login.png" alt="seta" class="seta_login">
                    </button>
                </div>
            </div>
        </div>
        
        <div class="botoes">
            <div class="btn_nova_manutencao">
                <button type="button" class="btnNovaManutencao">
                    Registrar nova manutenção
                    <img src="/sigem/templates/assets/img/cadeadoone.png" alt="botao" class="cadeado_nova_manutencao">
                </button>
            </div>
            <div class="btn_historico">
                <button type="button" class="btnHistorico">
                    Histórico de Manutenções
                    <img src="/sigem/templates/assets/img/cadeadotwo.png" alt="botao" class="cadeado_historico">
                </button>
            </div>
        </div>
    </main>
    
    <script src="/sigem/templates/assets/js/pagina_inicial.js"></script>
</body>

</html>