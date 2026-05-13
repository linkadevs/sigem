<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Manutenções</title>
    <link rel="stylesheet" href="../templates/assets/css/historico_cet_manutencoes.css">
</head>

<body>
    <div class="imagem_de_fundo">
        <figure>
            <img src="../templates/assets/img/fundo-desktop-cadastro.png" alt="">
        </figure>
    </div>

    <main class="container_fundo">
        <section class="card_principal">

            <header class="cabecalho_historico">
                <button class="btn_voltar">
                    <figure><img src="../templates/assets/img/seta_voltar.png" alt="Seta Voltar"></figure>
                </button>
                <div class="textos_cabecalho">
                    <h1 class="titulo_card">Histórico de manutenções</h1>
                    <p class="subtitulo_card">Esse é o histórico de manutenções realizadas na máquina 001</p>
                </div>
            </header>

            <hr class="linha_divisoria">

            <form class="container_pesquisa">
                <div class="input_wrapper">
                    <figure class="icone_lupa"><img src="../templates/assets/img/lupa_branca.png" alt="Lupa"></figure>
                    <input type="text" class="input_pesquisa"
                        placeholder="Busque por uma data, nome ou serviço específico!">
                </div>
                <button type="button" class="btn_pesquisar">Pesquisar</button>
            </form>

            <div class="lista_manutencoes">

                <!-- CARD 1 -->
                <article class="card_manutencao">
                    <div class="coluna_icone">
                        <figure><img src="../templates/assets/img/engrenagens.png" alt="Engrenagens"></figure>
                    </div>
                    <div class="coluna_dados">
                        <div class="linha_dado">
                            <span class="rotulo_dado">Nome do técnico:</span>
                            <span class="tag_dado">José Silva de Jesus</span>
                        </div>
                        <div class="linha_dado">
                            <span class="rotulo_dado">Tipo de serviço:</span>
                            <span class="tag_dado">Manutenção corretiva</span>
                        </div>
                    </div>
                    <div class="coluna_data">
                        <span class="data_manutencao">30/04/2026</span>
                    </div>
                </article>

                <!-- CARD 2 -->
                <article class="card_manutencao">
                    <div class="coluna_icone">
                        <figure><img src="../templates/assets/img/engrenagens.png" alt="Engrenagens"></figure>
                    </div>
                    <div class="coluna_dados">
                        <div class="linha_dado">
                            <span class="rotulo_dado">Nome do técnico:</span>
                            <span class="tag_dado">José Silva de Jesus</span>
                        </div>
                        <div class="linha_dado">
                            <span class="rotulo_dado">Tipo de serviço:</span>
                            <span class="tag_dado">Manutenção corretiva</span>
                        </div>
                    </div>
                    <div class="coluna_data">
                        <span class="data_manutencao">30/04/2026</span>
                    </div>
                </article>

                <!-- CARD 3 -->
                <article class="card_manutencao">
                    <div class="coluna_icone">
                        <figure><img src="../templates/assets/img/engrenagens.png" alt="Engrenagens"></figure>
                    </div>
                    <div class="coluna_dados">
                        <div class="linha_dado">
                            <span class="rotulo_dado">Nome do técnico:</span>
                            <span class="tag_dado">José Silva de Jesus</span>
                        </div>
                        <div class="linha_dado">
                            <span class="rotulo_dado">Tipo de serviço:</span>
                            <span class="tag_dado">Manutenção corretiva</span>
                        </div>
                    </div>
                    <div class="coluna_data">
                        <span class="data_manutencao">30/04/2026</span>
                    </div>
                </article>

            </div>

        </section>
    </main>

    <script src="../templates/assets/js/historico_manutencoes.js"></script>
</body>

</html>