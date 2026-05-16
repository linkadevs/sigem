<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <title>Registrar manutenção</title>
        <link rel="stylesheet" href="../templates/assets/css/registro_nova_manutencao.css">
    </head>
    <body>
        <header>
            <button class="botaoVoltar" type="button">
                <figure class="voltarFigure"><img src="../templates/assets/img/seta_voltar_semfundo.png" alt="Seta apontando para a esquerda para voltar à página anterior" class="voltarImg"></figure>
                Voltar
            </button>
            <nav>
                <button class="nav-btn pagina-principal" type="button">Página principal</button>
                <button class="nav-btn historico" type="button">Histórico</button>
            </nav>
        </header>
        <main>
            <form method="POST" enctype="multipart/form-data">
                <h3>Máquina 001</h3>
                <h1>Registrar nova manutenção</h1>
                <p>Nos mantenha informados sobre as manutenções realizadas!</p>
                <div class="inputs">
                    <div class="input">
                        <label for="nome_tecnico">Nome do técnico <span class="required">*</span></label>
                        <input class="inputTexto" type="text" id="nome_tecnico" name="nome_tecnico" placeholder="Insira o nome do técnico" value="João Silva" disabled required>
                        <input type="hidden" id="nome_tecnico_hidden" name="nome_tecnico" value="João Silva">
                    </div>
                    <div class="input">
                        <label for="nome_acompanhante">Acompanhante do serviço <span class="required">*</span></label>
                        <input class="inputTexto" type="text" id="nome_acompanhante" name="nome_acompanhante" placeholder="Insira o nome do acompanhante" required>
                    </div>
                    <div class="input">
                        <label for="tipo_servico">Tipo de serviço <span class="required">*</span></label>
                        <select name="tipo_servico" id="tipo_servico" required>
                            <option value="placeholder" selected>Insira o tipo de serviço</option>
                            <option value="instalacao">Instalação</option>
                            <option value="manutencao_corretiva">Manutenção corretiva</option>
                            <option value="manutencao_preventiva">Manutenção preventiva</option>
                            <option value="inspecao">Inspeção</option>
                        </select>
                    </div>
                    
                    <!-- Seção de reposição de peças (condicional) -->
                    <div id="reposicao_pecas_container" class="reposicao-container" style="display: none;">
                        <div class="input checkbox-input">
                            <label class="checkbox-label">
                                <input type="checkbox" id="solicitar_reposicao" name="solicitar_reposicao">
                                <span>Solicitar reposição de peças</span>
                            </label>
                        </div>
                        <div id="detalhes_pecas_container" class="detalhes-pecas" style="display: none;">
                            <div class="input">
                                <label for="nome_peca">Nome da peça em falta <span class="required-peca" style="display: none;">*</span></label>
                                <input class="inputTexto" type="text" id="nome_peca" name="nome_peca" placeholder="Insira o nome da peça">
                            </div>
                            <div class="input">
                                <label for="quantidade_peca">Quantidade <span class="required-peca" style="display: none;">*</span></label>
                                <input class="inputTexto" type="number" id="quantidade_peca" name="quantidade_peca" placeholder="Informe a quantidade" min="1">
                            </div>
                            <div class="input">
                                <label for="descricao_peca">Descrição da peça em falta <span class="required-peca" style="display: none;">*</span></label>
                                <textarea id="descricao_peca" name="descricao_peca" placeholder="Descreva a peça necessária" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input">
                        <label for="descricao_servico">Descrição do serviço <span class="required">*</span></label>
                        <textarea class="inputTexto" id="descricao_servico" name="descricao_servico" placeholder="Insira a descrição do serviço" required></textarea>
                    </div>
                    
                    <div class="input">
                        <label for="pressao_aferida">Pressão aferida <span class="required">*</span></label>
                        <div class="input-com-unidade">
                            <input class="inputTexto" type="number" step="0.1" id="pressao_aferida" name="pressao_aferida" placeholder="Ex: 35.5" required>
                            <span class="unidade-medida">PSI</span>
                        </div>
                    
                    </div>
                    
                    <div class="input">
                        <label for="testes_finalizacao">Testes e finalização <span class="required">*</span></label>
                        <textarea class="inputTexto" id="testes_finalizacao" name="testes_finalizacao" placeholder="Descreva os testes realizados e a finalização do serviço" required></textarea>
                    </div>
                    <div class="input">
                        <label for="data_hora">Data e hora <span class="required">*</span></label>
                        <input class="inputDataHora" type="datetime-local" id="data_hora" name="data_hora" value="2024-12-10T14:30" disabled required>
                        <input type="hidden" id="data_hora_hidden" name="data_hora" value="2024-12-10T14:30">
                        <span class="helper-text">Data e hora pré-definidas pelo sistema</span>
                    </div>
                    <div class="input">
                        <label for="fotos">Fotos do serviço <span class="required">*</span></label>
                        <button type="button" id="botaoFotos" name="botaoFotos">Selecione fotos da manutenção</button>
                        <input type="file" name="fotos[]" id="fotos" accept="image/*" multiple required>
                        <span class="helper-text">Mínimo 1 foto obrigatória</span>
                    </div>
                    <div class="grid"></div>
                </div>
                <div class="botoes">
                    <button type="button" class="cancelar" id="cancelar">Cancelar</button>
                    <button class="enviar" id="enviar" type="submit">Enviar</button>
                </div>
            </form>
        </main>
        <script src="../templates/assets/js/registro_nova_manutencao.js"></script>
    </body>
</html>