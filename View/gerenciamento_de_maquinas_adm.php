<?php


session_start();
use Controller\MaquinaController;
require_once __DIR__ . '/../Controller/MaquinaController.php';
$maquinaController = new MaquinaController();

if(isset($_GET['search']) && !empty($_GET['search']) && $_GET['search'] != ''){
    $pesquisa = trim($_GET['search']);
    $array = $maquinaController->pesquisarMaquina($pesquisa);
    $maquinas = $array['dados'];
} else {
    $maquinas = $maquinaController->verMaquinas();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['criar'])){
        $_SESSION['cod_maquina'] = null;
        header('Location: pagina_cadastro_nova_maquina.php');
        exit();
    }
    if(isset($_POST['editar'])){
        $_SESSION['cod_maquina'] = $_POST['editar'];
        header('Location: pagina_cadastro_nova_maquina.php');
        exit();
    }
    if(isset($_POST['historico'])){
        $_SESSION['cod_maquina'] = $_POST['historico'];
        header('Location: historico_adm_manutencoes.php');
        exit();
    }
    if(isset($_POST['apagar'])){
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
                    <figure>
                        <img src="/sigem/templates/assets/img/menu-home.png" alt="casa azul claro">
                    </figure>
                    <p>Home</p>
                </button>
            </div>

            <!-- ÍCONE ATUALIZADO PARA AZUL -->
            <div class="menu_maquinas">
                <button class="btn_maquinas ativo">
                    <figure>
                        <img src="/sigem/templates/assets/img/menu-maquinas.png" alt="Máquina azul ilustrativa">
                    </figure>
                    <p>Máquinas</p>
                </button>
            </div>

            <div class="menu_clientes">
                <button class="btn_clientes">
                    <figure>
                        <img src="/sigem/templates/assets/img/menu-clientes.png" alt="Imagem ilustrativa de uma medalha em torno do ícone de um cliente">
                    </figure>
                    <p>Clientes</p>
                </button>
            </div>

            <div class="menu_chamados">
                <button class="btn_chamados">
                    <figure>
                        <img src="/sigem/templates/assets/img/menu-chamados.png" alt="Imagem ilustrativa de um telefone">
                    </figure>
                    <p>Chamados</p>
                </button>
            </div>

            <div class="menu_manutencoes">
                <button class="btn_manutencoes">
                    <figure>
                        <img src="/sigem/templates/assets/img/menu-manutencao.png" alt="Imagem ilustrativa de uma engrenagem">
                    </figure>
                    <p>Manutenções</p>
                </button>
            </div>

            <div class="menu_pecas">
                <button class="btn_pecas">
                    <figure>
                        <img src="/sigem/templates/assets/img/menu-pecas.png" alt="Imagem ilustrativa de uma caixa de ferramenta">
                    </figure>
                    <p>Solicitações de peças</p>
                </button>
            </div>

            <div class="menu_tecnicos">
                <button class="btn_tecnicos">
                    <figure>
                        <img src="/sigem/templates/assets/img/menu-tecnico.png" alt="Imagem ilustrativa de um homem">
                    </figure>
                    <p>Técnicos</p>
                </button>
            </div>

            <div class="menu_logout">
                <button class="btn_logout">
                    <figure>
                        <img src="/sigem/templates/assets/img/menu-logout.png" alt="Seta indicando a saída">
                    </figure>
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
                        <figure>
                            <img src="/sigem/templates/assets/img/lupa_branca.png" alt="Ícone de lupa">
                        </figure>
                        <input name="search" id="search" type="text" class="pesquisar" placeholder="Busque por um nome da máquina, um código ou cliente específico!">
                    </div>
                    <button class="procurar">Procurar</button>
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

            <div class="lista_maquinas">
                <?php
                foreach ($maquinas as $maquina) {
                    echo '
                        <div class="card_maquina" id="'. htmlspecialchars($maquina['cod_maquina']) .'">
                            <p class="badge_maquina">Máquina '. htmlspecialchars($maquina['cod_maquina']) .'</p>
                            <p class="descricao_maquina">' . htmlspecialchars($maquina['nome_maquina']) . '</p>
                        </div>

                        <div class="card_informacao" id="info-'. htmlspecialchars($maquina['cod_maquina']) .'" style="display: none;">
                            <div class="titulo">
                                <strong><p class="codigo">'. htmlspecialchars($maquina['cod_maquina']) .'</p></strong>
                                <strong><p class="nomeP">'. htmlspecialchars($maquina['nome_maquina']) .'</p></strong>
                                <form method="POST"><button class="lixeiraBotao" name="apagar" value="'. htmlspecialchars($maquina['cod_maquina']) .'"><figure class="lixeira"><img src="/sigem/templates/assets/img/lixeira.png" alt="Trash bin icon for deleting machine records"></figure></button></form>
                            </div>
                            <div class="informacoes">
                                <div class="linha">
                                    <p class="cliente">Cliente</p>
                                    <p class="clienteNome">UNEB</p>
                                </div>
                                <div class="linha">
                                    <p class="localizacao">Localização</p>
                                    <p class="localizacaoNome">'. htmlspecialchars($maquina['localizacao']) .'</p>
                                </div>
                                <div class="linha2">
                                    <div class="linha">
                                        <p class="modelo">Modelo</p>
                                        <p class="modeloNome">'. htmlspecialchars($maquina['modelo']) .'</p>
                                    </div>
                                    <div class="linha">
                                        <p class="marca">Marca</p>
                                        <p class="marcaNome">'. htmlspecialchars($maquina['marca']) .'</p>
                                    </div>
                                </div>
                                <div class="linha2 linha3">
                                    <div class="linha">
                                        <p class="fluidoRefrigerante">Fluido refrigerante</p>
                                        <p class="fluidoRefrigeranteNome">'. htmlspecialchars($maquina['fluido_refrigerante']) .'</p>
                                    </div>
                                    <div class="linha">
                                        <p class="capacidadeTermica">Capacidade termica</p>
                                        <p class="capacidadeTermicaNome">'. htmlspecialchars($maquina['capacidade_termica_de_refrigeracao']) .' BTUs</p>
                                    </div>
                                </div>
                            </div>
                            <div class="botoes">
                                <form class="botoes" method="POST">
                                    <button name="editar" value="'. htmlspecialchars($maquina['cod_maquina']) .'" class="editarButton"><strong>Editar informacoes</strong></button>
                                    <button name="historico" value="'. htmlspecialchars($maquina['cod_maquina']) .'" class="historicoButton"><strong>Ver histórico de manutenções</strong></button>                                
                                </form>
                            </div>
                        </div>
                    ';
                }
                ?>
                <!-- <div class="card_informacao">
                    <div class="titulo">
                        <p class="codigo"></p>
                        <div class="nome">
                            <p class="nomeP"></p>
                            <p class="data"></p>
                        </div>
                        <figure class="lixeira"><img src="/sigem/templates/assets/img/lixeira.png" alt="Trash bin icon for deleting machine records"></figure>
                    </div>
                    <div class="informacoes">
                        <div class="linha">
                            <p class="cliente"></p>
                            <p class="clienteNome"></p>
                        </div>
                        <div class="linha">
                            <p class="localizacao"></p>
                            <p class="localizacaoNome"></p>
                        </div>
                        <div class="linha2">
                            <div class="linha">
                                <p class="modelo"></p>
                                <p class="modeloNome"></p>
                            </div>
                            <div class="linha">
                                <p class="marca"></p>
                                <p class="marcaNome"></p>
                            </div>
                        </div>
                        <div class="linha2">
                            <div class="linha">
                                <p class="fluidoRefrigerante"></p>
                                <p class="fluidoRefrigeranteNome"></p>
                            </div>
                            <div class="linha">
                                <p class="capacidadeTermica"></p>
                                <p class="capacidadeTermicaNome"></p>
                            </div>
                        </div>
                    </div>
                    <div class="botoes">
                        <button class="editarButton">Editar informacoes</button>
                        <button class="historicoButton">Ver histórico de manutenções</button>
                    </div>
                </div> -->

                <!-- CARDS AGORA SÃO CLICÁVEIS -->
                <!-- <div class="card_maquina">
                    <div class="badge_maquina">Máquina 001</div>
                    <p class="descricao_maquina">Ar condicionado</p>
                </div>
                
                <div class="card_maquina">
                    <div class="badge_maquina">Máquina 002</div>
                    <p class="descricao_maquina">Ar condicionado</p>
                </div>
                
                <div class="card_maquina">
                    <div class="badge_maquina">Máquina 003</div>
                    <p class="descricao_maquina">Ar condicionado</p>
                </div>
                
                <div class="card_maquina">
                    <div class="badge_maquina">Máquina 004</div>
                    <p class="descricao_maquina">Ar condicionado</p>
                </div> -->
            </div>
            
        </div>
    </main>
    <script src="/sigem/templates/assets/js/gerenciamento_de_maquinas_adm.js"></script>
</body>

</html>