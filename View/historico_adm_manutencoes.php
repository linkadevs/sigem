<?php
// INICIA A SESSÃO PARA MANTER DADOS DO USUÁRIO
session_start();

// ==============================================
// 1. RECEBE OS DADOS DA URL (GET)
// ==============================================
// Pega o código da máquina que veio na URL (ex: ?cod_maquina=M001)
$cod_maquina = $_GET['cod_maquina'] ?? null;

// Pega o filtro de pesquisa que veio na URL (ex: &filtro=João)
$filtro = $_GET['filtro'] ?? '';

// ==============================================
// 2. CARREGA O CONTROLLER E BUSCA OS DADOS
// ==============================================
// Inclui o arquivo do Controller
require_once __DIR__ . '/../Controller/HistoricoController.php';

// Cria uma instância do Controller
$historico = new Controller\HistoricoController();

// SE tem filtro, busca com filtro; SENÃO, busca tudo
if (!empty($filtro)) {
    // Chama o método de pesquisa com filtro
    $informacoes = $historico->barra_de_Pesquisa($cod_maquina, $filtro);
} else {
    // Chama o método normal (sem filtro)
    $informacoes = $historico->obterHistorico($cod_maquina);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Manutenções</title>
    <link rel="stylesheet" href="../templates/assets/css/historico_adm_manutencoes.css">
</head>

<body>

    <!-- FUNDO DA PÁGINA (IMAGEM DECORATIVA) -->
    <div class="imagem_de_fundo">
        <figure>
            <img src="../templates/assets/img/fundo-desktop-cadastro.png" alt="">
        </figure>
    </div>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="container_fundo">
        <section class="card_principal">

            <!-- CABEÇALHO COM TÍTULO E BOTÃO VOLTAR -->
            <header class="cabecalho_historico">
                <!-- Botão voltar (usa JavaScript para voltar à página anterior) -->
                <button class="btn_voltar" onclick="window.history.back()">
                    <figure><img src="../templates/assets/img/seta_voltar.png" alt="Seta Voltar"></figure>
                </button>
                <div class="textos_cabecalho">
                    <h1 class="titulo_card">Histórico de manutenções</h1>
                    <p class="subtitulo_card">Esse é o histórico de manutenções realizadas na máquina
                        <?php echo htmlspecialchars($cod_maquina); ?>
                    </p>
                </div>
            </header>

            <!-- LINHA DIVISÓRIA -->
            <hr class="linha_divisoria">

            <!-- ============================================== -->
            <!-- FORMULÁRIO DE PESQUISA (FILTRO)               -->
            <!-- ============================================== -->
            <form class="container_pesquisa" method="GET" action="" id="formPesquisa">

                <!-- CAMPO OCULTO: mantém o código da máquina na URL -->
                <input type="hidden" name="cod_maquina" value="<?php echo htmlspecialchars($cod_maquina); ?>">


                <div class="input_wrapper">
                    <!-- ÍCONE DE LUPA -->
                    <figure class="icone_lupa"><img src="../templates/assets/img/lupa_cinza.png" alt="Lupa"></figure>

                    <!-- CAMPO DE TEXTO PARA O FILTRO -->
                    <input type="text" name="filtro" id="filtro" class="input_pesquisa"
                        placeholder="Busque por uma data, nome ou serviço específico!"
                        value="<?php echo htmlspecialchars($filtro); ?>">
                </div>

                <!-- BOTÃO DE PESQUISAR -->
                <button type="submit" class="btn_pesquisar">Pesquisar</button>

                <!-- BOTÃO LIMPAR FILTRO (só aparece se tiver filtro ativo) -->
                <?php if (!empty($filtro)): ?>
                    <a href="?cod_maquina=<?php echo urlencode($cod_maquina); ?>" class="btn_limpar"
                        style="color: #094C71; font-weight: bold; margin-left: .5rem; margin-right: .5rem; font-size: 1.2rem;">Limpar
                        filtro</a>
                <?php endif; ?>
            </form>

            <!-- ============================================== -->
            <!-- LISTA DE MANUTENÇÕES (RESULTADOS)              -->
            <!-- ============================================== -->
            <div class="lista_manutencoes">

                <!-- CASO 1: Tem filtro mas NÃO encontrou resultados -->
                <?php if (empty($informacoes) && !empty($filtro)): ?>
                    <div class="nenhuma-manutencao"
                        style="text-align: center; color:#094C71; font-weight: bold; font-size: 1.5rem;">
                        <p>Nenhuma manutenção encontrada para "<strong><?php echo htmlspecialchars($filtro); ?></strong>".
                        </p>
                    </div>

                    <!-- CASO 2: Sem filtro e NÃO tem manutenções cadastradas -->
                <?php elseif (empty($informacoes)): ?>
                    <div class="nenhuma-manutencao"
                        style="text-align: center; color:#094C71; font-weight: bold; font-size: 2rem;">
                        <p>Nenhuma manutenção encontrada para esta máquina.</p>
                    </div>

                    <!-- CASO 3: Tem resultados → exibe os cards -->
                <?php else: ?>

                    <!-- LOOP: percorre cada manutenção e cria um card -->
                    <?php foreach ($informacoes as $informacao): ?>
                        <?php $id_tecnico = $informacao['id_tecnico_fk'] ?? null; ?>
                        <?php $id_manutencao = $informacao['id_manutencao'] ?? null; ?>

                        <article class="card_manutencao">

                            <!-- COLUNA DO ÍCONE (engrenagens) -->
                            <div class="coluna_icone">
                                <figure><img src="../templates/assets/img/engrenagens.png" alt="Engrenagens"></figure>
                            </div>

                            <!-- COLUNA DOS DADOS (técnico + tipo de serviço) -->
                            <div class="coluna_dados">
                                <!-- Nome do técnico -->
                                <div class="linha_dado">
                                    <span class="rotulo_dado">Nome do técnico:</span>
                                    <span
                                        class="tag_dado"><?php echo htmlspecialchars($informacao['nome_tecnico'] ?? 'Não atribuído'); ?></span>
                                </div>
                                <!-- Tipo de serviço (com tradução) -->
                                <div class="linha_dado">
                                    <span class="rotulo_dado">Tipo de serviço:</span>
                                    <span class="tag_dado">
                                        <?php
                                        $tipo = $informacao['tipo_de_servico'] ?? '';
                                        if ($tipo === 'instalacao') {
                                            echo 'Instalação';
                                        } else if ($tipo === 'manutencao_preventiva') {
                                            echo 'Manutenção preventiva';
                                        } else if ($tipo === 'manutencao_corretiva') {
                                            echo 'Manutenção corretiva';
                                        } else if ($tipo === 'inspecao') {
                                            echo 'Inspeção';
                                        }
                                        ?>
                                
                                    </span>
                                </div>
                            </div>

                            <!-- COLUNA DA DATA -->
                            <div class="coluna_data">
                                <span class="data_manutencao">
                                    <?php
                                    // Formata a data do formato americano para brasileiro
                                    $data = $informacao['data_e_hora'] ?? '';
                                    if ($data && $data != '0000-00-00 00:00:00') {
                                        echo date('d/m/Y H:i', strtotime($data));
                                    } else {
                                        echo 'Data e hora não disponíveis';
                                    }
                                    ?>
                                </span>
                                <button class="btn_pmoc"
                                    onclick="window.location.href = 'pagina_visualizacao_pmoc.php?cod_maquina=<?php echo urlencode($cod_maquina); ?>&id_manutencao=<?php echo urlencode($id_manutencao); ?>&id_tecnico=<?php echo urlencode($id_tecnico); ?>'">Ver
                                    PMOC</button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </section>
    </main>

    <!-- ============================================== -->
    <!-- JAVASCRIPT-->
    <!-- ============================================== -->

    <script>
        // Aguarda o formulário ser enviado
        document.getElementById('formPesquisa').addEventListener('submit', function (e) {
            // IMPEDE o envio normal do formulário
            e.preventDefault();

            // Pega o valor digitado no campo de filtro
            let filtro = document.getElementById('filtro').value;

            // Verifica se parece uma data brasileira (dd/mm/aaaa ou dd/mm)
            if (filtro.match(/^\d{2}\/\d{2}(\/\d{4})?$/)) {
                let partes = filtro.split('/');
                if (partes.length === 3) {
                    // dd/mm/aaaa -> aaaa-mm-dd
                    filtro = partes[2] + '-' + partes[1] + '-' + partes[0];
                } else if (partes.length === 2) {
                    // dd/mm -> mm-dd
                    filtro = partes[1] + '-' + partes[0];
                }
            }

            // SUBSTITUI a URL atual (NÃO cria nova no histórico)
            window.location.replace('?cod_maquina=<?php echo urlencode($cod_maquina); ?>&filtro=' + encodeURIComponent(filtro));
        });
    </script>
</body>

</html>