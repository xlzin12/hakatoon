<?php
session_start();

// Proteção de rota (descomente quando o login estiver funcionando)
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'aluno') {
//     header("Location: loginEstudante.php");
//     exit;
// }

require_once '../classes/Painel.php';

$painel = new Painel();

// ── Busca vagas e candidaturas da API Node.js ─────────────────────────────────
$respostaVagas       = $painel->listarVagas();        // GET /vagas
$respostaCandidatos  = $painel->listarCandidatos();   // GET /candidaturas

// ── Nome do aluno logado (via sessão) ─────────────────────────────────────────
$nomeAluno = $_SESSION['usuario_nome'] ?? 'James';
$alunoId   = $_SESSION['usuario_id']  ?? null;

// ── Processa vagas ────────────────────────────────────────────────────────────
$vagas = [];
$erroVagas = false;

if (is_string($respostaVagas)) {
    $erroVagas = true;
} elseif (!empty($respostaVagas['data']) && is_array($respostaVagas['data'])) {
    foreach ($respostaVagas['data'] as $vaga) {
        if (!($vaga['ativa'] ?? true)) continue; // Só vagas ativas
        $vagas[] = [
            'id'           => $vaga['id']                        ?? '',
            'titulo'       => $vaga['titulo']                    ?? 'Vaga sem título',
            'empresa'      => $vaga['empresa']['nomeFantasia']   ?? 'Empresa',
            'localizacao'  => $vaga['localizacao']               ?? 'Não informado',
            'cargaHoraria' => $vaga['cargaHoraria']              ?? '',
        ];
    }
}

// ── Processa candidaturas do aluno logado ─────────────────────────────────────
$candidaturas = [];
$erroCandidaturas = false;

if (is_string($respostaCandidatos)) {
    $erroCandidaturas = true;
} elseif (!empty($respostaCandidatos['data']) && is_array($respostaCandidatos['data'])) {
    foreach ($respostaCandidatos['data'] as $cand) {
        // Se tiver sessão, filtra só as do aluno logado
        if ($alunoId && ($cand['aluno']['id'] ?? null) !== $alunoId) continue;

        $candidaturas[] = [
            'id'          => $cand['id']                       ?? '',
            'titulo'      => $cand['vaga']['titulo']           ?? 'Vaga não informada',
            'empresa'     => $cand['vaga']['empresa']['nomeFantasia'] ?? 'Empresa',
            'localizacao' => $cand['vaga']['localizacao']      ?? 'Não informado',
            'status'      => $cand['status']                   ?? 'RECEBIDO',
        ];
    }
}

// ── Mapeia status para cor e texto legível ────────────────────────────────────
function badgeStatus(string $status): array {
    return match($status) {
        'RECEBIDO'    => ['bg' => '#e0f2fe', 'cor' => '#0284c7', 'texto' => 'Recebido'],
        'EM_ANALISE'  => ['bg' => '#fef9c3', 'cor' => '#a16207', 'texto' => 'Em análise'],
        'ENTREVISTA'  => ['bg' => '#ede9fe', 'cor' => '#6d28d9', 'texto' => 'Entrevista'],
        'APROVADO'    => ['bg' => '#dcfce7', 'cor' => '#15803d', 'texto' => 'Aprovado'],
        'REPROVADO'   => ['bg' => '#fee2e2', 'cor' => '#b91c1c', 'texto' => 'Não selecionado'],
        default       => ['bg' => '#f3f4f6', 'cor' => '#6b7280', 'texto' => $status],
    };
}

// ── Ícone por modalidade/localização ─────────────────────────────────────────
function modalidade(string $localizacao): string {
    $loc = mb_strtolower($localizacao);
    if (str_contains($loc, 'remoto')) return 'Remoto';
    if (str_contains($loc, 'híbrido') || str_contains($loc, 'hibrido')) return 'Híbrido';
    return 'Presencial';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Início - Portal de Estágios</title>
    
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- ══ HEADER ══ -->
    <?php include '../includes/header.php'?>

    <!-- ══ MAIN ══ -->
    <main class="d-flex flex-grow-1 align-items-stretch">

        <!-- Hambúrguer (mobile) -->
        <input type="checkbox" id="menu-toggle" class="menu-checkbox">
        <label for="menu-toggle" class="menu-hamburguer shadow-sm">
            <span class="linha"></span>
            <span class="linha"></span>
            <span class="linha"></span>
        </label>

        <!-- ── Sidebar ── -->
       <?php include'../includes/menuEstudante.php'?>

        <!-- ── Conteúdo ── -->
        <div class="flex-grow-1 p-4 px-md-5">

            <!-- Saudação -->
            <h2 class="fw-bold mb-1">Olá, <?php echo htmlspecialchars($nomeAluno); ?>!</h2>
            <p class="text-muted mb-4">Bem-vindo ao seu portal de oportunidades.</p>

            <!-- Alerta se API offline -->
            <?php if ($erroVagas || $erroCandidaturas): ?>
            <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <span>Não foi possível conectar à API. Verifique se o servidor Node.js está rodando na porta 3001.</span>
            </div>
            <?php endif; ?>

            <!-- ── Grid: Vagas | Candidaturas ── -->
            <div class="row g-4">

                <!-- COLUNA 1: Vagas Recomendadas -->
                <div class="col-12 col-lg-6">
                    <div class="box-painel h-100">
                        <div class="box-painel-header">
                            <h6 class="fw-bold mb-0">Vagas recomendadas para você</h6>
                            <a href="vagasEstudante.php"
                               class="text-decoration-none fw-semibold"
                               style="font-size:.85rem;color:var(--cor-azul-principal,#0056A3);">
                                Ver Todas
                            </a>
                        </div>

                        <div class="p-3 d-flex flex-column gap-3">
                            <?php if (!empty($vagas)): ?>
                                <?php foreach (array_slice($vagas, 0, 5) as $vaga): ?>
                                <div class="card-vaga">
                                    <div class="icone-vaga-box">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fw-bold mb-0 text-truncate" style="font-size:.92rem;">
                                            <?php echo htmlspecialchars($vaga['titulo']); ?>
                                        </h6>
                                        <small class="text-muted d-block text-truncate">
                                            <?php echo htmlspecialchars($vaga['empresa']); ?>
                                        </small>
                                        <small class="text-muted">
                                            <?php echo htmlspecialchars($vaga['localizacao']); ?>
                                            <span class="dot-sep">•</span>
                                            <?php echo modalidade($vaga['localizacao']); ?>
                                        </small>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            <?php elseif (!$erroVagas): ?>
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-briefcase fs-2 d-block mb-2 opacity-50"></i>
                                    <p class="mb-0">Nenhuma vaga disponível no momento.</p>
                                </div>
                            <?php else: ?>
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-wifi-off fs-2 d-block mb-2 opacity-50"></i>
                                    <p class="mb-0">Erro ao carregar vagas.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- COLUNA 2: Minhas Candidaturas -->
                <div class="col-12 col-lg-6">
                    <div class="box-painel h-100">
                        <div class="box-painel-header">
                            <h6 class="fw-bold mb-0">Minhas Candidaturas</h6>
                            <a href="candidaturasEstudante.php"
                               class="text-decoration-none fw-semibold"
                               style="font-size:.85rem;color:var(--cor-azul-principal,#0056A3);">
                                Ver Todas
                            </a>
                        </div>

                        <div class="p-3 d-flex flex-column gap-3">
                            <?php if (!empty($candidaturas)): ?>
                                <?php foreach (array_slice($candidaturas, 0, 5) as $cand):
                                    $badge = badgeStatus($cand['status']);
                                ?>
                                <div class="card-vaga">
                                    <div class="icone-vaga-box">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="d-flex justify-content-between align-items-start gap-2">
                                            <h6 class="fw-bold mb-0 text-truncate" style="font-size:.92rem;">
                                                <?php echo htmlspecialchars($cand['titulo']); ?>
                                            </h6>
                                            <span class="badge-status flex-shrink-0"
                                                  style="background-color:<?php echo $badge['bg']; ?>;
                                                         color:<?php echo $badge['cor']; ?>;">
                                                <?php echo $badge['texto']; ?>
                                            </span>
                                        </div>
                                        <small class="text-muted d-block text-truncate">
                                            <?php echo htmlspecialchars($cand['empresa']); ?>
                                        </small>
                                        <small class="text-muted">
                                            <?php echo htmlspecialchars($cand['localizacao']); ?>
                                            <span class="dot-sep">•</span>
                                            <?php echo modalidade($cand['localizacao']); ?>
                                        </small>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            <?php elseif (!$erroCandidaturas): ?>
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-clipboard-x fs-2 d-block mb-2 opacity-50"></i>
                                    <p class="mb-0">Você ainda não se candidatou a nenhuma vaga.</p>
                                    <a href="vagasEstudante.php"
                                       class="btn btn-sm mt-3 fw-bold text-white"
                                       style="background-color:var(--cor-azul-claro,#17A2B8);">
                                        Explorar vagas
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-wifi-off fs-2 d-block mb-2 opacity-50"></i>
                                    <p class="mb-0">Erro ao carregar candidaturas.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div><!-- /row -->
        </div><!-- /conteúdo -->
    </main>

    <!-- ══ FOOTER ══ -->
    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
