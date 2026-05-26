<?php
require_once __DIR__ . '/../Controller/GerenciamentoClienteController.php';
use Controller\GerenciamentoClienteController;

$controller = new GerenciamentoClienteController();
$cliente = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $cliente = $controller->buscarClientePorId($_GET['id']);
    if (!$cliente) {
        echo "<script>alert('Cliente não encontrado!'); window.location.href='pagina_gerenciamento_clientes.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro/Editar Cliente</title>
    <link rel="stylesheet" href="../templates/assets/css/cadastro_de_clientes_administrador.css">
</head>
<body>
    <main class="container_cadastro">
        <section class="secao_imagem">
            <figure class="img-figure">
                <img class="img-mobile" src="../templates/assets/img/ilustracao_mulher.png" alt="Cadastro de técnicos">
                <img class="img-desktop" src="../templates/assets/img/foto.jpeg" alt="Cadastro de técnicos">
            </figure>
            <button class="btn_voltar" onclick="window.history.back()">
                <figure><img src="../templates/assets/img/seta_voltar.png" alt="Voltar"></figure>
            </button>
        </section>

        <section class="secao_formulario">
            <div class="conteudo_formulario">
                <h1 class="titulo_formulario"><?php echo $cliente ? 'Editar cliente' : 'Cadastrar cliente'; ?></h1>
                
                <form class="grade_formulario" action="../Controller/processa_cliente.php" method="POST">
                    
                    <input type="hidden" name="acao" value="<?php echo $cliente ? 'editar' : 'cadastrar'; ?>">
                    <?php if ($cliente): ?>
                        <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
                    <?php endif; ?>

                    <div class="grupo_input">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome'] ?? ''); ?>" required>
                    </div>

                    <div class="grupo_input">
                        <label>CNPJ</label>
                        <input type="number" oninput="this.value = this.value.replace(/\D/g, '')" name="cnpj" value="<?php echo htmlspecialchars(preg_replace('/\D/', '', $cliente['cnpj']) ?? ''); ?>" required>
                    </div>

                    <div class="grupo_input">
                        <label>UF</label>
                        <select name="uf" id="uf">
                            <?php if(!empty($cliente) && isset($cliente)):?>
                                <option value="<?= $cliente['uf']?>" selected><?= $cliente['uf']?></option>
                            <?php else:?>
                                <option value="" selected>Selecione um estado</option>
                            <?php endif;?>
                        </select>
                    </div>

                    <div class="grupo_input">
                        <label>Cidade</label>
                        <select name="cidade" id="cidade">
                            <?php if(!empty($cliente) && isset($cliente)):?>
                                <option value="<?= $cliente['cidade']?>" selected><?= $cliente['cidade']?></option>
                            <?php else:?>
                                <option value="" selected>Selecione uma cidade</option>
                            <?php endif;?>
                        </select>
                    </div>

                    <div class="grupo_input">
                        <label>E-mail</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($cliente['email'] ?? ''); ?>" required>
                    </div>

                    <div class="grupo_input">
                        <label>Número de contato</label>
                        <input type="number" oninput="this.value = this.value.replace(/\D/g, '')" name="contato" value="<?php echo htmlspecialchars(preg_replace('/\D/', '', $cliente['contato']) ?? ''); ?>" required>
                    </div>

                    <div class="grupo_input largura_total">
                        <label>Senha <?php echo $cliente ? '(Deixe em branco para manter)' : ''; ?></label>
                        <input type="password" name="senha" <?php echo $cliente ? '' : 'required'; ?>>
                    </div>

                    <button type="submit" class="btn_salvar">Salvar</button>
                </form>
            </div>
        </section>
    </main>
    <script src="../templates/assets/js/cadastro_de_clientes_administrador.js"></script>
</body>
</html>