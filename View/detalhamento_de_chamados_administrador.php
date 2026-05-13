<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhamento de Chamados</title>
    <link rel="stylesheet" href="/templates/assets/css/detalhamento_de_chamados_administrador.css">
</head>
<body>
    <aside class="menu_lateral">
        <nav>
            <div class="menu_perfil">
                <button class="btn_perfil">
                    <div class="circuloperfil">
                        <figure><img src="/templates/assets/img/menu-perfil.png" alt="Perfil"></figure>
                    </div>
                    <p>Administrador</p>
                </button>
            </div>
            <div class="menu_home">
                <button class="btn_home">
                    <figure><img src="/templates/assets/img/menu-home.png" alt="Home"></figure>
                    <p>Home</p>
                </button>
            </div>
            <div class="menu_maquinas">
                <button class="btn_maquinas">
                    <figure><img src="/templates/assets/img/menu-maquinas.png" alt="Máquinas"></figure>
                    <p>Máquinas</p>
                </button>
            </div>
            <div class="menu_clientes">
                <button class="btn_clientes">
                    <figure><img src="/templates/assets/img/menu-clientes.png" alt="Clientes"></figure>
                    <p>Clientes</p>
                </button>
            </div>
            <div class="menu_chamados">
                <button class="btn_chamados ativo">
                    <figure><img src="/templates/assets/img/menu-chamadosazul.png" alt="Chamados"></figure>
                    <p>Chamados</p>
                </button>
            </div>
            <div class="menu_manutencoes">
                <button class="btn_manutencoes">
                    <figure><img src="/templates/assets/img/menu-manutencao.png" alt="Manutenções"></figure>
                    <p>Manutenções</p>
                </button>
            </div>
            <div class="menu_pecas">
                <button class="btn_pecas">
                    <figure><img src="/templates/assets/img/menu-pecas.png" alt="Peças"></figure>
                    <p>Solicitações de peças</p>
                </button>
            </div>
            <div class="menu_tecnicos">
                <button class="btn_tecnicos">
                    <figure><img src="/templates/assets/img/menu-tecnico.png" alt="Técnicos"></figure>
                    <p>Técnicos</p>
                </button>
            </div>
            <div class="menu_logout">
                <button class="btn_logout">
                    <figure><img src="/templates/assets/img/menu-logout.png" alt="Logout"></figure>
                    <p>Logout</p>
                </button>
            </div>
        </nav>
    </aside>

    <main>
        <div class="container">
            
            <div class="conteudo_superior">
                <h1>Chamados</h1>
                <div class="pesquisa_wrapper">
                    <div class="input-container">
                        <figure><img src="/templates/assets/img/lupa_branca.png" alt="Lupa"></figure>
                        <input type="text" placeholder="Busque por um Cliente, UF, CNPJ ou Código da Máquina!">
                    </div>
                    <button class="procurar">Procurar</button>
                </div>
            </div>

            <div class="informacoes_chamado">
                <section class="card_info">
                    <div class="linha_form">
                        <span class="label">Cliente:</span>
                        <span class="valor destaque">UNEB</span>
                    </div>
                    <div class="linha_form dupla">
                        <div class="coluna">
                            <span class="label">Status:</span>
                            <span class="valor center">Em aberto</span>
                        </div>
                        <div class="coluna">
                            <span class="label">Data:</span>
                            <span class="valor center">14/04/2026</span>
                        </div>
                    </div>
                    <div class="linha_form dupla">
                        <div class="coluna">
                            <span class="label">CNPJ:</span>
                            <span class="valor center">AB.123.CDE/0001-XY</span>
                        </div>
                        <div class="coluna">
                            <span class="label">UF:</span>
                            <span class="valor center">BA</span>
                        </div>
                    </div>
                    <div class="linha_form">
                        <span class="label">Cidade (Localização do Chamado):</span>
                        <span class="valor center">Salvador</span>
                    </div>
                    <div class="linha_form contato">
                        <span class="label">Contato:</span>
                        <span class="valor center">(71) 97726-5052</span>
                    </div>
                </section>

                <section class="card_info rosa">
                    <div class="linha_form dupla">
                        <div class="coluna">
                            <span class="label titulo_quebra">Nome da<br>Máquina:</span>
                            <span class="valor center">Ar condicionado</span>
                        </div>
                        <div class="coluna justify_end">
                            <span class="label titulo_quebra">Código da<br>Máquina:</span>
                            <span class="valor center codigo_valor">001</span>
                        </div>
                    </div>
                    <div class="linha_form coluna_desc">
                        <span class="label">Descrição do Problema:</span>
                        <div class="desc_problema">
                            A máquina está apresentando falhas durante o funcionamento, com interrupções inesperadas no processo e ruídos incomuns.
                        </div>
                    </div>
                </section>
            </div>

            <div class="card_galeria">
                <figure><img src="/templates/assets/img/img-chamado1.png" alt="Foto"></figure>
                <figure><img src="/templates/assets/img/img-chamado2.png" alt="Foto"></figure>
                <figure><img src="/templates/assets/img/img-chamado3.png" alt="Foto"></figure>
                <figure><img src="/templates/assets/img/img-chamado4.png" alt="Foto"></figure>
                <figure><img src="/templates/assets/img/img-chamado5.png" alt="Foto"></figure>
                <figure><img src="/templates/assets/img/img-chamado6.png" alt="Foto"></figure>
            </div>
            
            <div class="modal" id="imageModal">
                <button class="modal-close" id="closeModal">&times;</button>
                <img class="modal-img" id="modalImg" src="" alt="Imagem ampliada">
            </div>
        </div>
    </main>
    <script src="/templates/assets/js/detalhamento_de_chamados_administrador.js"></script>
</body>
</html>