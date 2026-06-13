<?php
// session_start();
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'empresa') {
//     header("Location: login_empresa.php");
//     exit; 
// }

require_once 'classes/Painel.php';

$usuario = new Painel();

// Buscando os dados reais da sua API Node.js (rota /candidaturas)
$listaCandidatos = $usuario->listarCandidatos();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Candidatos - Portal de Estágios</title>
    <style>
        :root {
            --cor-azul-principal: #0056A3;
            --cor-borda-clara: #f0f4fa;
        }
        
        /* Cores personalizadas dos Status baseadas na imagem */
        .status-aprovado { background-color: #d1fae5; color: #10b981; }
        .status-reprovado { background-color: #ffe4e6; color: #f43f5e; }
        .status-agendado { background-color: #fef3c7; color: #f59e0b; }
        .status-analise { background-color: #e0f2fe; color: #0ea5e9; }
        .status-badge-count { background-color: #e2e8f0; color: #64748b; font-size: 0.75rem; }
        .status-badge-count-active { background-color: #93c5fd; color: #1e3a8a; font-size: 0.75rem; }
        
        /* Fundo customizado (detalhe azul no topo direito) */
        .bg-grafismo {
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 200px;
            background: radial-gradient(circle at top right, #17a2b8 0%, transparent 70%);
            opacity: 0.2;
            z-index: 0;
            pointer-events: none;
        }

        .pagination .page-link {
            color: #64748b;
            border: none;
            margin: 0 2px;
            border-radius: 6px;
        }
        .pagination .page-item.active .page-link {
            background-color: var(--cor-azul-principal);
            color: white;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <header class="d-flex justify-content-between align-items-center border-bottom-3 bg-white py-2 px-4" style="position: relative; z-index: 20;"> 
        <div class="d-flex align-items-center">
            <img src="imagens/logo-unialfa.png" style="width: 180px;" alt="Logo UniALFA">
            <h4 class="mx-4 mb-0 text-muted fw-bold border-start ps-4" style="font-size: 1.2rem;">Portal de Estágios</h4>
        </div>
        <div class="position-relative me-3">
            <i class="bi bi-bell fs-4 text-secondary"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 0.6rem;">
                2
            </span>
        </div>
    </header>
<?php
// session_start();
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'empresa') {
//     header("Location: login_empresa.php");
//     exit; 
// }

require_once 'classes/Painel.php';

$usuario = new Painel();

// Simulação dos dados de Processos Seletivos (Como viria da sua API Node.js)
$listaProcessos = [
    [
        'id' => 1,
        'curso' => 'Tecnologia em Sistemas para Internet',
        'turma' => '3º Período',
        'codigo' => '#TSI2026',
        'vaga' => 'Estágio em Desenvolvimento Web',
        'qtd_candidatos' => 15,
        'data_inicio' => '10/06/2026'
    ],
    [
        'id' => 2,
        'curso' => 'Administração',
        'turma' => '4º Período',
        'codigo' => '#ADM2026',
        'vaga' => 'Estágio em Auxiliar Administrativo',
        'qtd_candidatos' => 8,
        'data_inicio' => '12/06/2026'
    ],
    [
        'id' => 3,
        'curso' => 'Design Gráfico',
        'turma' => '2º Período',
        'codigo' => '#DSG2026',
        'vaga' => 'Estágio em UX/UI Design',
        'qtd_candidatos' => 23,
        'data_inicio' => '15/06/2026'
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Processo Seletivo - Portal de Estágios</title>
    <style>
        :root {
            --cor-azul-principal: #0056A3;
            --cor-borda-clara: #f0f4fa;
        }
        
        /* Fundo customizado (detalhe azul no topo direito) */
        .bg-grafismo {
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 200px;
            background: radial-gradient(circle at top right, #17a2b8 0%, transparent 70%);
            opacity: 0.15;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <header class="d-flex justify-content-between align-items-center border-bottom bg-white py-2 px-4" style="position: relative; z-index: 20;"> 
        <div class="d-flex align-items-center">
            <img src="imagens/logo-unialfa.png" style="width: 180px;" alt="Logo UniALFA">
            <h4 class="mx-4 mb-0 text-muted fw-bold border-start ps-4" style="font-size: 1.2rem;">Portal de Estágios</h4>
        </div>
        <div class="position-relative me-3">
            <i class="bi bi-bell fs-4 text-secondary"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 0.6rem;">2</span>
        </div>
    </header>

    <main class="d-flex flex-grow-1 align-items-stretch position-relative">
        <div class="bg-grafismo"></div>

        <input type="checkbox" id="menu-toggle" class="menu-checkbox" hidden>
        <label for="menu-toggle" class="menu-hamburguer shadow-sm d-md-none">
            <span class="linha"></span><span class="linha"></span><span class="linha"></span>
        </label>

        <nav class="nav-estagios bg-white d-flex flex-column shadow-sm border-end" style="width: 260px; z-index: 10;">
            <a href="portaDeEstagiosInicio.php" class="text-decoration-none px-3 d-flex align-items-center py-3 mt-2">
                <img src="imagens/portal-estagio/inicio.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Início</span>
            </a>
            <a href="portaDeEstagiosVagas.php" class="text-decoration-none px-3 d-flex align-items-center py-3">
                <img src="imagens/portal-estagio/Vagas.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Vagas</span>
            </a>
            <a href="portalDeEsagiosCandidatos.php" class="text-decoration-none px-3 d-flex align-items-center py-3">
                <img src="imagens/portal-estagio/candidatos.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Candidatos</span>
            </a>

            <a href="portalDeEsagiosProcessoSeletivo.php" class="text-decoration-none px-3 d-flex align-items-center py-3" style="background-color: #f0f4f8; border-left: 4px solid var(--cor-azul-principal);">
                <img src="imagens/portal-estagio/processo.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold" style="color: var(--cor-azul-principal);">Processo Seletivo</span>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex align-items-center py-3">
                <img src="imagens/portal-estagio/Perfil.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Perfil</span>
            </a>
            
            <a href="index.php" class="text-decoration-none px-3 d-flex align-items-center py-3 mt-auto mb-3">
                <img src="imagens/portal-estagio/Sair.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-secondary">Sair</span>
            </a>
        </nav>

        <div class="section flex-grow-1 p-4 px-md-5 w-100 position-relative z-1">

            <div class="mb-4">
                <h2 class="fw-bold text-dark">Processos Seletivos</h2>
                <p class="text-muted">Acompanhe e gerencie os processos seletivos abertos para suas vagas.</p>
            </div>

            <div class="bg-white border rounded-4 shadow-sm overflow-hidden">
                
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Listagem de Processos</h5>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Visão geral de vagas e candidatos.</p>
                    </div>
                    <div class="input-group" style="max-width: 300px;">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Buscar por curso ou código...">
                    </div>
                </div>

                <div class="row mx-0 p-3 px-4 border-bottom text-muted fw-bold align-items-center bg-light" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                    <div class="col-4">PROCESSO SELETIVO</div>
                    <div class="col-3">VAGA</div>
                    <div class="col-2 text-center">CANDIDATOS</div>
                    <div class="col-1 text-center">INÍCIO</div>
                    <div class="col-2 text-center">AÇÕES</div>
                </div>

                <?php if (!empty($listaProcessos)): ?>
                    <?php foreach ($listaProcessos as $processo): ?>
                        <div class="row mx-0 p-3 px-4 align-items-center border-bottom table-hover-custom">
                            
                            <div class="col-4 d-flex align-items-center">
                                <div class="rounded p-2 me-3 d-flex align-items-center justify-content-center border" style="width: 50px; height: 50px; background-color: #f8fafc;">
                                    <i class="bi bi-folder2-open text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;"><?php echo htmlspecialchars($processo['curso']); ?></h6>
                                    <small class="text-muted d-block mt-1">
                                        <i class="bi bi-people-fill me-1"></i> <?php echo htmlspecialchars($processo['turma']); ?> &nbsp;|&nbsp; 
                                        <span class="text-primary fw-semibold"><?php echo htmlspecialchars($processo['codigo']); ?></span>
                                    </small>
                                </div>
                            </div>

                            <div class="col-3">
                                <span class="d-block fw-semibold text-dark" style="font-size: 0.9rem;">
                                    <?php echo htmlspecialchars($processo['vaga']); ?>
                                </span>
                            </div>

                            <div class="col-2 text-center">
                                <span class="badge rounded-pill px-3 py-2" style="background-color: #e0f2fe; color: #0284c7; font-weight: 600; font-size: 0.85rem;">
                                    <i class="bi bi-person-lines-fill me-1"></i> <?php echo $processo['qtd_candidatos']; ?> candidatos
                                </span>
                            </div>

                            <div class="col-1 text-center fw-bold text-dark" style="font-size: 0.9rem;">
                                <?php echo htmlspecialchars($processo['data_inicio']); ?>
                            </div>

                            <div class="col-2 text-center">
                                <a href="detalhes_processo.php?id=<?php echo $processo['id']; ?>" class="btn btn-outline-primary btn-sm fw-bold px-3 py-1 rounded-3" style="font-size: 0.8rem;">
                                    Ver Detalhes
                                </a>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        <p>Nenhum processo seletivo em andamento.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </main>

    <footer class="d-flex justify-content-center mt-auto py-3 bg-white border-top z-1 position-relative">
        <div class="container text-center">
            <p class="fw-bold text-muted mb-0" style="font-size: 0.9rem;">&copy; 2026 Portal de Estágios
                <span class="fw-bold logo-text-secun">UNI</span>
                <span class="fw-bold" style="color: var(--cor-azul-logo, #0056A3);">ALFA</span>
                - Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Pequeno efeito ao passar o mouse na linha da tabela */
        .table-hover-custom { transition: background-color 0.2s; }
        .table-hover-custom:hover { background-color: #f8fafc; }
    </style>
</body>
</html>
    <main class="d-flex flex-grow-1 align-items-stretch position-relative">
      
        
        <input type="checkbox" id="menu-toggle" class="menu-checkbox" hidden>
        <label for="menu-toggle" class="menu-hamburguer shadow-sm d-md-none">
            <span class="linha"></span><span class="linha"></span><span class="linha"></span>
        </label>

        <nav class="nav-estagios bg-white d-flex flex-column shadow-sm border-end-3" style="width: 260px; z-index: 10;">
            
            <a href="portaDeEstagiosInicio.php" class="text-decoration-none px-3 d-flex align-items-center py-3 mt-2">
                <img src="imagens/portal-estagio/inicio.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Início</span>
            </a>

            <a href="portaDeEstagiosVagas.php" class="text-decoration-none px-3 d-flex align-items-center py-3">
                <img src="imagens/portal-estagio/Vagas.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Vagas</span>
            </a>

            <a href="portalDeEsagiosCandidatos.php" class="text-decoration-none px-3 d-flex align-items-center py-3" style="background-color: #f0f4f8; border-left: 4px solid var(--cor-azul-principal);">
                <img src="imagens/portal-estagio/candidatos.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold" style="color: var(--cor-azul-principal);">Candidatos</span>
            </a>

            <a href="portalDeEsagiosProcessoSeletivo.php" class="text-decoration-none px-3 d-flex align-items-center py-3">
                <img src="imagens/portal-estagio/processo.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Processo Seletivo</span>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex align-items-center py-3">
                <img src="imagens/portal-estagio/Perfil.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Perfil</span>
            </a>

            <a href="index.php" class="text-decoration-none px-3 d-flex align-items-center py-3 mt-auto mb-3">
                <img src="imagens/portal-estagio/Sair.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-secondary">Sair</span>
            </a>
        </nav>

        <div class="section flex-grow-1 p-4 px-md-5 w-100 position-relative z-1">

            <div class="mb-4">
                <h2 class="fw-bold text-dark">Olá, Grupo 2</h2>
                <p class="text-muted">Acompanhe todos os candidatos que se inscreveram nas suas vagas.</p>
            </div>

            <div class="bg-white border rounded-4 shadow-sm">
                
                <div class="p-4 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <h5 class="fw-bold mb-1">Todos os candidatos</h5>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Visualize e gerencie os candidatos das suas vagas.</p>
                        </div>
                        
                       
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-4 p-3 px-4 border-bottom">
                    <a href="#" class="text-decoration-none fw-bold d-flex align-items-center gap-2 p-2 rounded" style="background-color: #e0f2fe; color: #0ea5e9;">
                        Todos <span class="badge rounded-pill status-badge-count-active">0</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2 p-2">
                        Em Análise <span class="badge rounded-pill status-badge-count">0</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2 p-2">
                        Entrevista Agendada <span class="badge rounded-pill status-badge-count">0</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2 p-2">
                        Aprovados <span class="badge rounded-pill status-badge-count">0</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2 p-2">
                        Reprovados <span class="badge rounded-pill status-badge-count">0</span>
                    </a>
                </div>

                <div class="row mx-0 p-3 px-4 border-bottom text-muted fw-bold align-items-center" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                    <div class="col-4">CANDIDATO</div>
                    <div class="col-3">VAGA</div>
                    <div class="col-2 text-center">DATA DA CANDIDATURA</div>
                    <div class="col-2 text-center">STATUS</div>
                    <div class="col-1 text-center">AÇÕES</div>
                </div>

                <?php if (!empty($listaCandidatos['data']) && is_array($listaCandidatos['data'])): ?>
                    <?php foreach ($listaCandidatos['data'] as $candidatura): 
                        
                        $idAluno = $candidatura['aluno']['id'] ?? '';
                        $nomeAluno = $candidatura['aluno']['nome'] ?? 'Candidato Oculto';
                        $emailAluno = $candidatura['aluno']['emailAcademico'] ?? 'Sem e-mail';
                        $cursoAluno = $candidatura['aluno']['curso'] ?? 'Curso não informado';
                        
                        $tituloVaga = $candidatura['vaga']['titulo'] ?? 'Vaga Geral';

                        // Formatando a Data
                        $dataCandidatura = 'N/A';
                        if (!empty($candidatura['created_at'])) {
                            $dataCandidatura = date('d/m/Y', strtotime($candidatura['created_at']));
                        }

                        // Lógica de Cores e Nomenclatura dos Status
                        $statusBruto = strtoupper($candidatura['status'] ?? 'EM_ANALISE');
                        $classeStatus = 'status-analise';
                        $statusExibicao = 'Em Análise';

                        if ($statusBruto === 'APROVADO') {
                            $classeStatus = 'status-aprovado';
                            $statusExibicao = 'Aprovado';
                        } elseif ($statusBruto === 'REPROVADO' || $statusBruto === 'NAO_SELECIONADO') {
                            $classeStatus = 'status-reprovado';
                            $statusExibicao = 'Reprovado';
                        } elseif ($statusBruto === 'AGENDADO' || $statusBruto === 'ENTREVISTA') {
                            $classeStatus = 'status-agendado';
                            $statusExibicao = 'Entrevista Agendada';
                        }
                    ?>
                    
                        <div class="row mx-0 p-3 px-4 align-items-center border-bottom">
                            <div class="col-4 d-flex align-items-center">
                                <div class="rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background-color: #e2e8f0;">
                                    <i class="bi bi-person-fill" style="font-size: 2rem; color: #64748b;"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 fs-6 text-dark"><?php echo htmlspecialchars($nomeAluno); ?></h6>
                                    <small class="text-muted d-block"><?php echo htmlspecialchars($emailAluno); ?></small>
                                    <small class="text-muted"><?php echo htmlspecialchars($cursoAluno); ?> - UniALFA</small>
                                </div>
                            </div>

                            <div class="col-3">
                                <h6 class="fw-semibold mb-0 text-dark" style="font-size: 0.95rem;"><?php echo htmlspecialchars($tituloVaga); ?></h6>
                                <small class="text-muted">ID Vaga: #<?php echo htmlspecialchars($candidatura['vaga']['id'] ?? 'N/A'); ?></small>
                            </div>

                            <div class="col-2 text-center fw-bold text-dark" style="font-size: 0.9rem;">
                                <?php echo $dataCandidatura; ?>
                            </div>

                            <div class="col-2 text-center">
                                <span class="badge rounded-pill px-3 py-2 <?php echo $classeStatus; ?>" style="font-weight: 600;">
                                    <?php echo $statusExibicao; ?>
                                </span>
                            </div>

                            <div class="col-1 text-center">
                                <a href="perfil_aluno.php?id=<?php echo urlencode($idAluno); ?>" class="btn btn-light btn-sm fw-bold text-muted border d-flex align-items-center justify-content-center gap-2 py-1 px-3 rounded-3" style="font-size: 0.8rem;">
                                    <i class="bi bi-pencil" style="font-size: 0.75rem;"></i> Perfil
                                </a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-5 text-center text-muted">
                        <p><i class="bi bi-inbox fs-1 d-block mb-2"></i>Nenhum candidato encontrado no momento.</p>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-white rounded-bottom-4">
                    <span class="text-muted" style="font-size: 0.9rem;">Gerenciador de Candidatos</span>
                    
            
                </div>

            </div>
        </div>
    </main>

    <footer class="d-flex justify-content-center mt-auto py-3 bg-white border-top z-1 position-relative">
        <div class="container text-center">
            <p class="fw-bold text-muted mb-0" style="font-size: 0.9rem;">&copy; 2026 Portal de Estágios
                <span class="fw-bold logo-text-secun">UNI</span>
                <span class="fw-bold" style="color: var(--cor-azul-logo, #0056A3);">ALFA</span>
                - Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>