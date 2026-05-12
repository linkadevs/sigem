<?php
require_once __DIR__ . '/../Controller/PaginainicialController.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

$erro = null;
$ultimamanutencao_dados = null;
$cod_maquina = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_maquina = trim($_POST['cod_maquina'] ?? '');
} elseif (!empty($_GET['cod_maquina'])) {
    $cod_maquina = trim($_GET['cod_maquina']);
}

if ($cod_maquina === '') {
    $erro = 'Código de máquina não informado. Volte e tente novamente.';
} else {
    try {
        $controller = new Controller\PaginainicialController();
        $ultimamanutencao_dados = $controller->consultar_ultima_manutencao($cod_maquina);

        if (!$ultimamanutencao_dados) {
            $erro = 'Máquina não encontrada ou sem manutenção registrada para este código.';
        }
    } catch (Exception $e) {
        $erro = 'Erro ao consultar manutenção: ' . $e->getMessage();
    }
}

$dataHoraFormatada = null;
if (!empty($ultimamanutencao_dados['data_e_hora'])) {
    $timestamp = strtotime($ultimamanutencao_dados['data_e_hora']);
    if ($timestamp !== false) {
        $dataHoraFormatada = date('d/m/Y H:i', $timestamp);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sigem/templates/assets/css/pagina_inicial.css">
    <title>Resultado da Manutenção</title>
</head>

<body class="pagina-resultado">
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
                        <div class="caixa_bloqueada1" id="caixaHistorico">
                            <h3>Histórico de manutenções</h3>
                        </div>
                        <div class="caixa_bloqueada2" id="caixaRegistrar">
                            <h3>Registrar nova manutenção</h3>
                            <figure class="chave">
                                <img src="/sigem/templates/assets/img/chave_de_fenda.png" alt="chave de fenda">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Cform">
                <?php if (!$ultimamanutencao_dados): ?>
                    <h1>Bem-vindo!</h1>
                    <h2 class="subtitulo">Identifique a máquina que deseja consultar</h2>
                    <figure class="linha_azul">
                        <img src="/sigem/templates/assets/img/linha_azul.png" alt="linha azul no form">
                    </figure>
                <?php endif; ?>

                <?php if ($erro): ?>
                    <div class="erro-mensagem"><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php elseif ($ultimamanutencao_dados): ?>
                    <div class="maquina_encontrada">
                        <h2>Máquina encontrada!</h2>
                        <h3 class="subtitulo_maquina">Essas são as informações da última manutenção realizada</h3>
                        <div class="maquina-info">
                            <p><strong>Máquina</strong> <?php echo htmlspecialchars($ultimamanutencao_dados['cod_maquina_fk'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Tipo de serviço</strong> <?php echo htmlspecialchars($ultimamanutencao_dados['tipo_de_servico'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Nome do técnico</strong> <?php echo htmlspecialchars($ultimamanutencao_dados['nome_tecnico'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Data e Hora</strong> <?php echo htmlspecialchars($dataHoraFormatada ?? $ultimamanutencao_dados['data_e_hora'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                        <button class="btn_abrir_chamado" id="btnabrirchamado" type="button">Abrir novo chamado</button>
                        <figure class="logo2">
                            <img src="/sigem/templates/assets/img/logo2.png" alt="Logo">
                        </figure>
                    </div>
                <?php endif; ?>

                <?php if (!$ultimamanutencao_dados): ?>
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
                <?php endif; ?>
            </div>
        </div>
    </main>

    <div class="botoes">
        <div class="btn_nova_manutencao">
            <button type="button" class="btnNovaManutencao">
                Registrar nova manutenção
                <img src="/sigem/templates/assets/img/cadeadoone.png" alt="botão" class="cadeado_nova_manutencao">
            </button>
        </div>
        <div class="btn_historico">
            <button type="button" class="btnHistorico">
                Histórico de Manutenções
                <img src="/sigem/templates/assets/img/cadeadotwo.png" alt="botão" class="cadeado_historico">
            </button>
        </div>
    </div>

    <script src="/sigem/templates/assets/js/pagina_inicial.js"></script>
</body>

</html>

