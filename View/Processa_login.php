<?php

session_start();

require_once __DIR__ . '/../Controller/SegmentacaoController.php';

// ==============================================
// 1. RECEBER OS DADOS DO FORMULÁRIO
// ==============================================

$cpf_cnpj = $_POST['cpf_cnpj'] ?? '';
$senha = $_POST['senha'] ?? '';
$objetivo = $_POST['objetivo'] ?? null;
$cod_maquina = $_POST['cod_maquina'] ?? null;

// ==============================================
// 2. VALIDAÇÃO BÁSICA
// ==============================================
if (empty($cpf_cnpj) || empty($senha)) {
    $_SESSION['erro'] = 'Preencha CPF/CNPJ e senha!';
    header('Location: login.php?objetivo=' . $objetivo . '&cod_maquina=' . urlencode($cod_maquina));
    exit();
}

    if (empty($objetivo)) {
        $_SESSION['erro'] = 'Nenhuma funcionalidade selecionada!';
        header('Location: pagina_inicial.php');
        exit();
    }

// ==============================================
// 3. CHAMAR O CONTROLLER PARA AUTENTICAR E VALIDAR
// ==============================================

$segmentacaoController = new Controller\SegmentacaoController();
$resultado = $segmentacaoController->Autenticar_e_validar($cpf_cnpj, $senha, $objetivo, $cod_maquina);


// ==============================================
// 4. VERIFICAR SE HOUVE ERRO
// ==============================================

if (isset($resultado['erro'])) {
    $_SESSION['erro'] = $resultado['erro'];
    header('Location: login.php?objetivo=' . $objetivo . '&cod_maquina=' . urlencode($cod_maquina));
    exit;
}
// ==============================================
// 5. SUCESSO: GUARDAR DADOS NA SESSÃO
// ==============================================

$_SESSION['logado'] = true;
$_SESSION['tipo_usuario'] = $resultado['usuario']['tipo'];
$_SESSION['id_usuario'] = $resultado['usuario']['id'];
$_SESSION['nome_usuario'] = $resultado['usuario']['nome'];
$_SESSION['cod_maquina'] = $cod_maquina;


header('Location:'. $resultado['redirecionamento']);
exit;
?>