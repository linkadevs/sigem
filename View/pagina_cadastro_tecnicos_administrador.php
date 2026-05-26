<?php
// Importa o Controller (ajuste o caminho se necessário)
require_once __DIR__ . '/../Controller/GerenciamentoTecController.php';

use Controller\GerenciamentoTecController;

$controller = new GerenciamentoTecController();

// Variável que armazenará os dados do técnico (inicia nula)
$tecnico = null;

// Verifica se existe um ID na URL para edição
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_tecnico = $_GET['id'];
    
    // Usa o método buscarTecnicoPorId que você criou no Controller
    $tecnico = $controller->buscarTecnicoPorId($id_tecnico);

    // Caso o ID seja inválido ou não exista no banco
    if (!$tecnico) {
        echo "<script>alert('Técnico não encontrado!'); window.location.href='pagina_gerenciamento_de_tecnicos_adm.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de técnicos</title>
    <link rel="stylesheet" href="../templates/assets/css/pagina_cadastro_tecnicos_administrador.css">
</head>

<body>
    <main>
        <div class="esquerda">
            <div class="voltar">
                <button onclick="window.location.href='pagina_gerenciamento_de_tecnicos_adm.php'">
                    <figure>
                        <img src="../templates/assets/img/seta_voltar_semfundo.png" alt="Voltar">
                    </figure>
                </button>
            </div>

            <div class="imgprincipal">
                <figure>
                    <img class="img-desktop" src="../templates/assets/img/foto-cadastrartec.png" alt="Cadastro de técnicos">
                </figure>
                <figure>
                    <img class="img-tablet" src="../templates/assets/img/foto-cadastrartec-tablet.png" alt="Cadastro de técnicos - Tablet">
                </figure>
                <figure>
                    <img class="img-mobile" src="../templates/assets/img/foto-cadastrartec-mobile.png" alt="Cadastro de técnicos - Mobile">
                </figure>
            </div>
        </div>

        <div class="direita">
            <h1><?php echo $tecnico ? 'Editar Colaborador' : 'Cadastre seu novo colaborador!'; ?></h1>
            
            <form action="../Controller/processa_tecnico.php" method="POST">
                
                <?php if ($tecnico): ?>
                    <input type="hidden" name="id_tecnico" value="<?php echo $tecnico['id_tecnico']; ?>">
                    <input type="hidden" name="acao" value="editar">
                <?php else: ?>
                    <input type="hidden" name="acao" value="cadastrar">
                <?php endif; ?>

                <div class="entrada">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" required 
                           value="<?php echo $tecnico['nome'] ?? ''; ?>" 
                           placeholder="Insira o nome do colaborador" class="inputnome">
                </div>

                <div class="entrada">
                    <label for="cpf">CPF</label>
                    <input type="number" name="cpf" id="cpf" required 
                           value="<?php echo htmlspecialchars(preg_replace('/\D/', '', $tecnico['cpf'])) ?? ''; ?>" 
                           oninput="this.value = this.value.replace(/\D/g, '')"
                           placeholder="ABC.DEF.GHI-JK" class="inputcpf">
                </div>

                <div class="entrada">
                    <label for="funcao">Função</label>
                    <select name="funcao" required id="funcao" class="selectfuncao">
                        <option value="Mecanico(a)" <?php echo (isset($tecnico['funcao']) && $tecnico['funcao'] == 'mecanico') ? 'selected' : ''; ?>>Mecânico(a)</option>
                        <option value="Eletricista" <?php echo (isset($tecnico['funcao']) && $tecnico['funcao'] == 'eletricista') ? 'selected' : ''; ?>>Eletricista</option>
                        <option value="Técnico(a) em TI" <?php echo (isset($tecnico['funcao']) && $tecnico['funcao'] == 'tecnico_em_ti') ? 'selected' : ''; ?>>Técnico(a) em TI</option>
                        <option value="Técnico(a) em refrigeração" <?php echo (isset($tecnico['funcao']) && $tecnico['funcao'] == 'tecnico_refrigeracao') ? 'selected' : ''; ?>>Técnico(a) em refrigeração</option>
                    </select>
                </div>

                <div class="entrada">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required 
                           value="<?php echo $tecnico['email'] ?? ''; ?>" 
                           placeholder="Insira seu email" class="inputemail">
                </div>
                

                <div class="entrada">
                    <label for="senha">Senha</label>
                    <input type="password" <?php echo $tecnico ? '' : 'required'; ?> name="senha" id="senha" placeholder="<?php echo $tecnico ? 'Deixe em branco para manter a atual' : 'Insira uma senha inicial'; ?>">
                    <figure class="olhofechado">
                        <img src="../templates/assets/img/olho_fechado.png" alt="">
                    </figure>
                    <figure class="olhoaberto">
                        <img src="../templates/assets/img/olho_aberto.png" alt="">
                    </figure>
                </div>

                <button type="submit" class="salvar">Salvar</button>
            </form>
        </div>
    </main>
    <script src="../templates/assets/js/pagina_cadastro_tecnicos_administrador.js"></script>
</body>

</html>