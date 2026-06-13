<?php
// session_start();
// require_once '../classes/Painel.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Usando Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <title>Perfil da Empresa - Portal de Estágios</title>

    <style>
        body {
            background-color: #f8f9fa; /* Fundo cinza super claro */
            overflow-x: hidden;
        }
        
        /* Ajuste do container principal para evitar scroll vertical excessivo */
        .content-wrapper {
            max-height: 100vh;
            overflow-y: auto;
        }

        /* Estilo dos Cards exatos ao da imagem */
        .card-perfil {
            background: #ffffff;
            border: 1px solid var(--cor-borda-clara, #dee2e6);
            border-radius: 12px;
            padding: 20px;
            height: 100%; /* Faz os cards da mesma linha terem a mesma altura */
        }

        .card-title-perfil {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #212529;
        }

        /* Logo Quadrada Grupo 2 */
        .logo-grupo {
            width: 110px;
            height: 110px;
            background-color: var(--cor-azul-principal, #0056A3);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .logo-grupo span:first-child { font-size: 0.85rem; letter-spacing: 1px; }
        .logo-grupo span:last-child { font-size: 3rem; line-height: 1; }

        /* Textos e Labels */
        .text-info-label {
            font-size: 0.85rem;
            color: #495057;
            margin-bottom: 6px;
        }
        
        .text-info-value {
            font-size: 0.85rem;
            color: #212529;
        }

        .icon-small {
            font-size: 1.1rem;
            color: #6c757d;
            width: 24px;
            text-align: center;
        }

        /* Caixinhas de Estatísticas (As 4 caixinhas pequenas) */
        .stat-box {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px 10px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .stat-box i { font-size: 1.8rem; margin-bottom: 8px; }
        .stat-number { font-size: 1.6rem; font-weight: 800; color: #212529; margin-bottom: 2px; line-height: 1; }
        .stat-label { font-size: 0.75rem; color: #6c757d; margin: 0; line-height: 1.2; }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include '../includes/header.php'; ?>

    <main class="d-flex flex-grow-1 align-items-stretch">

        <input type="checkbox" id="menu-toggle" class="menu-checkbox">
        <label for="menu-toggle" class="menu-hamburguer shadow-sm">
            <span class="linha"></span>
            <span class="linha"></span>
            <span class="linha"></span>
        </label>

        <?php include '../includes/menuEmpresa.php'; ?>

        <div class="content-wrapper flex-grow-1">
            <div class="container-fluid px-4 py-3">
                
                <!-- Título da Página (Margem reduzida) -->
                <div class="mb-3">
                    <h3 class="fw-bold mb-1">Perfil da Empresa</h3>
                    <p class="text-muted small mb-0">Visualize e edite as informações da sua empresa.</p>
                </div>

                <!-- Grid Principal -->
                <div class="row g-3">
                    
                    <!-- COLUNA ESQUERDA (Maior) -->
                    <div class="col-lg-7">
                        
                        <!-- CARD 1: Informações + Sobre -->
                        <div class="card-perfil">
                            <h5 class="card-title-perfil">Informações da Empresa</h5>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="logo-grupo me-4 shadow-sm flex-shrink-0">
                                    <span class="fw-bold">GRUPO</span>
                                    <span class="fw-bold">2</span>
                                </div>
                                
                                <div>
                                    <div class="d-flex align-items-center mb-2">
                                        <strong class="me-2" style="font-size: 0.95rem;">Grupo 2</strong>
                                        <span class="badge rounded-pill" style="background-color: #cce5ff; color: #004085; font-size: 0.7rem;">
                                            <i class="bi bi-check-lg"></i> Verificada
                                        </span>
                                    </div>
                                    <div class="text-info-label">CNPJ: <span class="text-info-value">12.345.678.0001-90</span></div>
                                    <div class="text-info-label">Segmento: <span class="text-info-value">Tecnologia da Informação</span></div>
                                    <div class="text-info-label">Desde: <span class="text-info-value">20/08/2003</span></div>
                                    <div class="mt-1">
                                        <a href="#" class="text-decoration-none" style="font-size: 0.85rem; color: var(--cor-azul-principal, #0056A3);">www.grupo2.com.br</a>
                                    </div>
                                </div>
                            </div>

                            <hr style="border-color: #e9ecef; margin: 1.2rem 0;">

                            <h5 class="card-title-perfil mb-2">Sobre a Empresa</h5>
                            <p class="text-muted" style="font-size: 0.85rem; line-height: 1.5; margin-bottom: 0;">
                                O Grupo 2 é uma empresa de tecnologia especializada em desenvolver soluções inovadoras para transformação digital. Nosso propósito é conectar pessoas e tecnologias para criar um futuro melhor.
                            </p>
                        </div>

                    </div>
                    <!-- /COLUNA ESQUERDA -->

                    <!-- COLUNA DIREITA (Menor) -->
                    <div class="col-lg-5">
                        
                        <!-- CARD 2: Contato -->
                        <div class="card-perfil">
                            <h5 class="card-title-perfil">Informações de Contato</h5>
                            
                            <div class="d-flex mb-3">
                                <i class="bi bi-geo-alt icon-small me-3 mt-1"></i>
                                <div>
                                    <strong style="font-size: 0.85rem;">Endereço</strong>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem; line-height: 1.4;">Rua Berlim, 69 - Centro<br>Umuarama, PR - CEP 87501-000</p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <i class="bi bi-telephone icon-small me-3 mt-1"></i>
                                <div>
                                    <strong style="font-size: 0.85rem;">Telefone</strong>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">(44) 4002-8922</p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <i class="bi bi-envelope icon-small me-3 mt-1"></i>
                                <div>
                                    <strong style="font-size: 0.85rem;">E-mail</strong>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">contato@grupo2.com.br</p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <i class="bi bi-globe icon-small me-3 mt-1"></i>
                                <div>
                                    <strong style="font-size: 0.85rem;">Site</strong>
                                    <p class="mb-0" style="font-size: 0.85rem;"><a href="#" class="text-decoration-none" style="color: var(--cor-azul-principal, #0056A3);">www.grupo2.com.br</a></p>
                                </div>
                            </div>

                            <div class="d-flex">
                                <i class="bi bi-clock icon-small me-3 mt-1"></i>
                                <div>
                                    <strong style="font-size: 0.85rem;">Horário de Atendimento</strong>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">Segunda a Sexta, das 08h às 18h</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /COLUNA DIREITA -->

                    <!-- LINHA DE BAIXO -->
                    <!-- COLUNA ESQUERDA BAIXO -->
                    <div class="col-lg-7">
                        
                        <!-- CARD 3: Estatísticas -->
                        <div class="card-perfil">
                            <h5 class="card-title-perfil">Estatísticas da Empresa</h5>
                            
                            <div class="row g-2">
                                <div class="col-3">
                                    <div class="stat-box">
                                        <i class="bi bi-briefcase" style="color: #0056A3;"></i>
                                        <div class="stat-number">12</div>
                                        <p class="stat-label">Vagas Publicadas<br>Ativas</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="stat-box">
                                        <i class="bi bi-people" style="color: #28a745;"></i>
                                        <div class="stat-number">48</div>
                                        <p class="stat-label">Candidatos<br>Total</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="stat-box">
                                        <i class="bi bi-journal-text" style="color: #ffc107;"></i>
                                        <div class="stat-number">8</div>
                                        <p class="stat-label">Processos Seletivos<br>Em Andamento</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="stat-box">
                                        <i class="bi bi-check2-all" style="color: #d63384;"></i>
                                        <div class="stat-number">3</div>
                                        <p class="stat-label">Contratações<br>Realizadas</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!-- COLUNA DIREITA BAIXO -->
                    <div class="col-lg-5">
                        
                        <!-- CARD 4: Redes Sociais -->
                        <div class="card-perfil">
                            <h5 class="card-title-perfil">Redes Sociais</h5>
                            
                            <div class="d-flex mb-3">
                                <i class="bi bi-linkedin fs-4 me-3" style="color: #6c757d;"></i>
                                <div>
                                    <strong style="font-size: 0.85rem;">Linkedin</strong>
                                    <p class="mb-0" style="font-size: 0.85rem;"><a href="#" class="text-decoration-none" style="color: var(--cor-azul-principal, #0056A3);">linkedin.com/company/grupo2</a></p>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <i class="bi bi-instagram fs-4 me-3" style="color: #6c757d;"></i>
                                <div>
                                    <strong style="font-size: 0.85rem;">Instagram</strong>
                                    <p class="mb-0" style="font-size: 0.85rem;"><a href="#" class="text-decoration-none" style="color: var(--cor-azul-principal, #0056A3);">@grupo2.oficial</a></p>
                                </div>
                            </div>

                            <div class="d-flex">
                                <i class="bi bi-facebook fs-4 me-3" style="color: #6c757d;"></i>
                                <div>
                                    <strong style="font-size: 0.85rem;">Facebook</strong>
                                    <p class="mb-0" style="font-size: 0.85rem;"><a href="#" class="text-decoration-none" style="color: var(--cor-azul-principal, #0056A3);">facebook.com/grupo2</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>