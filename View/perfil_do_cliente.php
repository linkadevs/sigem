<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Perfil</title>
    <link rel="stylesheet" href="/templates/assets/css/perfil_do_cliente.css">
</head>
<body>

    <header class="cabecalho_perfil">
        <button class="btn_voltar">
            <figure><img src="/templates/assets/img/seta_voltar.png" alt="Seta Voltar"></figure>
            <span>Voltar</span>
        </button>
        <h1 class="titulo_cabecalho">Seu perfil</h1>
        <div class="espacamento_fantasma"></div>
    </header>

    <main class="container_fundo">
        <section class="card_perfil">
            <h2 class="titulo_card">Informações pessoais</h2>

            <div class="grade_informacoes">
                <div class="linha_info">
                    <p class="rotulo">Nome</p>
                    <p class="valor">UNEB</p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">CNPJ</p>
                    <p class="valor">AB.123.CDE/0001-XY</p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">Acompanhante</p>
                    <p class="valor">Miguel Cruz Carvalho</p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">CPF</p>
                    <p class="valor">ABC.DEF.GHI-JK</p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">UF</p>
                    <p class="valor">Bahia</p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">Cidade</p>
                    <p class="valor">Salvador</p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">Número de contato</p>
                    <p class="valor">(71) 9 ABCD-EFGH</p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">E-mail</p>
                    <p class="valor">abcdef.ghi@gmail.com</p>
                </div>
            </div>

            <div class="secao_senha">
                <p class="rotulo_senha">Alterar senha</p>
                <div class="inputs_senha">
                    <input type="password" placeholder="Digite a nova senha">
                    <input type="password" placeholder="Repita a nova senha">
                </div>
            </div>

            <div class="botoes_acao">
                <button class="btn_cancelar">Cancelar</button>
                <button class="btn_salvar">Salvar</button>
            </div>
        </section>
    </main>

    <script src="/templates/assets/js/perfil_do_cliente.js"></script>
</body>
</html>