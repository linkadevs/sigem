<?php


require_once __DIR__ . '/../Controller/PecasController.php';

use Controller\PecasController;

$controller = new PecasController();

$busca = trim($_GET['busca'] ?? '');

if ($busca !== '') {

    $solicitacoes =
        $controller->pesquisarSolicitacoes($busca);

} else {

    $solicitacoes =
        $controller->listarSolicitacoes();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitações de peças</title>

    <link rel="stylesheet" href="../templates/assets/css/pagina_gerenciamento_de_pecas_administrador.css">
</head>

<body>

    <aside class="menu_lateral">

        <nav>

            <div class="menu_perfil">

                <button class="btn_perfil">

                    <div class="circuloperfil">

                        <figure>

                            <img src="../templates/assets/img/menu-perfil.png"
                                alt="Imagem circular de um usuário genérico para simbolizar o perfil">

                        </figure>

                    </div>

                    <p>Administrador</p>

                </button>

            </div>

            <div class="menu_home">

                <button class="btn_home">

                    <figure>

                        <img src="../templates/assets/img/menu-home.png" alt="casa azul claro">

                    </figure>

                    <p>Home</p>

                </button>

            </div>

            <div class="menu_maquinas">

                <button class="btn_maquinas">

                    <figure>

                        <img src="../templates/assets/img/menu-maquinas.png" alt="Máquina cinza ilustrativa">

                    </figure>

                    <p>Máquinas</p>

                </button>

            </div>

            <div class="menu_clientes">

                <button class="btn_clientes">

                    <figure>

                        <img src="../templates/assets/img/menu-clientes.png"
                            alt="Imagem ilustrativa de uma medalha em torno do ícone de um cliente">

                    </figure>

                    <p>Clientes</p>

                </button>

            </div>

            <div class="menu_chamados">

                <button class="btn_chamados">

                    <figure>

                        <img src="../templates/assets/img/menu-chamados.png" alt="Imagem ilustrativa de um telefone">

                    </figure>

                    <p>Chamados</p>

                </button>

            </div>

            <div class="menu_manutencoes">

                <button class="btn_manutencoes">

                    <figure>

                        <img src="../templates/assets/img/menu-manutencao.png"
                            alt="Imagem ilustrativa de uma engrenagem ao lado de uma ferramenta">

                    </figure>

                    <p>Manutenções</p>

                </button>

            </div>

            <div class="menu_pecas">

                <button class="btn_pecas">

                    <figure>

                        <img src="../templates/assets/img/menu-pecasazul.png"
                            alt="Imagem ilustrativa de uma caixa de ferramenta">

                    </figure>

                    <p>Solicitações de peças</p>

                </button>

            </div>

            <div class="menu_tecnicos">

                <button class="btn_tecnicos">

                    <figure>

                        <img src="../templates/assets/img/menu-tecnico.png"
                            alt="Imagem ilustrativa de um homem com um capacete de EPI">

                    </figure>

                    <p>Técnicos</p>

                </button>

            </div>

            <div class="menu_logout">

                <button class="btn_logout">

                    <figure>

                        <img src="../templates/assets/img/menu-logout.png" alt="Imagem ilustrativa de logout">

                    </figure>

                    <p>Logout</p>

                </button>

            </div>

        </nav>

    </aside>

    <main>

        <div class="container">

            <div class="conteudo_superior">

                <h1>Solicitações de peças</h1>

                <!-- BARRA DE PESQUISA -->
                <form method="GET" class="formulario-pesquisa">
                    <div class="input-container">

                        <figure>

                            <img src="../templates/assets/img/lupa_branca.png" alt="Lupa">

                        </figure>

                        <input type="text" name="busca" class="pesquisar"
                            placeholder="Busque por uma data ou nome específico!"
                            value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">

                    </div>

                    <button type="submit" class="procurar">

                        Procurar

                    </button>

                </form>

            </div>

            <div class="conteudo_principal">

                <?php if (!empty($solicitacoes)): ?>

                    <?php foreach ($solicitacoes as $solicitacao_pecas): ?>

                        <div class="bloco">

                            <div class="inforcentro">

                                <div class="topo">

                                    <!-- PEÇA -->
                                    <div class="topico">

                                        <p class="titulo">
                                            Peça
                                        </p>

                                        <p class="infor">

                                            <?= htmlspecialchars($solicitacao_pecas['nome_peca']) ?>

                                        </p>

                                    </div>

                                     <div class="topico">

                                        <p class="titulo">
                                            Quantidade de Peças
                                        </p>

                                        <p class="infor">

                                            <?= htmlspecialchars($solicitacao_pecas['quantidade_pecas']) ?>

                                        </p>

                                    </div>

                                    <!-- STATUS -->
                                    <div class="topico">

                                        <p class="titulo">
                                            Status
                                        </p>

                                        <p class="infor status-texto">

                                            <?= $solicitacao_pecas['status'] === 'em_aberto'
                                                ? 'Em aberto'
                                                : 'Concluído'
                                                ?>

                                        </p>

                                    </div>

                                    <!-- TÉCNICO -->
                                    <div class="topico">

                                        <p class="titulo">
                                            Técnico solicitante
                                        </p>

                                        <p class="infor">

                                            <?= htmlspecialchars($solicitacao_pecas['nome_tecnico']) ?>

                                        </p>

                                    </div>

                                </div>

                                <!-- DESCRIÇÃO -->
                                <div class="descricao">

                                    <p>

                                        <?= htmlspecialchars($solicitacao_pecas['descricao']) ?>

                                    </p>

                                </div>

                            </div>

                            <div class="lado-direito">

                                <!-- DATA -->
                                <div class="data">

                                    <p>

                                        <?= date(
                                            'd/m/y',
                                            strtotime($solicitacao_pecas['data'])
                                        ) ?>

                                    </p>

                                </div>

                                <!-- BOTÕES -->
                                <?php if ($solicitacao_pecas['status'] === 'em_aberto'): ?>

                                    <div class="grupo-botoes">

                                        <button class="cancelar" data-id="<?= $solicitacao_pecas['id_solicitacao_pecas'] ?>">

                                            Cancelar

                                        </button>

                                        <button class="concluir" data-id="<?= $solicitacao_pecas['id_solicitacao_pecas'] ?>">

                                            Concluir

                                        </button>

                                    </div>

                                <?php else: ?>

                                    <div class="grupo-botoes">

                                        <button class="concluido">

                                            Concluído

                                        </button>

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <!-- MENSAGEM QUANDO NÃO EXISTIR SOLICITAÇÃO -->

                    <div class="sem-registro">

                        <p>

                            <strong>
                                Não há solicitações de peças.
                            </strong>

                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </main>

    <script src="../templates/assets/js/pagina_gerenciamento_de_pecas_administrador.js"></script>

</body>

</html>