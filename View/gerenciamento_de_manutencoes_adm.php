<?php

require_once __DIR__ . "/../Controller/GerenciamentoManutencoesController.php";
use Controller\GerenciamentoManutencoesController;

// Capturar o termo de busca
$busca = isset($_GET['busca']) ? trim($_GET['busca']) : null;

$gerenciamento_Manutencoes = new GerenciamentoManutencoesController;
$manutencoes = $gerenciamento_Manutencoes->exibirmanutencoes($busca);

// Verificar se houve erro
$temErro = isset($manutencoes['erro']);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de manutenções</title>
    <link rel="stylesheet" href="../templates/assets/css/gerenciamento_de_manutencoes_adm.css">
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
                        <img src="../templates/assets/img/menu-manutencaoazul.png"
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
                        <img src="../templates/assets/img/menu-tecnico.png"
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
                <h1>Manutenções</h1>
                <form method="GET" action="">
                    <div class="input-container">
                        <figure>
                            <img src="../templates/assets/img/lupa_branca.png" alt="">
                        </figure>
                        <input type="text" name="busca" class="pesquisar" 
                            placeholder="Busque por máquina, código, técnico, serviço ou data..."
                            value="<?php echo htmlspecialchars($busca ?? ''); ?>" autocomplete="off">
                    </div>
                    <button type="submit" class="procurar">Procurar</button>
                    <?php if ($busca): ?>
                        <a href="?" class="limpar-busca">Limpar</a>
                    <?php endif; ?>
                </form>
            </div>

            <?php if ($temErro): ?>
                <!-- Mensagem de erro -->
                <div class="erro-mensagem">
                    <strong>⚠️ Erro ao carregar manutenções</strong><br>
                    <?php echo htmlspecialchars($manutencoes['erro']); ?>
                </div>
            <?php elseif ($busca && !empty($busca)): ?>
                <!-- Resultado da busca -->
                <div class="resultado-busca">
                    <span>🔍 Resultados da busca por: <strong>"<?php echo htmlspecialchars($busca); ?>"</strong> - <?php echo count($manutencoes); ?> manutenção(ões) encontrada(s)</span>
                </div>
            <?php endif; ?>

            <div class="grid_cards">

                <?php if ($temErro): ?>
                    <!-- Mensagem quando há erro -->
                    <div class="nenhuma-manutencao">
                        <div class="mensagem-vazia">
                            <h2>Erro no sistema</h2>
                            <p>Não foi possível carregar as manutenções.</p>
                            <p class="sugestao">Tente novamente mais tarde.</p>
                        </div>
                    </div>
                <?php elseif (empty($manutencoes)): ?>
                    <!-- Mensagem quando não há manutenções registradas -->
                    <div class="nenhuma-manutencao">
                        <div class="mensagem-vazia">
                            <?php if ($busca && !empty($busca)): ?>
                                <h2>Nenhuma manutenção encontrada</h2>
                                <p>Não encontramos resultados para "<?php echo htmlspecialchars($busca); ?>"</p>
                                <p class="sugestao">Tente buscar por outro termo ou <a href="?">limpar a busca</a></p>
                            <?php else: ?>
                                <h2>Sem manutenções registradas</h2>
                                <p>Nenhuma manutenção foi encontrada até o momento.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($manutencoes as $key => $manutencao): ?>

                        <div class="card">
                            <h2 class="maquina"><?php echo htmlspecialchars($manutencao['nome_maquina']) ?></h2>
                            <P class="codigo"><?php echo htmlspecialchars($manutencao['cod_maquina_fk']) ?></P>
                            <hr>
                            <h3 class="manutencao">Manutenção</h3>
                            <div class="dados">
                                <div class="informacaoazul">
                                    <p class="tecnico">Técnico:</p>
                                    <p class="nome"><?php echo htmlspecialchars($manutencao['nome_tecnico']) ?></p>
                                </div>

                                <div class="informacao">
                                    <p class="servico">Serviço:</p>
                                    <p class="tipo"><?php
                                    $tipo = $manutencao['tipo_de_servico'];
                                    if ($tipo === 'instalacao') {
                                        echo 'Instalação';
                                    } else if ($tipo === 'manutencao_preventiva') {
                                        echo 'Manutenção preventiva';
                                    } else if ($tipo === 'manutencao_corretiva') {
                                        echo 'Manutenção corretiva';
                                    } else if ($tipo === 'inspecao') {
                                        echo 'Inspeção';
                                    }
                                    ?></p>
                                </div>

                                <div class="informacaoazul">
                                    <p class="data">Data e hora:</p>
                                    <p class="dia"><?php
                                    $data = $manutencao['data_e_hora'] ?? '';
                                    if ($data != '0000-00-00 00:00:00') {
                                        echo date('d/m/Y H:i', strtotime($data));
                                    } else {
                                        echo 'Data e hora não disponíveis';
                                    }
                                    ?>
                                    </p>
                                </div>
                            </div>
                            <div class="botoes">
                                <button class="pmoc"
                                    onclick="window.location.href = 'pagina_visualizacao_pmoc.php?cod_maquina=<?php echo htmlspecialchars($manutencao['cod_maquina_fk']); ?>&id_manutencao=<?php echo htmlspecialchars($manutencao['id_manutencao']); ?>&id_tecnico=<?php echo htmlspecialchars($manutencao['id_tecnico_fk']); ?>'">Ver
                                    PMOC</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <script src="../templates/assets/js/gerenciamento_de_manutencoes.js"></script>
    </main>
</body>

</html>