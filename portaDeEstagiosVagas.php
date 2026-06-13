<?php
// session_start();
// // Se não tem crachá OU o crachá não for de aluno, expulsa para o login
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'aluno') {
//     header("Location: login_estudante.php");
//     exit; 
// }

require_once 'classes/Painel.php';

$usuario = new Painel();

// Puxa os dados da API (Vagas)
$listaDeVagas = $usuario->listarVagas();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Portal de Estágios</title>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    
    <header class="d-flex justify-content-start border-bottom-3 bg-white py-2" style="position: relative; z-index: 20;"> 
        <img class="" src="imagens/logo-unialfa.png" style="width: 200px;" alt="logo unialfa">
        <a href="index.php" class="mx-4 link-secondary text-decoration-none fw-bold align-self-center">Portal de Estágios</a>
    </header>

    <main class="d-flex flex-grow-1 align-items-stretch">

        <input type="checkbox" id="menu-toggle" class="menu-checkbox">

        <label for="menu-toggle" class="menu-hamburguer shadow-sm">
            <span class="linha"></span>
            <span class="linha"></span>
            <span class="linha"></span>
        </label>

        <nav class="nav-estagios bg-white d-flex flex-column shadow-sm border-end-3" style="width: 260px; z-index: 10;">
            
            <a href="portaDeEstagiosInicio.php" class="text-decoration-none px-3 d-flex align-items-center box-inicio py-2 mt-3">
                <img src="imagens/portal-estagio/inicio.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto text-muted mb-0">Início</p>
            </a>

            <a href="portaDeEstagiosVagas.php" class="text-decoration-none px-3 d-flex my-1 align-items-center box-vagas py-2" style="background-color: var(--cor-borda-clara); border-left: 4px solid var(--cor-azul-principal, #0056A3);">
                <img src="imagens/portal-estagio/Vagas.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto mb-0" style="color: var(--cor-azul-principal, #0056A3);">Vagas</p>
            </a>

            <a href="portalDeEsagiosCandidatos.php" class="text-decoration-none px-3 d-flex my-1 align-items-center box-candidatos py-2">
                <img src="imagens/portal-estagio/candidatos.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto text-muted mb-0">Candidatos</p>
            </a>

            <a href="portalDeEsagiosProcessoSeletivo.php" class="text-decoration-none px-3 d-flex my-1 align-items-center box-processo py-2">
                <img src="imagens/portal-estagio/processo.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto text-muted mb-0">Processo Seletivo</p>
            </a>

            <a class="text-decoration-none px-3 d-flex my-1 align-items-center box-perfil py-2">
                <img src="imagens/portal-estagio/Perfil.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto text-muted mb-0">Perfil</p>
            </a>

            <a href="index.php" class="text-decoration-none px-3 d-flex align-items-center box-sair py-2 mt-auto mb-4">
                <img src="imagens/portal-estagio/Sair.png" style="width: 25px;" alt="">
                <span class="mx-2 fw-bold nav-esagios-texto-sair  mb-0">Sair</span>
            </a>
        </nav>

        <div class="section flex-grow-1 p-4 px-md-5 w-100">

            <h2 class="fw-bold">Olá, Grupo 2</h2>
            <p class="text-muted">Gerencie suas vagas publicadas e acompanhe o desempenho.</p>

            <div class="bg-white border rounded shadow-sm mt-4">

                <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                    <div>
                        <h4 class="fw-bold mb-1">Vagas publicadas</h4>
                        <p class="text-muted mb-0" style="font-size: 0.95rem;">Acompanhe todas as vagas da sua empresa</p>
                    </div>
                    <button class="btn btn-primary fw-bold px-4 py-2 d-flex align-items-center gap-2" style="background-color: #0056A3; border: none; border-radius: 6px;">
                        <img src="imagens/portal-estagio/vagas/Adicionar.png" alt="" style="width: 15px;">
                        Nova Vaga
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center p-3 px-4 border-bottom">

                    <div class="d-flex flex-wrap gap-4">
                        <a href="#" class="text-decoration-none fw-bold d-flex align-items-center gap-2" style="color: #0056A3;">
                            <span class="px-2 py-1 rounded" style="background-color: #f0f4fa;">Todas</span>
                            <span class="badge rounded-pill" style="background-color: #b0c4de; color: #0056A3;">5</span>
                        </a>
                        <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                            Ativas
                            <span class="badge rounded-pill" style="background-color: #d1fae5; color: #0f5132;">5</span>
                        </a>
                        <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                            Pausadas
                            <span class="badge rounded-pill" style="background-color: #fef3c7; color: #856404;">5</span>
                        </a>
                        <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                            Encerradas
                            <span class="badge rounded-pill" style="background-color: #e2e3e5; color: #495057;">5</span>
                        </a>
                    </div>

                </div>

                <div class="row mx-0 p-3 px-4 border-bottom text-muted fw-bold align-items-center" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                    <div class="col-5">VAGA</div>
                    <div class="col-2 text-center">STATUS</div>
                    <div class="col-2 text-center">CANDIDATOS</div>
                    <div class="col-2 text-center">PUBLICADOS EM</div>
                    <div class="col-1 text-center">AÇÕES</div>
                </div>

                <?php
                if (!empty($listaDeVagas['data']) && is_array($listaDeVagas['data'])):
                    foreach ($listaDeVagas['data'] as $vaga):

                        // --- Lógica para as cores do Status ---
                        $status = strtoupper($vaga['status'] ?? 'ATIVO');
                        $corBg = '#bdf6c8';
                        $corTexto = '#28a745';
                        $textoStatus = 'Ativo'; // Padrão

                        if ($status === 'PAUSADA') {
                            $corBg = '#fff3cd';
                            $corTexto = '#ffc107';
                            $textoStatus = 'Pausada';
                        } elseif ($status === 'ENCERRADA') {
                            $corBg = '#e2e3e5';
                            $corTexto = '#495057';
                            $textoStatus = 'Encerrada';
                        }

                        // --- Formatar Data ---
                        $dataPublicacao = 'N/A';
                        if (!empty($vaga['created_at'])) {
                            $dataPublicacao = date('d/m/Y', strtotime($vaga['created_at']));
                        }
                ?>

                        <div class="row mx-0 p-3 px-4 align-items-center border-bottom">
                            <div class="col-5 d-flex align-items-center">
                                <div class="rounded p-3 me-3 d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background-color: #f8f9fa; border: 1px solid #e9ecef;">
                                    <img src="imagens/portal-estagio/vagas/icone-administacao.png" style="width: 30px;" alt="">
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 fs-5"><?php echo htmlspecialchars($vaga['titulo'] ?? 'Título não informado'); ?></h6>
                                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                        <?php echo htmlspecialchars($vaga['empresa'] ?? 'Grupo 2'); ?> <br>
                                        <?php echo htmlspecialchars($vaga['cidade'] ?? 'Local não informado'); ?> &bull;
                                        <?php echo htmlspecialchars($vaga['modalidade'] ?? 'Presencial'); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="col-2 text-center">
                                <span class="badge rounded-pill px-3 py-2" style="background-color: <?php echo $corBg; ?>; color: <?php echo $corTexto; ?>; font-weight: 500;">
                                    <?php echo $textoStatus; ?>
                                </span>
                            </div>

                            <div class="col-2 text-center">
                                <h4 class="fw-bold mb-0" style="color: #0056A3;"><?php echo htmlspecialchars($vaga['quantidade_candidatos'] ?? '0'); ?></h4>
                                <small class="text-muted fw-semibold">candidatos</small>
                            </div>

                            <div class="col-2 text-center fw-bold text-dark">
                                <?php echo $dataPublicacao; ?>
                            </div>

                            <div class="col-1 text-center">
                                <a href="editar_vaga.php?id=<?php echo htmlspecialchars($vaga['id'] ?? ''); ?>" class="btn border fw-bold text-muted d-flex align-items-center justify-content-center gap-2 mx-auto text-decoration-none shadow-sm" style="font-size: 0.85rem; padding: 6px 12px; background-color: #fcfcfc;">
                                    <img src="imagens/portal-estagio/vagas/lapis.png" style="width: 14px;" alt="">
                                    Editar
                                </a>
                            </div>
                        </div>

                    <?php
                    endforeach;
                else:
                    ?>
                    <div class="p-4 text-center text-muted">
                        <p>Nenhuma vaga publicada no momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="d-flex justify-content-center mt-auto py-3 bg-white border-top">
        <div class="container text-center">
            <p class="fw-bold mb-0 text-muted" style="font-size: 0.9rem;">&copy; 2026 Portal de Estágios
                <span class="fw-bold logo-text-secun">UNI</span>
                <span class="fw-bold" style="color: #0056A3;">ALFA</span>
                - Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>