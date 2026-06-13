<?php
// session_start();
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'empresa') {
//     header("Location: login_empresa.php");
//     exit; 
// }

require_once 'classes/Painel.php';

$usuario = new Painel();
$listaCandidatos = $usuario->listarCandidatos();

// Organizando os candidatos por etapa (Kanban)
$etapaTriagem = [];
$etapaEntrevista = [];
$etapaAprovados = [];

if (!empty($listaCandidatos['data']) && is_array($listaCandidatos['data'])) {
    foreach ($listaCandidatos['data'] as $cand) {
        $status = strtoupper($cand['status'] ?? 'EM_ANALISE');
        
        if ($status === 'APROVADO') {
            $etapaAprovados[] = $cand;
        } elseif ($status === 'ENTREVISTA' || $status === 'AGENDADO') {
            $etapaEntrevista[] = $cand;
        } elseif ($status !== 'REPROVADO' && $status !== 'NAO_SELECIONADO') {
            // Se não for reprovado nem aprovado/entrevista, cai na triagem inicial
            $etapaTriagem[] = $cand;
        }
    }
}
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
        
        /* Fundo customizado */
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

        /* Estilos do Kanban */
        .kanban-board {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            padding-bottom: 1rem;
            min-height: 60vh;
        }
        .kanban-col {
            min-width: 320px;
            max-width: 320px;
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
        }
        .kanban-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
        }
        .kanban-card {
            background-color: white;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .kanban-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            border-color: #cbd5e1;
        }
        
        /* Custom Scrollbar para o Kanban */
        .kanban-board::-webkit-scrollbar { height: 8px; }
        .kanban-board::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        .kanban-board::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .kanban-board::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
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
            <a href="portalDeEsagiosCandidatos.php" class="text-decoration-none px-3 d-flex align-items-center py-3"style="background-color: #f0f4f8; border-left: 4px solid var(--cor-azul-principal);">
                <img src="imagens/portal-estagio/candidatos.png" style="width: 24px;" alt="">
                <span class="ms-3 fw-bold text-muted">Candidatos</span>
            </a>

            <a href="portalDeEsagiosProcessoSeletivo.php" class="text-decoration-none px-3 d-flex align-items-center py-3" >
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

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark">Gestão do Processo Seletivo</h2>
                    <p class="text-muted mb-0">Arraste e organize os candidatos nas etapas da vaga.</p>
                </div>
                <button class="btn btn-primary d-flex align-items-center gap-2 px-4 shadow-sm" style="background-color: var(--cor-azul-principal); border: none;">
                    <i class="bi bi-funnel"></i> Filtrar por Vaga
                </button>
            </div>

            <div class="kanban-board">
                
                <div class="kanban-col">
                    <div class="kanban-header">
                        <h6 class="fw-bold mb-0 text-secondary d-flex align-items-center gap-2">
                            <i class="bi bi-inbox text-primary"></i> Em Análise / Triagem
                        </h6>
                        <span class="badge bg-secondary rounded-pill"><?= count($etapaTriagem) ?></span>
                    </div>

                    <?php foreach($etapaTriagem as $cand): 
                        $nome = $cand['aluno']['nome'] ?? 'Candidato';
                        $vaga = $cand['vaga']['titulo'] ?? 'Vaga';
                    ?>
                    <div class="kanban-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-dark border" style="font-size: 0.7rem;"><?= htmlspecialchars($vaga) ?></span>
                            <i class="bi bi-three-dots text-muted"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1 fs-6"><?= htmlspecialchars($nome) ?></h6>
                        <p class="text-muted mb-3" style="font-size: 0.8rem; line-height: 1.2;">
                            <?= htmlspecialchars($cand['aluno']['curso'] ?? 'Curso N/A') ?>
                        </p>
                        <div class="d-flex gap-2">
                            <a href="perfil_aluno.php?id=<?= $cand['aluno']['id'] ?? '' ?>" class="btn btn-sm btn-outline-primary w-100 py-1" style="font-size: 0.75rem; font-weight: 600;">Ver Perfil</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if(empty($etapaTriagem)): ?>
                        <div class="text-center text-muted p-3" style="font-size: 0.85rem;">Nenhum candidato nesta etapa.</div>
                    <?php endif; ?>
                </div>

                <div class="kanban-col">
                    <div class="kanban-header">
                        <h6 class="fw-bold mb-0 text-secondary d-flex align-items-center gap-2">
                            <i class="bi bi-calendar-event text-warning"></i> Entrevistas
                        </h6>
                        <span class="badge bg-secondary rounded-pill"><?= count($etapaEntrevista) ?></span>
                    </div>

                    <?php foreach($etapaEntrevista as $cand): 
                        $nome = $cand['aluno']['nome'] ?? 'Candidato';
                        $vaga = $cand['vaga']['titulo'] ?? 'Vaga';
                    ?>
                    <div class="kanban-card border-start border-warning border-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-dark border" style="font-size: 0.7rem;"><?= htmlspecialchars($vaga) ?></span>
                        </div>
                        <h6 class="fw-bold text-dark mb-1 fs-6"><?= htmlspecialchars($nome) ?></h6>
                        <p class="text-muted mb-3" style="font-size: 0.8rem;">
                            <i class="bi bi-clock"></i> Agendado
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-warning w-100 text-dark py-1" style="font-size: 0.75rem; font-weight: 600;">Gerenciar</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if(empty($etapaEntrevista)): ?>
                        <div class="text-center text-muted p-3" style="font-size: 0.85rem;">Nenhum candidato nesta etapa.</div>
                    <?php endif; ?>
                </div>

                <div class="kanban-col">
                    <div class="kanban-header">
                        <h6 class="fw-bold mb-0 text-secondary d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle text-success"></i> Aprovados
                        </h6>
                        <span class="badge bg-secondary rounded-pill"><?= count($etapaAprovados) ?></span>
                    </div>

                    <?php foreach($etapaAprovados as $cand): 
                        $nome = $cand['aluno']['nome'] ?? 'Candidato';
                        $vaga = $cand['vaga']['titulo'] ?? 'Vaga';
                    ?>
                    <div class="kanban-card border-start border-success border-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-dark border" style="font-size: 0.7rem;"><?= htmlspecialchars($vaga) ?></span>
                        </div>
                        <h6 class="fw-bold text-dark mb-1 fs-6"><?= htmlspecialchars($nome) ?></h6>
                        <p class="text-success fw-semibold mb-3" style="font-size: 0.8rem;">
                            Seleção Concluída
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-success w-100 py-1" style="font-size: 0.75rem; font-weight: 600;">Finalizar Contrato</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if(empty($etapaAprovados)): ?>
                        <div class="text-center text-muted p-3" style="font-size: 0.85rem;">Nenhum candidato nesta etapa.</div>
                    <?php endif; ?>
                </div>

            </div> </div>
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