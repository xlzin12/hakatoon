<?php
// session_start();

// // CADEADO CORRIGIDO PARA O ALUNO: Se não tem crachá OU não for aluno, expulsa para o login
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'aluno') {
//     header("Location: estudante.php");
//     exit; 
// }

require_once '../classes/Painel.php';

$usuario = new Painel();

// Puxa os dados das candidaturas do aluno no Node.js
$listaMinhasCandidaturas = $usuario->listarCandidatos(); // Ajuste para a função/rota correta se necessário
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylee.css?v=<?php echo time(); ?>">
    <title>Minhas Candidaturas - UniALFA</title>
    <style>
        /* Cor ciano/teal usada no painel do aluno */
        :root {
            --cor-aluno: #17a2b8;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <header class="d-flex align-items-center bg-white border-bottom shadow-sm py-2 px-4">
        <div class="d-flex flex-wrap align-items-center w-100">
            <a href="painelAlunoInicio.php"><img src="../imagens/logo-unialfa.png" style="width: 180px;" alt="Logo UniALFA"></a>
            <h4 class="mx-4 mb-0 text-muted fw-bold border-start ps-4">Portal de Estágios</h4>
        </div>
    </header>

    <main class="d-flex flex-grow-1">

      

        <label for="menu-toggle" class="menu-hamburguer shadow-sm">
            <span class="linha"></span>
            <span class="linha"></span>
            <span class="linha"></span>
        </label>

        <nav class="nav-estagios bg-white border-end" style="min-height: calc(100vh - 70px); width: 260px;">

            <a href="painelAlunoInicio.php" class="text-decoration-none px-3 d-flex align-items-center box-inicio py-2 mt-3">
                <img src="../imagens/poral-empresa/casa.png" alt="">
                <p class="m-3 fw-bold "  style="color: var(--cor-aluno);">Início</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-vagas py-2"style="background-color: #f0f0f0; border-color: var(--cor-aluno) !important;">
                <img src="../imagens/poral-empresa/Vagas (1).png" alt="">
                <p class="m-3 fw-bold "  style="color: var(--cor-aluno);">Vagas</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-candidatos py-2 border-start border-4" >
                <img src="../imagens/poral-empresa /Candidatura.png" alt="">
                <p class="m-3 fw-bold" style="color: var(--cor-aluno);">Candidaturas</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-perfil py-2">
                <img src="../imagens/poral-empresa/Perfil (1).png" alt="">
                <p class="m-3 fw-bold  "  style="color: var(--cor-aluno);">Perfil</p>
            </a>

            <a href="sair.php" class="text-decoration-none px-3 d-flex align-items-center box-sair py-2 mt-auto mb-4">
                <img src="../imagens/poral-empresa/Sair.png" alt="">
                <p class="m-3 fw-bold nav-esagios-texto-sair text-muted">Sair</p>
            </a>
        </nav>

        <div class="section flex-grow-1 p-5 w-100 position-relative">

            <h2 class="fw-bold position-relative z-1">Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? 'James'); ?>!</h2>
            <p class="text-muted position-relative z-1">Acompanhe o status das suas candidaturas às vagas de estágio.</p>

            <div class="bg-white border rounded shadow-sm mt-4 position-relative z-1">
                
                <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                    <div>
                        <h4 class="fw-bold mb-1">Minhas Candidaturas</h4>
                        <p class="text-muted mb-0" style="font-size: 0.95rem;">Visualize e acompanhe o andamento dos processos seletivos.</p>
                    </div>
                    
                   
                </div>

                <div class="d-flex flex-wrap gap-4 p-3 px-4 border-bottom">
                    <a href="#" class="text-decoration-none fw-bold d-flex align-items-center gap-2" style="color: var(--cor-aluno);">
                        <span class="px-3 py-1 rounded" style="background-color: #e0f6f8;">Todas <span class="badge rounded-pill ms-1" style="background-color: var(--cor-aluno); color: white;">12</span></span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                        Em Análise <span class="badge rounded-pill" style="background-color: #dbeafe; color: #0d6efd;">5</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                        Entrevista Agendada <span class="badge rounded-pill" style="background-color: #fef3c7; color: #856404;">3</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                        Não selecionado <span class="badge rounded-pill" style="background-color: #e2e3e5; color: #495057;">4</span>
                    </a>
                </div>

                <div class="row mx-0 p-3 px-4 border-bottom text-muted fw-bold align-items-center" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                    <div class="col-5">VAGA</div>
                    <div class="col-3 text-center">DATA DA CANDIDATURA</div>
                    <div class="col-2 text-center">STATUS</div>
                    <div class="col-2 text-center">AÇÕES</div>
                </div>

                <?php 
                if (!empty($listaMinhasCandidaturas['data']) && is_array($listaMinhasCandidaturas['data'])): 
                    foreach ($listaMinhasCandidaturas['data'] as $candidatura): 
                        
                        // --- Lógica para as cores do Status (Igual ao design) ---
                        $statusCandidatura = strtoupper($candidatura['status'] ?? 'EM_ANALISE');
                        
                        // Padrão: Em análise (Azul claro)
                        $corBgBadge = '#dbeafe'; $corTextoBadge = '#0d6efd'; $textoStatus = 'Em análise';
                        
                        if ($statusCandidatura === 'ENTREVISTA' || $statusCandidatura === 'AGENDADO') {
                            // Amarelo
                            $corBgBadge = '#fef3c7'; $corTextoBadge = '#ffc107'; $textoStatus = 'Entrevista Agendada';
                        } elseif ($statusCandidatura === 'REPROVADO' || $statusCandidatura === 'NAO_SELECIONADO') {
                            // Cinza
                            $corBgBadge = '#e2e3e5'; $corTextoBadge = '#495057'; $textoStatus = 'Não Selecionado';
                        }

                        // Formatar Data
                        $dataCandidatura = '11/06/2026';
                        if (!empty($candidatura['created_at'])) {
                            $dataCandidatura = date('d/m/Y', strtotime($candidatura['created_at']));
                        }
                ?>
                
                <div class="row mx-0 p-3 px-4 align-items-center border-bottom">
                    
                    <div class="col-5 d-flex align-items-center">
                        <div class="rounded p-3 me-3 d-flex align-items-center justify-content-center border" style="width: 60px; height: 60px; background-color: #f8f9fa;">
                            <img src="../imagens/poral-empresa/empresa.png" style="width: 25px;" alt="Empresa">
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 fs-6"><?php echo htmlspecialchars($candidatura['titulo_vaga'] ?? 'Estágio'); ?></h6>
                            <p class="text-muted mb-0" style="font-size: 0.85rem; line-height: 1.3;">
                                <?php echo htmlspecialchars($candidatura['empresa_vaga'] ?? 'Tech Solutions'); ?><br>
                                <?php echo htmlspecialchars($candidatura['cidade'] ?? 'Umuarama, PR'); ?> &bull; <?php echo htmlspecialchars($candidatura['modalidade'] ?? 'Híbrido'); ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-3 text-center fw-bold text-dark" style="font-size: 0.9rem;">
                        <?php echo $dataCandidatura; ?>
                    </div>
                    
                    <div class="col-2 text-center">
                        <span class="badge rounded-pill px-3 py-2" style="background-color: <?php echo $corBgBadge; ?>; color: <?php echo $corTextoBadge; ?>; font-weight: 600;">
                            <?php echo $textoStatus; ?>
                        </span>
                    </div>
                    
                    <div class="col-2 text-center">
                        <a href="detalhes_vaga.php?id=<?php echo htmlspecialchars($candidatura['vaga_id'] ?? ''); ?>" class="btn btn-outline-secondary btn-sm fw-bold px-3 py-1" style="border-radius: 6px;">
                            Ver Vaga
                        </a>
                    </div>
                </div>

                <?php 
                    endforeach; 
                else: 
                ?>
                    <div class="p-4 text-center text-muted">
                        <p>Você ainda não se candidatou a nenhuma vaga.</p>
                    </div>
                <?php endif; ?>
                

            </div>
        </div>
    </main>

    <footer class="d-flex justify-content-center mt-auto py-3 border-top bg-white">
        <div class="container text-center">
            <p class="fw-bold text-muted mb-0" style="font-size: 0.85rem;">&copy; 2026 Portal de Estágios
                <span class="fw-bold" style="color: var(--cor-aluno);">UNIALFA</span>
                - Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>