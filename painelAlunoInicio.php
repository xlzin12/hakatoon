<?php

// session_start();
// // Se não tem crachá OU o crachá não for de empresa, expulsa para o login
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'empresa') {
//     header("Location: login_empresa.php");
//     exit; 
// }




require_once 'classes/Painel.php';

$usuario = new Painel();

// Aqui você puxa os dados da sua API Node.js
// IMPORTANTE: Certifique-se de que tem estas funções no seu Painel.php!
$listaVagasRecomendadas = $usuario->listarVagas(); // Usa a listagem de vagas normal
$listaMinhasCandidaturas = $usuario->listarCandidatos(); // Pode ser uma rota específica tipo /minhas-candidaturas
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/stylee.css">
    <title>Portal do Aluno - UniALFA</title>
    <style>
        /* Cor ciano/teal usada no painel do aluno */
        :root {
            --cor-aluno: #17a2b8;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <header class="d-flex  align-items-center bg-white border-bottom shadow-sm py-2 px-4">
        <div class="d-flex  flex-wrap align-items-center w-100">
            <a href="painelAlunoInicio.php"><img src="imagens/logo-unialfa.png" style="width: 180px;" alt="Logo UniALFA"></a>
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

            <a href="#" class="text-decoration-none px-3 d-flex align-items-center box-inicio py-2 mt-3 border-start border-4" style="background-color: #f0f0f0; border-color: var(--cor-aluno) !important;">
                <img src="imagens/poral-empresa/casa.png" alt="">
                <p class="m-3 fw-bold" style="color: var(--cor-aluno);">Início</p>
            </a>

            <a href="painelAlunoVagas.php" class="text-decoration-none px-3 d-flex my-1 align-items-center box-vagas py-2">
                <img src="imagens/poral-empresa/Vagas (1).png" alt="">
                <p class="m-3 fw-bold " style="color: var(--cor-aluno);">Vagas</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-candidatos py-2">
                <img src="imagens/poral-empresa/Candidatura.png" alt="">
                <p class="m-3 fw-bold " style="color: var(--cor-aluno);">Candidaturas</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-perfil py-2">
                <img src="imagens/poral-empresa/Perfil (1).png" alt="">
                <p class="m-3 fw-bold " style="color: var(--cor-aluno);">Perfil</p>
            </a>

            <a href="sair.php" class="text-decoration-none px-3 d-flex align-items-center box-sair py-2 mt-auto mb-4">
                <img src="imagens/poral-empresa/Sair.png" alt="">
                <p class="m-3 fw-bold nav-esagios-texto-sair text-muted">Sair</p>
            </a>
        </nav>

        <div class="section flex-grow-1 p-5 w-100">

            <h2 class="fw-bold">Olá, James!</h2>
            <p class="text-muted">Bem-vindo ao seu portal de oportunidades.</p>

            <div class="row mt-5">

                <div class="col-12 col-xl-6 mb-4">
                    <div class="bg-white border rounded shadow-sm p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                            <h6 class="fw-bold mb-0">Vagas recomendadas para você</h6>
                            <a href="#" class="text-decoration-none" style="color: var(--cor-aluno); font-size: 0.9rem;">Ver Todas</a>
                        </div>

                        <?php
                        if (!empty($listaVagasRecomendadas['data']) && is_array($listaVagasRecomendadas['data'])):
                            foreach (array_slice($listaVagasRecomendadas['data'], 0, 3) as $vaga): // Mostra só as 3 primeiras
                        ?>
                                <div class="d-flex felx-wrap align-items-center justify-content-between mb-4 pb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="border rounded p-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <img src="imagens/poral-empresa/empresa.png" alt="">
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1" style="font-size: 0.95rem;"><?php echo htmlspecialchars($vaga['titulo'] ?? 'Vaga'); ?></h6>
                                            <p class="text-muted mb-0" style="font-size: 0.8rem;">
                                                <?php echo htmlspecialchars($vaga['empresa'] ?? 'Empresa'); ?><br>
                                                <?php echo htmlspecialchars($vaga['cidade'] ?? 'Local'); ?> &bull; <?php echo htmlspecialchars($vaga['modalidade'] ?? 'Presencial'); ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            <?php
                            endforeach;
                        else:
                            ?>
                            <p class="text-muted text-center mt-4">Nenhuma vaga recomendada.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-12 col-xl-6 mb-4">
                    <div class="bg-white border rounded shadow-sm p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                            <h6 class="fw-bold mb-0">Minhas Candidaturas</h6>
                            <a href="#" class="text-decoration-none" style="color: var(--cor-aluno); font-size: 0.9rem;">Ver Todas</a>
                        </div>

                        <?php
                        if (!empty($listaMinhasCandidaturas['data']) && is_array($listaMinhasCandidaturas['data'])):
                            foreach (array_slice($listaMinhasCandidaturas['data'], 0, 3) as $candidatura):

                                // Lógica de cores do status da imagem
                                $statusCandidatura = strtoupper($candidatura['status'] ?? 'EM_ANALISE');
                                $corBgBadge = '#bce3e6';
                                $corTextoBadge = '#0d6efd';
                                $textoStatus = 'Em análise';

                                if ($statusCandidatura === 'ENTREVISTA' || $statusCandidatura === 'AGENDADO') {
                                    $corBgBadge = '#fef3c7';
                                    $corTextoBadge = '#ffc107';
                                    $textoStatus = 'Entrevista';
                                } elseif ($statusCandidatura === 'REPROVADO' || $statusCandidatura === 'NAO_SELECIONADO') {
                                    $corBgBadge = '#e2e3e5';
                                    $corTextoBadge = '#495057';
                                    $textoStatus = 'Não selecionado';
                                }
                        ?>
                                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="border rounded p-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <img src="imagens/poral-empresa/empresa.png" alt="">
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1" style="font-size: 0.95rem;"><?php echo htmlspecialchars($candidatura['titulo_vaga'] ?? 'Vaga'); ?></h6>
                                            <p class="text-muted mb-0" style="font-size: 0.8rem;">
                                                <?php echo htmlspecialchars($candidatura['empresa_vaga'] ?? 'Empresa'); ?><br>
                                                <?php echo htmlspecialchars($candidatura['cidade'] ?? 'Local'); ?> &bull; <?php echo htmlspecialchars($candidatura['modalidade'] ?? 'Presencial'); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <span class="badge rounded-pill px-3 py-1" style="background-color: <?php echo $corBgBadge; ?>; color: <?php echo $corTextoBadge; ?>; font-weight: 600; font-size: 0.75rem;">
                                        <?php echo $textoStatus; ?>
                                    </span>
                                </div>
                            <?php
                            endforeach;
                        else:
                            ?>
                            <p class="text-muted text-center mt-4">Nenhuma candidatura encontrada.</p>
                        <?php endif; ?>
                    </div>
                </div>

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