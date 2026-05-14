<?php
require_once __DIR__ . '/../Controller/PaginainicialController.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

$erro = null;
$ultimamanutencao_dados = null;
$cod_maquina = '';
$maquina_valida = false;

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
            $maquina_valida = false;
        } else {
            $maquina_valida = true;
        }
    } catch (Exception $e) {
        $erro = 'Erro ao consultar manutenção: ' . $e->getMessage();
        $maquina_valida = false;
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

    <a href="pagina_inicial.php" class="btn_voltar_responsive">
        <img src="/sigem/templates/assets/img/seta_voltar.png" alt="Voltar" class="seta_voltar">
        Voltar
    </a>

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
                        <div class="caixa_bloqueada1" id="caixaHistorico"
                            data-bloqueada="<?php echo $maquina_valida ? 'false' : 'true'; ?>">
                            <h3>Histórico de manutenções</h3>
                            <?php if (!$maquina_valida): ?>
                                <figure class="cadeado1">
                                    <img src="/sigem/templates/assets/img/cadeado1.png" alt="cadeado">
                                </figure>
                            <?php endif; ?>
                        </div>
                        <div class="caixa_bloqueada2" id="caixaRegistrar"
                            data-bloqueada="<?php echo $maquina_valida ? 'false' : 'true'; ?>">
                            <h3>Registrar nova manutenção</h3>
                            <?php if (!$maquina_valida): ?>
                                <figure class="cadeado2">
                                    <img src="/sigem/templates/assets/img/cadeado2.png" alt="cadeado">
                                </figure>
                                <figure class="chave">
                                    <img src="/sigem/templates/assets/img/chave_de_fenda.png" alt="chave de fenda">
                                </figure>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Cform">
                <?php if (!$ultimamanutencao_dados && !$erro): ?>
                    <h1>Bem-vindo!</h1>
                    <h2 class="subtitulo">Identifique a máquina que deseja consultar</h2>
                    <figure class="linha_azul">
                        <img src="/sigem/templates/assets/img/linha_azul.png" alt="linha azul no form">
                    </figure>
                <?php endif; ?>

                <?php if ($erro): ?>
                    <div class="erro-mensagem"><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></div>
                    <h1>Bem-vindo!</h1>
                    <h2 class="subtitulo">Identifique a máquina que deseja consultar</h2>
                    <figure class="linha_azul">
                        <img src="/sigem/templates/assets/img/linha_azul.png" alt="linha azul no form">
                    </figure>
                    <form class="form" method="POST" action="./resultado_manutencao.php">
                        <div class="input_codigo">
                            <label for="Codigo">Código de Identificação</label>
                            <input type="text" id="Codigo" name="cod_maquina"
                                value="<?php echo htmlspecialchars($cod_maquina, ENT_QUOTES, 'UTF-8'); ?>"
                                placeholder="Insira o número de identificação da máquina" required>
                        </div>
                        <div class="btn_envio">
                            <button type="submit">Enviar!</button>
                        </div>
                    </form>
                    <figure class="logo">
                        <img src="/sigem/templates/assets/img/logo.png" alt="Logo">
                    </figure>
                    <div class="btn_login">
                        <button type="button" onclick="window.location.href='login.html'">
                            Login
                            <img src="/sigem/templates/assets/img/seta_login.png" alt="seta" class="seta_login">
                        </button>
                    </div>
                <?php elseif ($ultimamanutencao_dados): ?>
                    <div class="maquina_encontrada">
                        <h2>Máquina encontrada!</h2>
                        <h3 class="subtitulo_maquina">Essas são as informações da última manutenção realizada</h3>
                        <div class="maquina-info">
                            <p><strong>Máquina</strong>
                                <?php echo htmlspecialchars($ultimamanutencao_dados['cod_maquina_fk'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p><strong>Tipo de serviço</strong>
                                <?php echo htmlspecialchars($ultimamanutencao_dados['tipo_de_servico'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p><strong>Nome do técnico</strong>
                                <?php echo htmlspecialchars($ultimamanutencao_dados['nome_tecnico'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p><strong>Data e Hora</strong>
                                <?php echo htmlspecialchars($dataHoraFormatada ?? $ultimamanutencao_dados['data_e_hora'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        </div>
                        <button class="btn_abrir_chamado" id="btnabrirchamado" type="button">Abrir chamado</button>
                        <figure class="logo2">
                            <img src="/sigem/templates/assets/img/logo2.png" alt="Logo">
                        </figure>
                    </div>
                <?php else: ?>
                    <h1>Bem-vindo!</h1>
                    <h2 class="subtitulo">Identifique a máquina que deseja consultar</h2>
                    <figure class="linha_azul">
                        <img src="/sigem/templates/assets/img/linha_azul.png" alt="linha azul no form">
                    </figure>
                    <form class="form" method="POST" action="./resultado_manutencao.php">
                        <div class="input_codigo">
                            <label for="Codigo">Código de Identificação</label>
                            <input type="text" id="Codigo" name="cod_maquina"
                                value="<?php echo htmlspecialchars($cod_maquina, ENT_QUOTES, 'UTF-8'); ?>"
                                placeholder="Insira o número de identificação da máquina" required>
                        </div>
                        <div class="btn_envio">
                            <button type="submit">Enviar!</button>
                        </div>
                    </form>
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
            <button type="button" class="btnNovaManutencao" <?php echo !$maquina_valida ? 'disabled' : ''; ?>>
                Registrar nova manutenção
                <?php if (!$maquina_valida): ?>
                    <img src="/sigem/templates/assets/img/cadeadoone.png" alt="botao" class="cadeado_nova_manutencao">
                <?php endif; ?>
            </button>
        </div>
        <div class="btn_historico">
            <button type="button" class="btnHistorico" <?php echo !$maquina_valida ? 'disabled' : ''; ?>>
                Histórico de Manutenções
                <?php if (!$maquina_valida): ?>
                    <img src="/sigem/templates/assets/img/cadeadotwo.png" alt="botao" class="cadeado_historico">
                <?php endif; ?>
            </button>
        </div>
    </div>

    <script>
        // Script para controlar o comportamento dos botões e redirecionamentos
        document.addEventListener('DOMContentLoaded', function () {
            const maquinaValida = <?php echo json_encode($maquina_valida); ?>;
            const codMaquina = <?php echo json_encode($cod_maquina); ?>;

            const btnNovaManutencao = document.querySelector('.btnNovaManutencao');
            const btnHistorico = document.querySelector('.btnHistorico');
            const caixaHistorico = document.getElementById('caixaHistorico');
            const caixaRegistrar = document.getElementById('caixaRegistrar');
            const btnAbrirChamado = document.querySelector('.btn_abrir_chamado');

            // ========== FUNÇÕES DE REDIRECIONAMENTO ==========
            function redirecionarParaHistorico() {
                if (maquinaValida && codMaquina) {
                    window.location.href = 'login.php?objetivo=1&cod_maquina=' + encodeURIComponent(codMaquina);
                } else {
                    alert('Para acessar o histórico, primeiro consulte uma máquina válida!');
                }
            }

            function redirecionarParaRegistro() {
                if (maquinaValida && codMaquina) {
                    window.location.href = 'login.php?objetivo=2&cod_maquina=' + encodeURIComponent(codMaquina);
                } else {
                    alert('Para registrar uma nova manutenção, primeiro consulte uma máquina válida!');
                }
            }

            function redirecionarParaChamado() {
                if (maquinaValida && codMaquina) {
                    window.location.href = 'login.php?objetivo=3&cod_maquina=' + encodeURIComponent(codMaquina);
                } else {
                    alert('Não foi possível abrir o chamado. Máquina não identificada!');
                }
            }

            // ========== CONFIGURAÇÃO DAS CAIXAS LATERAIS ==========
            if (caixaHistorico) {
                const novoCaixaHistorico = caixaHistorico.cloneNode(true);
                caixaHistorico.parentNode.replaceChild(novoCaixaHistorico, caixaHistorico);

                if (maquinaValida) {
                    novoCaixaHistorico.style.cursor = 'pointer';
                    novoCaixaHistorico.addEventListener('click', redirecionarParaHistorico);
                } else {
                    novoCaixaHistorico.style.cursor = 'not-allowed';
                    novoCaixaHistorico.addEventListener('click', function (e) {
                        e.preventDefault();
                        alert('Para acessar o histórico, primeiro consulte uma máquina válida!');
                    });
                }
            }

            if (caixaRegistrar) {
                const novoCaixaRegistrar = caixaRegistrar.cloneNode(true);
                caixaRegistrar.parentNode.replaceChild(novoCaixaRegistrar, caixaRegistrar);

                if (maquinaValida) {
                    novoCaixaRegistrar.style.cursor = 'pointer';
                    novoCaixaRegistrar.addEventListener('click', redirecionarParaRegistro);
                } else {
                    novoCaixaRegistrar.style.cursor = 'not-allowed';
                    novoCaixaRegistrar.addEventListener('click', function (e) {
                        e.preventDefault();
                        alert('Para registrar uma nova manutenção, primeiro consulte uma máquina válida!');
                    });
                }
            }

            // ========== CONFIGURAÇÃO DOS BOTÕES INFERIORES ==========
            if (btnNovaManutencao) {
                if (!maquinaValida) {
                    btnNovaManutencao.disabled = true;
                } else {
                    btnNovaManutencao.disabled = false;
                    btnNovaManutencao.removeEventListener('click', redirecionarParaRegistro);
                    btnNovaManutencao.addEventListener('click', redirecionarParaRegistro);
                }
            }

            if (btnHistorico) {
                if (!maquinaValida) {
                    btnHistorico.disabled = true;
                } else {
                    btnHistorico.disabled = false;
                    btnHistorico.removeEventListener('click', redirecionarParaHistorico);
                    btnHistorico.addEventListener('click', redirecionarParaHistorico);
                }
            }

            // ========== BOTÃO "ABRIR CHAMADO" ==========
            if (btnAbrirChamado) {
                btnAbrirChamado.removeEventListener('click', redirecionarParaChamado);
                btnAbrirChamado.addEventListener('click', redirecionarParaChamado);
            }

            // ========== CONTROLE DE CADEADOS ==========
            if (maquinaValida) {
                const cadeadoHistorico = document.querySelector('#caixaHistorico .cadeado1');
                const cadeadoRegistrar = document.querySelector('#caixaRegistrar .cadeado2');
                const chave = document.querySelector('#caixaRegistrar .chave');

                if (cadeadoHistorico) cadeadoHistorico.style.display = 'none';
                if (cadeadoRegistrar) cadeadoRegistrar.style.display = 'none';
                if (chave) chave.style.display = 'none';
            }
        });
    </script>
</body>

</html>