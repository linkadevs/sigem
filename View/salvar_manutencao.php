<?php

session_start();
// ==============================================
// CARREGA OS CONTROLLERS NECESSÁRIOS
// ==============================================
// Controller responsável por salvar a manutenção
require_once __DIR__ . '/../Controller/ManutencaoController.php';
// Controller responsável por salvar solicitação de peças
require_once __DIR__ . '/../Controller/PecasController.php';

// ==============================================
// CONFIGURAÇÃO DE DEBUG - MOSTRA TODOS OS ERROS
// ==============================================
error_reporting(E_ALL);
ini_set('display_errors', '1');

// ==============================================
// 1. VERIFICA SE A REQUISIÇÃO É POST
// ==============================================
// Se não for POST, o formulário não foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método não permitido.');
}

// ==============================================
// 2. VALIDA CAMPOS OBRIGATÓRIOS
// ==============================================
// Lista de campos que são obrigatórios no formulário
$campos_obrigatorios = [
    'tipo_de_servico',      // Tipo de serviço (instalação, preventiva, etc)
    'descricao_do_servico', // Descrição do serviço realizado
    'acompanhante',         // Nome do acompanhante do serviço
    'pressao_aferida',      // Pressão medida em PSI
    'testes_e_finalizacao', // Resultados dos testes
    'cod_maquina',          // Código de identificação da máquina
    'id_tecnico'            // ID do técnico responsável
];

// Percorre cada campo obrigatório e verifica se foi preenchido
foreach ($campos_obrigatorios as $campo) {
    if (empty($_POST[$campo])) {
        die("Erro: Campo '$campo' é obrigatório.");
    }
}

// ==============================================
// 3. VALIDA AS FOTOS
// ==============================================
// Verifica se pelo menos uma foto foi enviada
if (!isset($_FILES['fotos']) || empty($_FILES['fotos']['name'][0])) {
    die('Erro: Pelo menos uma foto é obrigatória.');
}

// ==============================================
// 4. PREPARA OS DADOS PARA ENVIAR AO CONTROLLER
// ==============================================
// Organiza os dados do POST em um array associativo
$dados = [
    'tipo_de_servico' => $_POST['tipo_de_servico'],
    'descricao_do_servico' => $_POST['descricao_do_servico'],
    'acompanhante' => $_POST['acompanhante'],
    'pressao_aferida' => $_POST['pressao_aferida'],
    'testes_e_finalizacao' => $_POST['testes_e_finalizacao'],
    'cod_maquina' => $_POST['cod_maquina'],
    'id_tecnico' => $_POST['id_tecnico']
];

// ==============================================
// 5. CHAMA O CONTROLLER PARA SALVAR A MANUTENÇÃO
// ==============================================
// Instancia o controller de manutenção
$manutencaoController = new Controller\ManutencaoController();
// Chama o método que salva a manutenção (inclui processamento das fotos)
$resultado = $manutencaoController->salvarManutencao($dados, $_FILES['fotos']);

// Se houve erro, exibe a mensagem
if (isset($resultado['erro'])) {
    die("Erro: " . $resultado['erro']);
}

// ==============================================
// 6. SOLICITAÇÃO DE PEÇAS (SE HOUVER)
// ==============================================
// Verifica se o checkbox "solicitar_reposicao" foi marcado
// E se o campo "nome_peca" foi preenchido
if (isset($_POST['solicitar_reposicao']) && !empty($_POST['nome_peca']) && !empty($_POST['descricao_peca'])) {
    
    // Instancia o controller de peças
    $pecasController = new Controller\PecasController();
    
    // Define o status inicial da solicitação como 'em_aberto'
    
    // Chama o método para salvar a solicitação de peça
    $pecasController->solicitarPeca(
        $_POST['nome_peca'],           // Nome da peça solicitada
        $_POST['quantidade_peca'],
        $_POST['descricao_peca'] ?? '', // Descrição da peça (se houver)
        $_SESSION['id_usuario'],          // ID do técnico que solicitou
    );
}

// ==============================================
// 7. REDIRECIONA PARA A PÁGINA PRINCIPAL DO TÉCNICO
// ==============================================
// Após salvar tudo, redireciona para a página principal do técnico
// Passa o ID do técnico como parâmetro na URL
header("Location: pagina_principal_do_tecnico.php?id_usuario={$_POST['id_tecnico']}");
exit; // Garante que o script pare aqui
?>