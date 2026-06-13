<?php
// session_start();
// // Se não tem crachá OU o crachá não for de aluno, expulsa para o login
// if (!isset($_SESSION['logado']) || $_SESSION['usuario_tipo'] !== 'aluno') {
//     header("Location: login_estudante.php");
//     exit; 
// }

require_once '../classes/Painel.php';

// 1. Inicia a classe
$usuario = new Painel();

// 2. Busca a lista de alunos direto da API Node.js
$listaDeAlunos = $usuario->listarAlunos();
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

<body class="d-flex flex-column min-vh-100">
    
    <header class="d-flex justify-content-start border-bottom"> 
        <img class="" src="../imagens/logo-unialfa.png" style="width: 200px;" alt="logo unialfa">
        <a href="index.php" class="mx-4 link-secondary text-decoration-none fw-bold align-self-center">Portal de Estágios</a>
    </header>

    <main class="d-flex flex-grow-1 align-items-stretch">

        <input type="checkbox" id="menu-toggle" class="menu-checkbox">

        <label for="menu-toggle" class="menu-hamburguer shadow-sm">
            <span class="linha"></span>
            <span class="linha"></span>
            <span class="linha"></span>
        </label>

        <nav class="nav-estagios bg-white d-flex flex-column border-end">
            <a href="#" class="text-decoration-none px-3 d-flex align-items-center box-inicio py-2 mt-3" style="background-color: var(--cor-borda-clara);">
                <img src="../imagens/portal-estagio/inicio.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto mb-0">Início</p>
            </a>

            <a href="portaDeEstagiosVagas.php" class="text-decoration-none px-3 d-flex my-1 align-items-center box-vagas py-2">
                <img src="../imagens/portal-estagio/Vagas.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto mb-0">Vagas</p>
            </a>

            <a href="portalDeEsagiosCandidatos.php" class="text-decoration-none px-3 d-flex my-1 align-items-center box-candidatos py-2">
                <img src="../imagens/portal-estagio/candidatos.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto mb-0">Candidatos</p>
            </a>

            <a href="portalDeEsagiosProcessoSeletivo.php" class="text-decoration-none px-3 d-flex my-1 align-items-center box-processo py-2">
                <img src="../imagens/portal-estagio/processo.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto mb-0">Processo Seletivo</p>
            </a>

            <a href="#" class="text-decoration-none px-3 d-flex my-1 align-items-center box-perfil py-2">
                <img src="../imagens/portal-estagio/Perfil.png" style="width: 25px;" alt="">
                <p class="m-3 fw-bold nav-esagios-texto mb-0">Perfil</p>
            </a>

            <a href="index.php" class="text-decoration-none px-3 d-flex align-items-center box-sair py-2 mt-auto mb-4">
                <img src="../imagens/portal-estagio/Sair.png" style="width: 25px;" alt="">
                <span class="m-3 fw-bold nav-esagios-texto-sair ">Sair</span>
            </a>
        </nav>

        <div class="section flex-grow-1 p-4 px-md-5">
            <h2>Olá, Grupo 2</h2>
            <p>Bem-vindo ao seu painel de recrutamento.</p>

            <div class="row mt-4 flex-wrap">

                <div class="col-12 col-lg-6 mb-4">
                    <div class="box-alunos-recomendados p-4 border rounded shadow bg-white h-100">

                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                            <h5 class="fw-bold mb-0">Alunos recomendados para você</h5>
                            <a href="#" class="text-decoration-none" style="color: var(--cor-azul-logo);">Ver Todos</a>
                        </div>

                        <?php
                        if (!empty($listaDeAlunos['data']) && is_array($listaDeAlunos['data'])):
                            foreach ($listaDeAlunos['data'] as $aluno):
                        ?>

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="border rounded p-3 me-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                                            <img src="../imagens/portal-estagio/usuario.png" style="width: 35px;" alt="Foto do aluno">
                                        </div>

                                        <div>
                                            <h6 class="fw-bold mb-1 fs-5"><?php echo htmlspecialchars($aluno['nome'] ?? 'Nome não informado'); ?></h6>

                                            <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                                <?php echo htmlspecialchars($aluno['curso'] ?? 'Curso não informado'); ?> | RA: <?php echo htmlspecialchars($aluno['ra'] ?? 'N/A'); ?>
                                            </p>

                                            <div class="d-flex gap-2">
                                                <?php
                                                if (!empty($aluno['habilidades']) && is_array($aluno['habilidades'])) {
                                                    foreach ($aluno['habilidades'] as $habilidade) {
                                                        echo '<span class="badge rounded-pill text-dark border" style="background-color: #f0f0f0;">' . htmlspecialchars($habilidade) . '</span>';
                                                    }
                                                } else {
                                                    echo '<span class="badge rounded-pill text-dark border" style="background-color: #f0f0f0;">Disponível</span>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="perfil_aluno.php?id=<?php echo htmlspecialchars($aluno['id'] ?? ''); ?>" class="btn btn-primary fw-bold" style="background-color: var(--cor-azul-principal);">Ver Perfil ➔</a>
                                </div>

                            <?php
                            endforeach;
                        else:
                            ?>
                            <p class="text-muted">Nenhum aluno recomendado no momento.</p>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="col-12 col-lg-6 mb-4">
                    <div class="box-alunos-recomendados p-4 border rounded shadow bg-white h-100">

                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                            <h5 class="fw-bold mb-0">Novos Talentos</h5>
                            <a href="#" class="text-decoration-none" style="color: var(--cor-azul-logo);">Ver Todos</a>
                        </div>

                        <?php
                        if (!empty($listaDeAlunos['data']) && is_array($listaDeAlunos['data'])):
                            foreach ($listaDeAlunos['data'] as $aluno):
                        ?>

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="border rounded p-3 me-3" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                                            <img src="../imagens/portal-estagio/usuario.png" style="width: 35px;" alt="Foto do aluno">
                                        </div>

                                        <div>
                                            <h6 class="fw-bold mb-1 fs-5"><?php echo htmlspecialchars($aluno['nome'] ?? 'Nome não informado'); ?></h6>

                                            <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                                <?php echo htmlspecialchars($aluno['curso'] ?? 'Curso não informado'); ?> | RA: <?php echo htmlspecialchars($aluno['ra'] ?? 'N/A'); ?>
                                            </p>

                                            <div class="d-flex gap-2">
                                                <?php
                                                if (!empty($aluno['habilidades']) && is_array($aluno['habilidades'])) {
                                                    foreach ($aluno['habilidades'] as $habilidade) {
                                                        echo '<span class="badge rounded-pill text-dark border" style="background-color: #f0f0f0;">' . htmlspecialchars($habilidade) . '</span>';
                                                    }
                                                } else {
                                                    echo '<span class="badge rounded-pill text-dark border" style="background-color: #f0f0f0;">Disponível</span>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="perfil_aluno.php?id=<?php echo htmlspecialchars($aluno['id'] ?? ''); ?>" class="btn btn-primary fw-bold" style="background-color: var(--cor-azul-principal);">Ver Perfil ➔</a>
                                </div>

                            <?php
                            endforeach;
                        else:
                            ?>
                            <p class="text-muted">Nenhum aluno recomendado no momento.</p>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>

    </main>
    
    <footer class="d-flex justify-content-center mt-auto py-3 bg-white border-top">
        <div class="container text-center">
            <p class="fw-bold mb-0">&copy; 2026 Portal de Estágios
                <span class="fw-bold logo-text-secun">UNI</span>
                <span class="fw-bold" style="color: var(--cor-azul-logo);">ALFA</span>
                - Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>