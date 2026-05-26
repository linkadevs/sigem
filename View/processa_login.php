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

if (strlen($cpf_cnpj) !== 11 && strlen($cpf_cnpj) !== 14) {
    echo '<script>
            alert("CPF ou CNPJ inválido. (Insira apenas números)");
            window.history.back();
        </script>';
    exit;
}

// ==============================================
// 3. CHAMAR O CONTROLLER PARA AUTENTICAR E VALIDAR
// ==============================================

$segmentacaoController = new Controller\SegmentacaoController();

if(strlen($cpf_cnpj) === 11) {
    $cpf_cnpj = preg_replace(
        "/(\d{3})(\d{3})(\d{3})(\d{2})/",
        "$1.$2.$3-$4",
        $cpf_cnpj
    );
}
if(strlen($cpf_cnpj) === 14) {
    $cpf_cnpj = preg_replace(
        "/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/",
        "$1.$2.$3/$4-$5",
        $cpf_cnpj
    );
}

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