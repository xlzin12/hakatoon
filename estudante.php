<?php
require_once 'Painel.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $usuario = new Painel();
    $usuario->loginEstudante($_POST['emailAcademico'], $_POST['senha']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Estudante</title>
</head>

<body>
    <header class=" d-flex justify-content-between align-items-center ">
        <img class="" src="imagens/logo-unialfa.png" style="width: 200px;" alt="logo unialfa">
        <a href="index.php" class="mx-4 link-secondary text-decoration-none fw-bold ">🡨 Voltar para página principal</a>
    </header>


    <main class="container my-3">
        <div class="row align-items-center justify-content-center gap-5">

            <div class="col-12 col-lg-5 section-empresa">
                <img src="imagens/Ícone do estudante.png" alt="Ícone da empresa" class="mb-3">
                <p class="fs-1 mb-2">Login de <br> <span class="fs-1 fw-bold " style="color: #17A2B8;">Estudante</span></p>
                <p class="text-muted">Acesse sua conta para encontar vagas de estágio, acompanhar candidaturas e impulsionar sua carreira.</p>


                <div class="publique d-flex align-items-center mb-4">
                    <img src="imagens/Encontrar Vagas.png" alt="" class="me-3">
                    <div class="publique-text">
                        <h3 class="fs-5 mb-1 fw-bold">Encontre vagas</h3>
                        <p class="mb-0 text-muted">Busque oportunidades de estágio perto de você.</p>
                    </div>
                </div>



                <div class="gerencie d-flex align-items-center mb-4">
                    <img src="imagens/Acompanhar Candidaturas.png" alt="" class="me-3">
                    <div class="publique-text">
                        <h3 class="fs-5 mb-1 fw-bold">Acompanhe candidaturas</h3>
                        <p class="mb-0 text-muted">Veja os status de suas candidaturas em tempo real.</p>
                    </div>


                </div>

                <div class="encontre d-flex align-items-center">
                    <img src="imagens/impulsione-sua-carrera.png" alt="" class="me-3">
                    <div class="publique-text">
                        <h3 class="fs-5 mb-1 fw-bold">Impulsione sua carreira</h3>
                        <p class="mb-0 text-muted">Construa seu perfil e destaque suas habilidades.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <form class="formulario text-start border shadow rounded-4 " style="max-width: 600px; margin: auto;" action="" method="POST">

                    <h2 class="text-center mb-0 fw-bold">Acesse sua conta</h2>
                    <p class="text-center text-muted mb-4">Informe seus dados para entrar no sistema.</p>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="emailAcademico">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-white">
                                <img src="imagens/Frame.png" alt="" style="width: 20px;">
                            </span>
                            <input type="email" class="form-control p-3 border-start-0" name="emailAcademicol" id="emailAcademico" placeholder="seu@email.com.br" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="senha">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-white">
                                <img src="imagens/Vector.png" alt="ícone senha" style="width: 20px;">
                            </span>
                            <input type="password" class="form-control p-3 border-start-0" name="senha" id="senha" placeholder="Sua senha" required>
                        </div>
                    </div>

                    <button type="submit" class="btn button  btn-primary w-100  p-3 mt-3 mb-4 fw-bold">
                        Entrar ➔
                    </button>

                </form>
            </div>

        </div>
    </main>
    <footer class="text-center py-3 mt-auto">
        <div class="container">
            <p class=" fw-bold  mb-0">&copy; 2026 Portal de Estágios
                <span class="fw-bold  logo-text-secun">UNI</span>
                <span class="fw-bold  logo-text-blue">ALFA</span>
                - Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>