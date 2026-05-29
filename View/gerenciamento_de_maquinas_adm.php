<?php

session_start();
use Controller\MaquinaController;
require_once __DIR__ . '/../Controller/MaquinaController.php';
$maquinaController = new MaquinaController();

$busca = isset($_GET['search']) ? trim($_GET['search']) : null;

if ($busca && !empty($busca)) {
    $array = $maquinaController->pesquisarMaquina($busca);
    $maquinas = $array['dados'];
} else {
    $maquinas = $maquinaController->verMaquinas();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['criar'])) {
        $_SESSION['cod_maquina'] = null;
        header('Location: pagina_cadastro_nova_maquina.php');
        exit();
    }
    if (isset($_POST['editar'])) {
        $_SESSION['cod_maquina'] = $_POST['editar'];
        header('Location: pagina_cadastro_nova_maquina.php');
        exit();
    }
    if (isset($_POST['historico'])) {
        $_SESSION['cod_maquina'] = $_POST['historico'];
        header('Location: historico_adm_manutencoes.php');
        exit();
    }
    if (isset($_POST['apagar'])) {
        $cod_maquina = $_POST['apagar'];
        $maquinaController->deletarMaquina($cod_maquina);
        header('Location: gerenciamento_de_maquinas_adm.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de máquinas</title>
    <link rel="stylesheet" href="/sigem/templates/assets/css/gerenciamento_de_maquinas_adm.css">
</head>
<body>
    <aside class="menu_lateral">
        <nav>
            <div class="menu_perfil">
                <button class="btn_perfil">
                    <div class="circuloperfil">
                        <figure>
                            <img src="/sigem/templates/assets/img/menu-perfil.png" alt="Imagem circular de um usuário genérico">
                        </figure>
                    </div>
                    <p>Administrador</p>
                </button>
            </div>
            <div class="menu_home">
                <button class="btn_home">
                    <figure><img src="/sigem/templates/assets/img/menu-home.png" alt="casa azul claro"></figure>
                    <p>Home</p>
                </button>
            </div>
            <div class="menu_maquinas">
                <button class="btn_maquinas ativo">
                    <figure><img src="/sigem/templates/assets/img/menu-maquinas.png" alt="Máquina azul ilustrativa"></figure>
                    <p>Máquinas</p>
                </button>
            </div>
            <div class="menu_clientes">
                <button class="btn_clientes">
                    <figure><img src="/sigem/templates/assets/img/menu-clientes.png" alt="Medalha em torno do ícone de um cliente"></figure>
                    <p>Clientes</p>
                </button>
            </div>
            <div class="menu_chamados">
                <button class="btn_chamados">
                    <figure><img src="/sigem/templates/assets/img/menu-chamados.png" alt="Telefone"></figure>
                    <p>Chamados</p>
                </button>
            </div>
            <div class="menu_manutencoes">
                <button class="btn_manutencoes">
                    <figure><img src="/sigem/templates/assets/img/menu-manutencao.png" alt="Engrenagem"></figure>
                    <p>Manutenções</p>
                </button>
            </div>
            <div class="menu_pecas">
                <button class="btn_pecas">
                    <figure><img src="/sigem/templates/assets/img/menu-pecas.png" alt="Caixa de ferramenta"></figure>
                    <p>Solicitações de peças</p>
                </button>
            </div>
            <div class="menu_tecnicos">
                <button class="btn_tecnicos">
                    <figure><img src="/sigem/templates/assets/img/menu-tecnico.png" alt="Homem com EPI"></figure>
                    <p>Técnicos</p>
                </button>
            </div>
            <div class="menu_logout">
                <button class="btn_logout">
                    <figure><img src="/sigem/templates/assets/img/menu-logout.png" alt="Seta indicando saída"></figure>
                    <p>Logout</p>
                </button>
            </div>
        </nav>
    </aside>

    <main>
        <div class="container">
            <div class="conteudo_superior">
                <h1>Máquinas</h1>
                <form class="pesquisa" method="GET">
                    <div class="input-container">
                        <figure><img src="/sigem/templates/assets/img/lupa_branca.png" alt="Ícone de lupa"></figure>
                        <input name="search" id="search" type="text" class="pesquisar" 
                               placeholder="Busque por um nome da máquina, um código ou cliente específico!"
                               value="<?php echo htmlspecialchars($busca ?? ''); ?>" autocomplete="off">
                    </div>
                    <button class="procurar" type="submit">Procurar</button>
                    <?php if ($busca): ?>
                        <a href="?" class="limpar-busca">Limpar</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="container_nova_maquina">
                <form method="POST">
                    <button class="btn_nova_maquina" name="criar" value="1">
                        <span class="icone_mais">+</span>
                        <span class="texto_nova_maquina">Nova máquina</span>
                    </button>
                </form>
            </div>

            <?php if ($busca && !empty($busca)): ?>
                <div class="resultado-busca">
                    <span>🔍 Resultados da busca por: <strong>"<?php echo htmlspecialchars($busca); ?>"</strong> - <?php echo count($maquinas); ?> máquina(s) encontrada(s)</span>
                </div>
            <?php endif; ?>

            <?php if (empty($maquinas)): ?>
                <div class="nenhuma-manutencao">
                    <div class="mensagem-vazia">
                        <?php if ($busca): ?>
                            <h2>Nenhuma máquina encontrada</h2>
                            <p>Não encontramos resultados para "<?php echo htmlspecialchars($busca); ?>"</p>
                            <p class="sugestao">Tente buscar por outro termo ou <a href="?">limpar a busca</a></p>
                        <?php else: ?>
                            <h2>Nenhuma máquina cadastrada</h2>
                            <p>Clique em "Nova máquina" para adicionar.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="lista_maquinas">
                    <?php foreach ($maquinas as $maquina): ?>
                        <div class="card_maquina" id="<?php echo htmlspecialchars($maquina['cod_maquina']); ?>">
                            <p class="badge_maquina">Máquina <?php echo htmlspecialchars($maquina['cod_maquina']); ?></p>
                            <p class="descricao_maquina"><?php echo htmlspecialchars($maquina['nome_maquina']); ?></p>
                        </div>

                        <div class="card_informacao" id="info-<?php echo htmlspecialchars($maquina['cod_maquina']); ?>" style="display: none;">
                            <div class="titulo">
                                <p class="codigo"><?php echo htmlspecialchars($maquina['cod_maquina']); ?></p>
                                <p class="nomeP"><?php echo htmlspecialchars($maquina['nome_maquina']); ?></p>
                                <form method="POST">
                                    <button class="lixeiraBotao" name="apagar" value="<?php echo htmlspecialchars($maquina['cod_maquina']); ?>">
                                        <figure class="lixeira"><img src="/sigem/templates/assets/img/lixeira.png" alt="Excluir máquina"></figure>
                                    </button>
                                </form>
                            </div>
                            <div class="informacoes">
                                <div class="linha">
                                    <p class="cliente">Cliente</p>
                                    <p class="clienteNome">UNEB</p>
                                </div>
                                <div class="linha">
                                    <p class="localizacao">Localização</p>
                                    <p class="localizacaoNome"><?php echo htmlspecialchars($maquina['localizacao']); ?></p>
                                </div>
                                <div class="linha2">
                                    <div class="linha">
                                        <p class="modelo">Modelo</p>
                                        <p class="modeloNome"><?php echo htmlspecialchars($maquina['modelo']); ?></p>
                                    </div>
                                    <div class="linha">
                                        <p class="marca">Marca</p>
                                        <p class="marcaNome"><?php echo htmlspecialchars($maquina['marca']); ?></p>
                                    </div>
                                </div>
                                <div class="linha2 linha3">
                                    <div class="linha">
                                        <p class="fluidoRefrigerante">Fluido refrigerante</p>
                                        <p class="fluidoRefrigeranteNome"><?php echo htmlspecialchars($maquina['fluido_refrigerante']); ?></p>
                                    </div>
                                    <div class="linha">
                                        <p class="capacidadeTermica">Capacidade térmica</p>
                                        <p class="capacidadeTermicaNome"><?php echo htmlspecialchars($maquina['capacidade_termica_de_refrigeracao']); ?> BTUs</p>
                                    </div>
                                </div>
                            </div>
                            <div class="botoes">
                                <form method="POST" style="display: flex; gap: 1rem;">
                                    <button name="editar" value="<?php echo htmlspecialchars($maquina['cod_maquina']); ?>" class="editarButton"><strong>Editar informações</strong></button>
                                    <button name="historico" value="<?php echo htmlspecialchars($maquina['cod_maquina']); ?>" class="historicoButton"><strong>Ver histórico de manutenções</strong></button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <script src="/sigem/templates/assets/js/gerenciamento_de_maquinas_adm.js"></script>
</body>
</html>