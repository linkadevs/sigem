<?php
// 1. IMPORTAÇÃO DO CONTROLLER
require_once __DIR__ . '/../Controller/GerenciamentoTecController.php';
use Controller\GerenciamentoTecController;

$controller = new GerenciamentoTecController();

// 2. LÓGICA DE BUSCA
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

$tecnicos = $controller->pesquisarTecnicos($busca);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Técnicos</title>
    <link rel="stylesheet" href="../templates/assets/css/pagina_gerenciamento_de_tecnicos_adm.css">
</head>

<body>
    <aside class="menu_lateral">

        <nav>
            <div class="menu_perfil">
                <button class="btn_perfil">
                    <div class="circuloperfil">
                        <figure>
                            <img src="../templates/assets/img/menu-perfil.png" alt="Imagem circular de um usuário
                     genérico para simbolizar o perfil">
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
                        <img src="../templates/assets/img/menu-clientes.png" alt="Imagem ilustrativa de uma medalha
                         em torno do ícone de um cliente">
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
                        <img src="../templates/assets/img/menu-manuntencao.png"
                            alt="Imagem ilustrativa de uma engrenagem ao lado de uma ferramenta">
                    </figure>

                    <p>Manutenções</p>
                </button>
            </div>

            <div class="menu_pecas">
                <button class="btn_pecas">
                    <figure>
                        <img src="../templates/assets/img/menu-pecas.png"
                            alt="Imagem ilustrativa de uma ciaxa de ferramenta">
                    </figure>

                    <p>Solicitações de peças</p>
                </button>
            </div>

            <div class="menu_tecnicos">
                <button class="btn_tecnicos">

                    <figure>
                        <img src="../templates/assets/img/menu-tecnicoazul.png"
                            alt="Imagem ilustrativa de um homem com um capacete de EPI">
                    </figure>

                    <p>Técnicos</p>
                </button>
            </div>

            <div class="menu_logout">
                <button class="btn_logout">

                    <figure>
                        <img src="../templates/assets/img/menu-logout.png" alt="Imagem ilustrativade uma porta aberta 
                        com uma seta indicando a saída">
                    </figure>

                    <p>Logout</p>
                </button>
            </div>
        </nav>
    </aside>

    <main>
        <div class="container">

            <div class="conteudo_superior">
                <h1>Técnicos</h1>
                <form method="GET" action="pagina_gerenciamento_de_tecnicos_adm.php">
                    <div class="input-container">
                        <figure>
                            <img src="../templates/assets/img/lupa_branca.png" alt="">
                        </figure>
                        <input type="text" class="pesquisar" name="busca" id="busca"
                            placeholder="Busque por uma data, um nome ou função específica!">
                    </div>
                    <button class="procurar">Procurar</button>
                    <?php if ($busca): ?>
                        <a href="?" class="limpar-busca">Limpar</a>
                    <?php endif; ?>
                </form>
            </div>

            <a href="pagina_cadastro_tecnicos_administrador.php">
                <button class="btn_colaborador" type="button">
                    <figure>
                        <img src="../templates/assets/img/sinal-de-adicao.png" alt="">
                    </figure>
                    Novo colaborador
                </button>
            </a>

            <div class="grid_cards">

                <?php if (isset($tecnicos) && !empty($tecnicos)): ?>
                    <?php foreach ($tecnicos as $tecnico): ?>
                        <div class="card">
                            <h2 class="nome"><?php echo htmlspecialchars($tecnico['nome']); ?></h2>

                            <div class="container_informacoes">
                                <div class="informacoes">
                                    <div class="container_cpf">
                                        <div class="cpf">
                                            <h1>CPF:</h1>
                                        </div>

                                        <div class="dados_cpf">
                                            <h1><?php echo htmlspecialchars($tecnico['cpf']); ?></h1>
                                        </div>
                                    </div>

                                    <div class="container_funcao">
                                        <div class="funcao">
                                            <h1>Função:</h1>
                                        </div>
                                        <div class="dados_funcao">
                                            <h1><?php echo htmlspecialchars($tecnico['funcao']); ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="btn_card">
                                <a href="pagina_cadastro_tecnicos_administrador.php?id=<?= $tecnico['id_tecnico'] ?>">
                                    <button class="editar">Editar</button>
                                </a>

                                <a href="../Controller/GerenciamentoTecController.php?acao=excluir&id_tecnico=<?= $tecnico['id_tecnico'] ?>">
                                    <button class="excluir">Excluir</button>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p><strong>Nenhum técnico encontrado.</strong></p>
                <?php endif; ?>

            </div>
        </div>
    </main>
    <script src="../templates/assets/js/pagina_gerenciamento_de_tecnicos_adm.js"></script>
</body>

</html>