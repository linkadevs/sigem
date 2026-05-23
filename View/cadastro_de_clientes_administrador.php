<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../templates/assets/css/cadastro_de_clientes_administrador.css">
</head>
<body>
    <main class="container_edicao">
        
        <!-- LADO ESQUERDO: ORBES + ILUSTRAÇÃO -->
        <section class="secao_imagem">
            <button class="btn_voltar">
                <figure><img src="../templates/assets/img/seta_voltar.png" alt="Seta para voltar"></figure>
            </button>
            
            <!-- As 5 orbes nomeadas em ordem -->
            <img src="../templates/assets/img/Orbe1.png" class="orbe orbe1" alt="Orbe azul topo esquerdo">
            <img src="../templates/assets/img/Orbe2.png" class="orbe orbe2" alt="Orbe azul topo direito">
            <img src="../templates/assets/img/Orbe3.png" class="orbe orbe3" alt="Orbe rosa do meio">
            <img src="../templates/assets/img/Orbe4.png" class="orbe orbe4" alt="Orbe roxa direita inferior">
            <img src="../templates/assets/img/Orbe5.png" class="orbe orbe5" alt="Orbe rosa esquerda inferior">
            
            <!-- A Mulher -->
            <img src="../templates/assets/img/ilustracao_mulher.png" class="mulher_ilustracao" alt="Ilustração">
        </section>

        <!-- LADO DIREITO: FORMULÁRIO -->
        <section class="secao_formulario">
            <div class="conteudo_formulario">
                <h1 class="titulo_formulario">Editar cliente</h1>
                
                <form class="grade_formulario" id="form_edicao">
                    <div class="grupo_input">
                        <label>Nome</label>
                        <input type="text" value="UNEB" required>
                    </div>

                    <div class="grupo_input">
                        <label>CNPJ</label>
                        <input type="text" value="AB.123.CDE/0001-XY" required>
                    </div>

                    <div class="grupo_input">
                        <label>UF</label>
                        <select class="input_select" id="uf" required>
                            <option value="BA" selected>BA</option>
                        </select>
                    </div>

                    <div class="grupo_input">
                        <label>Cidade</label>
                        <select class="input_select" id="cidade" required>
                            <option value="Camaçari" selected>Camaçari</option>
                        </select>
                    </div>

                    <div class="grupo_input">
                        <label>E-mail</label>
                        <input type="email" value="Exemplo@gmail.com" required>
                    </div>

                    <div class="grupo_input">
                        <label>Número de contato</label>
                        <input type="tel" value="+55 (71) 12345-6789" required>
                    </div>

                    <div class="grupo_input largura_total">
                        <label>Senha</label>
                        <input type="password" value="********" required>
                    </div>

                    <button type="submit" class="btn_editar">Editar</button>
                </form>
            </div>
        </section>

    </main>
    <script src="../templates/assets/js/cadastro_de_clientes_adm.js"></script>
</body>
</html>