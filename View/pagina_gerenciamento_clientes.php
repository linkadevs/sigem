<?php

require_once __DIR__ . '/../Controller/GerenciamentoClienteController.php';

use Controller\GerenciamentoClienteController;

// INSTANCIA O CONTROLLER
$controller = new GerenciamentoClienteController();

// VERIFICA SE EXISTE PESQUISA
$busca = trim($_GET['busca'] ?? '');
// SE TIVER PESQUISA
if (!empty($busca)) {

    $clientes = $controller->pesquisarClientes($busca);

} else {

    // LISTA TODOS OS CLIENTES
    $clientes = $controller->listarClientes();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de clientes</title>

    <link rel="stylesheet" href="../templates/assets/css/pagina_gerenciamento_clientes.css">
</head>

<body>

    <aside class="menu_lateral">

        <nav>

            <div class="menu_perfil">
                <button type="button" class="btn_perfil">

                    <div class="circuloperfil">
                        <figure>
                            <img src="../templates/assets/img/menu-perfil.png" alt="">
                        </figure>
                    </div>

                    <p>Administrador</p>

                </button>
            </div>

            <div class="menu_home">
                <button type="button" class="btn_home">

                    <figure>
                        <img src="../templates/assets/img/menu-home.png" alt="">
                    </figure>

                    <p>Home</p>

                </button>
            </div>

            <div class="menu_maquinas">
                <button type="button" class="btn_maquinas">

                    <figure>
                        <img src="../templates/assets/img/menu-maquinas.png" alt="">
                    </figure>

                    <p>Máquinas</p>

                </button>
            </div>

            <div class="menu_clientes">
                <button type="button" class="btn_clientes">

                    <figure>
                        <img src="../templates/assets/img/menu_clientes_azul.png" alt="">
                    </figure>

                    <p>Clientes</p>

                </button>
            </div>

            <div class="menu_chamados">
                <button type="button" class="btn_chamados">

                    <figure>
                        <img src="../templates/assets/img/menu-chamados.png" alt="">
                    </figure>

                    <p>Chamados</p>

                </button>
            </div>

            <div class="menu_manutencoes">
                <button type="button" class="btn_manutencoes">

                    <figure>
                        <img src="../templates/assets/img/menu-manutencao.png" alt="">
                    </figure>

                    <p>Manutenções</p>

                </button>
            </div>

            <div class="menu_pecas">
                <button type="button" class="btn_pecas">

                    <figure>
                        <img src="../templates/assets/img/menu-pecas.png" alt="">
                    </figure>

                    <p>Solicitações de peças</p>

                </button>
            </div>

            <div class="menu_tecnicos">
                <button type="button" class="btn_tecnicos">

                    <figure>
                        <img src="../templates/assets/img/menu-tecnico.png" alt="">
                    </figure>

                    <p>Técnicos</p>

                </button>
            </div>

            <div class="menu_logout">
                <button type="button" class="btn_logout">

                    <figure>
                        <img src="../templates/assets/img/menu-logout.png" alt="">
                    </figure>

                    <p>Logout</p>

                </button>
            </div>

        </nav>

    </aside>

    <main>

        <div class="container">

            <div class="conteudo_superior">

                <h1>Clientes</h1>

                <form method="GET" action="pagina_gerenciamento_clientes.php">

                    <div class="input-container">

                        <figure>
                            <img src="../templates/assets/img/lupa_branca.png" alt="">
                        </figure>

                        <input
                            type="text"
                            class="pesquisar"
                            name="busca"
                            id="busca"
                            placeholder="Busque por um nome, CNPJ, UF, cidade, contato ou email específico!">

                    </div>

                    <button class="procurar" type="submit">
                        Procurar
                    </button>
                    <?php if ($busca): ?>
                        <a href="?" class="limpar-busca">Limpar</a>
                    <?php endif; ?>
                </form>

            </div>

            <button type="button" class="criarCliente">

                <figure>
                    <img src="../templates/assets/img/adicao.png" alt="">
                </figure>

                Novo cliente

            </button>

            <div class="cards">
                <?php if (isset($clientes) && !empty($clientes)): ?>
                    <?php foreach ($clientes as $cliente) : ?>

                        <div class="card">

                            <div class="informacao">

                                <p class="titulo">Nome</p>

                                <p class="dado">
                                    <?= htmlspecialchars($cliente['nome']) ?>
                                </p>

                                <p class="titulo">UF</p>

                                <p class="dadoCFundo">
                                    <?= htmlspecialchars($cliente['uf']) ?>
                                </p>

                            </div>

                            <div class="informacao">

                                <p class="titulo">CNPJ</p>

                                <p class="dado">
                                    <?= htmlspecialchars($cliente['cnpj']) ?>
                                </p>

                                <p class="titulo">Cidade</p>

                                <p class="dadoCFundo">
                                    <?= htmlspecialchars($cliente['cidade']) ?>
                                </p>

                            </div>

                            <div class="informacao">

                                <p class="titulo emailTitulo">E-mail</p>

                                <p class="dado">
                                    <?= htmlspecialchars($cliente['email']) ?>
                                </p>

                                <div class="botoes">

                                    <button
                                        type="button"
                                        class="editar"
                                        data-id="<?= htmlspecialchars($cliente['id_cliente']) ?>">

                                        Editar

                                    </button>

                                    <button
                                        type="button"
                                        class="excluir"
                                        data-id="<?= htmlspecialchars($cliente['id_cliente']) ?>">

                                        Excluir

                                    </button>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else : ?>

                    <p>
                        <strong>Nenhum cliente encontrado.</strong>
                    </p>

                <?php endif; ?>

            </div>

        </div>

    </main>

    <script src="../templates/assets/js/pagina_gerenciamento_de_clientes_adm.js"></script>

</body>

</html>