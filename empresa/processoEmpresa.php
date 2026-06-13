<?php
// session_start();
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'empresa') {
//     header("Location: login_empresa.php");
//     exit;
// }

require_once '../classes/Painel.php';

$usuario = new Painel();

// ── Busca vagas e candidaturas da API Node.js ─────────────────────────────────
$respostaVagas       = $usuario->listarVagas();        // GET /vagas
$respostaCandidatos  = $usuario->listarCandidatos();   // GET /candidaturas

// ── Monta mapa  vagaId => quantidade de inscritos ────────────────────────────
$inscritosPorVaga = [];

if (!empty($respostaCandidatos['data']) && is_array($respostaCandidatos['data'])) {
    foreach ($respostaCandidatos['data'] as $candidatura) {
        $vagaId = $candidatura['vaga']['id'] ?? null;
        if ($vagaId !== null) {
            $inscritosPorVaga[$vagaId] = ($inscritosPorVaga[$vagaId] ?? 0) + 1;
        }
    }
}

// ── Monta a lista de processos seletivos a partir das vagas ──────────────────
$processos = [];

if (!empty($respostaVagas['data']) && is_array($respostaVagas['data'])) {
    foreach ($respostaVagas['data'] as $vaga) {
        $id = $vaga['id'] ?? null;
        if ($id === null) continue;

        $processos[] = [
            'id'             => $id,
            'titulo'         => $vaga['titulo']                     ?? 'Sem título',
            'empresa'        => $vaga['empresa']['nomeFantasia']    ?? 'Empresa',
            'localizacao'    => $vaga['localizacao']                ?? '',
            'cargaHoraria'   => $vaga['cargaHoraria']               ?? '',
            'ativa'          => $vaga['ativa']                      ?? true,
            'data_inicio'    => !empty($vaga['created_at'])
                                ? date('d/m/Y', strtotime($vaga['created_at']))
                                : date('d/m/Y'),
            'qtd_candidatos' => $inscritosPorVaga[$id] ?? 0,
        ];
    }
}

// ── Fallback: se a API estiver offline, mostra mensagem ──────────────────────
$erroApi = false;
if (is_string($respostaVagas) && str_contains($respostaVagas, 'ERRO')) {
    $erroApi = true;
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
    <title>Processo Seletivo - Portal de Estágios</title>

  
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- ══ HEADER ══ -->
    <?php include'../includes/header.php'; ?>

    <!-- ══ MAIN ══ -->
    <main class="d-flex flex-grow-1 align-items-stretch position-relative">
        <div class="bg-grafismo"></div>

        <!-- Hambúrguer -->
        <input type="checkbox" id="menu-toggle" class="menu-checkbox" hidden>
        <label for="menu-toggle" class="menu-hamburguer">
            <span class="linha"></span><span class="linha"></span><span class="linha"></span>
        </label>

        <!-- ── Sidebar ── -->
        <?php include '../includes/menuEmpresa.php'; ?>

        <!-- ── Conteúdo ── -->
        <div class="flex-grow-1 p-4 px-md-5 position-relative" style="z-index:1;">

            <!-- Saudação -->
            <div class="mb-4">
                <h2 class="fw-bold text-dark">Olá, Grupo 2</h2>
                <p class="text-muted mb-0">Acompanhe e gerencie todos os seus processos seletivos em andamento.</p>
            </div>

            <!-- Alerta se API offline -->
            <?php if ($erroApi): ?>
            <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <span>Não foi possível conectar à API Node.js. Verifique se o servidor está rodando na porta 3001.</span>
            </div>
            <?php endif; ?>

            <!-- Card da tabela -->
            <div class="bg-white border rounded-4 shadow-sm overflow-hidden">

                <!-- Cabeçalho do card -->
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h5 class="fw-bold mb-1">Processos Seletivos</h5>
                        <p class="text-muted mb-0" style="font-size:.9rem;">Visualize o andamento dos seus processos seletivos</p>
                    </div>
                    <span class="badge rounded-pill px-3 py-2" style="background-color:#e0f2fe;color:#0284c7;font-size:.85rem;">
                        <?php echo count($processos); ?> processo(s) encontrado(s)
                    </span>
                </div>

                <!-- Colunas -->
                <div class="row mx-0 px-4 py-3 tabela-header border-bottom align-items-center">
                    <div class="col-5">PROCESSO SELETIVO</div>
                    <div class="col-2">VAGA</div>
                    <div class="col-2 text-center">CANDIDATOS</div>
                    <div class="col-2 text-center">INÍCIO</div>
                    <div class="col-1 text-center">AÇÕES</div>
                </div>

                <!-- Linhas vindas da API -->
                <?php if (!empty($processos)): ?>
                    <?php foreach ($processos as $processo): ?>
                    <div class="row mx-0 px-4 py-3 align-items-center border-bottom linha-processo">

                        <!-- Processo -->
                        <div class="col-5 d-flex align-items-center gap-3">
                            <div class="icone-vaga">
                                <i class="bi bi-display text-primary fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0" style="font-size:.95rem;color:#1e293b;">
                                    <?php echo htmlspecialchars($processo['titulo']); ?>
                                </h6>
                                <small class="text-muted">
                                    <?php echo htmlspecialchars($processo['empresa']); ?>
                                    <?php if ($processo['localizacao']): ?>
                                        &nbsp;·&nbsp;<?php echo htmlspecialchars($processo['localizacao']); ?>
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>

                        <!-- Vaga / status -->
                        <div class="col-2">
                            <span class="d-block fw-semibold" style="font-size:.9rem;color:#334155;">
                                <?php echo htmlspecialchars($processo['titulo']); ?>
                            </span>
                            <span class="badge rounded-pill px-2 py-1 mt-1 <?php echo $processo['ativa'] ? 'badge-ativa' : 'badge-fechada'; ?>" style="font-size:.72rem;">
                                <?php echo $processo['ativa'] ? 'Ativa' : 'Fechada'; ?>
                            </span>
                        </div>

                        <!-- Candidatos -->
                        <div class="col-2 text-center">
                            <span class="fw-bold d-block" style="color:var(--cor-azul-principal);font-size:1.15rem;">
                                <?php echo $processo['qtd_candidatos']; ?>
                            </span>
                            <small class="text-muted">inscritos</small>
                        </div>

                        <!-- Data -->
                        <div class="col-2 text-center fw-semibold" style="color:#334155;font-size:.9rem;">
                            <?php echo htmlspecialchars($processo['data_inicio']); ?>
                        </div>

                        <!-- Ações -->
                        <div class="col-1 text-center">
                            <a href="detalhes_processo.php?id=<?php echo urlencode($processo['id']); ?>"
                               class="btn btn-outline-secondary btn-sm rounded-3 px-3"
                               style="font-size:.78rem;white-space:nowrap;">
                                Ver Detalhes
                            </a>
                        </div>

                    </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        <p class="mb-0">Nenhum processo seletivo encontrado.</p>
                    </div>
                <?php endif; ?>

            </div><!-- /card -->
        </div><!-- /conteúdo -->
    </main>

    <!-- ══ FOOTER ══ -->
    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>