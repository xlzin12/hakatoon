<?php
session_start();
// Se não tem crachá OU o crachá não for de aluno, expulsa para o login
if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: login_estudante.php");
    exit; 
}

require_once 'classes/Painel.php';

$usuario = new Painel();

// Puxa os dados da API (Candidaturas)
$listaDeCandidatos = $usuario->listarCandidatos();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylee.css">
    <title>Candidatos - Portal de Estágios</title>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <header class="d-flex justify-content-between align-items-center bg-white border-bottom shadow-sm py-2 px-4">
        <div class="d-flex align-items-center">
            <img src="imagens/logo-unialfa.png" style="width: 180px;" alt="Logo UniALFA">
            <h4 class="mx-4 mb-0 text-muted fw-bold border-start ps-4">Portal de Estágios</h4>
        </div>


    </header>

    <main class="d-flex">

        <input type="checkbox" id="menu-toggle" class="menu-checkbox">

        <label for="menu-toggle" class="menu-hamburguer shadow-sm">
            <span class="linha"></span>
            <span class="linha"></span>
            <span class="linha"></span>
        </label>

        <nav class="nav-estagios bg-white border-end" style="min-height: calc(100vh - 70px);">
            <a href="portaDeEstagiosInicio.php" class="text-decoration-none px-3 d-flex align-items-center box-inicio py-2 mt-3">
                <img src="imagens/portal-estagio/inicio.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold text-muted">Início</p>
            </a>

            <a href="portaDeEstagiosVagas.php" class="text-decoration-none px-3 d-flex my-1 align-items-center box-vagas py-2">
                <img src="imagens/portal-estagio/Vagas.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold text-muted">Vagas</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-candidatos py-2 border-start border-4 border-primary" style="background-color: #f0f0f0;">
                <img src="imagens/portal-estagio/candidatos.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold" style="color: #0056A3;">Candidatos</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-processo py-2">
                <img src="imagens/portal-estagio/processo.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold text-muted">Processo Seletivo</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-perfil py-2">
                <img src="imagens/portal-estagio/Perfil.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold text-muted">Perfil</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex align-items-center box-sair py-2 mt-auto mb-4">
                <img src="imagens/portal-estagio/Sair.png" style="width: 25px;" alt="">
               <a href="index.php" class="m-3 fw-bold nav-esagios-texto-sair">Sair</a>
            </a>
        </nav>

        <div class="section flex-grow-1 p-5 w-100 position-relative">


            <h2 class="fw-bold position-relative z-1">Olá, Grupo 2</h2>
            <p class="text-muted position-relative z-1">Acompanhe todos os candidatos que se inscreveram nas suas vagas.</p>

            <div class="bg-white border rounded shadow-sm mt-4 position-relative z-1">

                <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                    <div>
                        <h4 class="fw-bold mb-1">Todos os candidatos</h4>
                        <p class="text-muted mb-0" style="font-size: 0.95rem;">Visualize e gerencie os candidatos das suas vagas.</p>
                    </div>

                </div>

                <div class="d-flex gap-4 p-3 px-4 border-bottom">
                    <a href="#" class="text-decoration-none fw-bold d-flex align-items-center gap-2" style="color: #0056A3;">
                        <span class="px-3 py-1 rounded" style="background-color: #dbeafe;">Todos <span class="badge rounded-pill ms-1" style="background-color: #b0c4de; color: #0056A3;">48</span></span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                        Em Análise <span class="badge rounded-pill" style="background-color: #bce3e6; color: #0f5132;">9</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                        Entrevista Agendada <span class="badge rounded-pill" style="background-color: #fef3c7; color: #856404;">6</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                        Aprovados <span class="badge rounded-pill" style="background-color: #bdf6c8; color: #198754;">8</span>
                    </a>
                    <a href="#" class="text-decoration-none text-muted fw-semibold d-flex align-items-center gap-2">
                        Reprovados <span class="badge rounded-pill" style="background-color: #f8d7da; color: #dc3545;">8</span>
                    </a>
                </div>

                <div class="row mx-0 p-3 px-4 border-bottom text-muted fw-bold align-items-center" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                    <div class="col-4">CANDIDATO</div>
                    <div class="col-3">VAGA</div>
                    <div class="col-2 text-center">DATA DA CANDIDATURA</div>
                    <div class="col-2 text-center">STATUS</div>
                    <div class="col-1 text-center">AÇÕES</div>
                </div>

                <?php
                if (!empty($listaDeCandidatos['data']) && is_array($listaDeCandidatos['data'])):
                    foreach ($listaDeCandidatos['data'] as $candidato):

                        // --- Lógica para as cores do Status da Candidatura ---
                        // Ajuste a variável 'status' conforme o retorno do seu Node.js
                        $status = strtoupper($candidato['status'] ?? 'EM_ANALISE');

                        // Valores Padrão (Em Análise)
                        $corBg = '#bce3e6';
                        $corTexto = '#0d6efd';
                        $textoStatus = 'Em Análise';

                        if ($status === 'APROVADO' || $status === 'CONTRATADO') {
                            $corBg = '#bdf6c8';
                            $corTexto = '#28a745';
                            $textoStatus = 'Aprovado';
                        } elseif ($status === 'REPROVADO' || $status === 'NAO_SELECIONADO') {
                            $corBg = '#f8d7da';
                            $corTexto = '#dc3545';
                            $textoStatus = 'Reprovado';
                        } elseif ($status === 'ENTREVISTA' || $status === 'AGENDADO') {
                            $corBg = '#fef3c7';
                            $corTexto = '#ffc107';
                            $textoStatus = 'Agendado';
                        }

                        // Formatar a data (Se vier no formato do BD)
                        $dataCandidatura = '11/06/2026';
                        if (!empty($candidato['created_at'])) {
                            $dataCandidatura = date('d/m/Y', strtotime($candidato['created_at']));
                        }
                ?>

                        <div class="row mx-0 p-3 px-4 align-items-center border-bottom">

                            <div class="col-4 d-flex align-items-center">
                                <div class="rounded p-3 me-3 d-flex align-items-center justify-content-center" style=" width: 65px; height: 65px;">
                                    <img src="imagens/portal-estagio/vagas/perfil.png" alt="">
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 fs-6"><?php echo htmlspecialchars($candidato['nome_candidato'] ?? 'Candidato'); ?></h6>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem; line-height: 1.3;">
                                        <?php echo htmlspecialchars($candidato['email_candidato'] ?? 'email@exemplo.com'); ?><br>
                                        <?php echo htmlspecialchars($candidato['curso_candidato'] ?? 'Sistemas - UniALFA'); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="col-3">
                                <h6 class="fw-bold mb-1 fs-6 text-dark"><?php echo htmlspecialchars($candidato['titulo_vaga'] ?? 'Estágio'); ?></h6>
                                <p class="text-muted mb-0" style="font-size: 0.85rem;"><?php echo htmlspecialchars($candidato['empresa_vaga'] ?? 'Grupo 2'); ?></p>
                            </div>

                            <div class="col-2 text-center fw-bold text-dark" style="font-size: 0.9rem;">
                                <?php echo $dataCandidatura; ?>
                            </div>

                            <div class="col-2 text-center">
                                <span class="badge rounded-pill px-3 py-2" style="background-color: <?php echo $corBg; ?>; color: <?php echo $corTexto; ?>; font-weight: 600;">
                                    <?php echo $textoStatus; ?>
                                </span>
                            </div>

                            <div class="col-1 text-center">
                                <a href="perfil_candidato.php?id=<?php echo htmlspecialchars($candidato['id'] ?? ''); ?>" class="btn border fw-bold text-muted d-flex align-items-center justify-content-center gap-2 mx-auto text-decoration-none" style="font-size: 0.8rem; padding: 4px 10px; background-color: #fcfcfc;">
                                    <img src="imagens/portal-estagio/vagas/lapis.png" alt="">
                                    Ver Perfil
                                </a>
                            </div>
                        </div>

                    <?php
                    endforeach;
                else:
                    ?>
                    <div class="p-4 text-center text-muted">
                        <p>Nenhum candidato inscrito no momento.</p>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </main>

    <footer class="d-flex justify-content-center mt-auto py-3 border-top bg-white">
        <div class="container text-center">
            <p class="fw-bold text-muted mb-0" style="font-size: 0.85rem;">&copy; 2026 Portal de Estágios
                <span class="fw-bold" style="color: #0056A3;">UNIALFA</span>
                - Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>