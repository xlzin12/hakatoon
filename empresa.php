<?php
require_once 'classes/Painel.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $usuario = new painel();
    $usuario->loginEmpresa($_POST['emailCoportaivo'], $_POST['senhaHash']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Empresa</title>
</head>

<body>
    <header class=" d-flex justify-content-between align-items-center ">
        <img class="" src="imagens/logo-unialfa.png" style="width: 200px;" alt="logo unialfa">
        <a href="index.php" class="mx-4 link-secondary text-decoration-none fw-bold ">🡨 Voltar para página principal</a>
    </header>


    <main class="container my-3">
        <div class="row align-items-center justify-content-center gap-5">

            <div class="col-12 col-lg-5 section-empresa">
                <img src="imagens/Ícone da empresa.png" alt="Ícone da empresa" class="mb-3">
                <p class="fs-1 mb-2">Login de <br> <span class="fs-1 fw-bold " style="color: #0056b3;">Empresa</span></p>
                <p class="text-muted">Publique vagas, gerencie processos seletivos e encontre os melhores talentos</p>


                <div class="publique d-flex align-items-center mb-4">
                    <img src="imagens/Icones vagas.png" alt="" class="me-3">
                    <div class="publique-text">
                        <h3 class="fs-5 mb-1 fw-bold">Publique vagas</h3>
                        <p class="mb-0 text-muted">Divulgue oportunidades e alcance mais candidatos.</p>
                    </div>
                </div>

                <div class="gerencie d-flex align-items-center mb-4">
                    <img src="imagens/Icones gerenciar.png" alt="" class="me-3">
                    <div class="publique-text">
                        <h3 class="fs-5 mb-1 fw-bold">Gerencie processos</h3>
                        <p class="mb-0 text-muted">Acompanhe candidaturas e etapas seletivas.</p>
                    </div>
                </div>

                <div class="encontre d-flex align-items-center">
                    <img src="imagens/Icones talentos.png" alt="" class="me-3">
                    <div class="publique-text">
                        <h3 class="fs-5 mb-1 fw-bold">Encontre talentos</h3>
                        <p class="mb-0 text-muted">Conecte-se com os melhores profissionais.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <form class="formulario text-start border shadow rounded-4 " style="max-width: 600px; margin: auto;" action="   " method="POST">

                    <h2 class="text-center mb-0 fw-bold">Acesse sua conta</h2>
                    <p class="text-center text-muted mb-4">Informe seus dados para entrar no sistema.</p>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="emailCoportaivo">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-white">
                                <img src="imagens/Frame.png" alt="" style="width: 20px;">
                            </span>
                            <input type="email" class="form-control p-3 border-start-0" name="emailCoportaivo" id="emailCoportaivo" placeholder="seu@email.com.br" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="senhaHash">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-white">
                                <img src="imagens/Vector.png" alt="ícone senha" style="width: 20px;">
                            </span>
                            <input type="password" class="form-control p-3 border-start-0" name="senhaHash" id="senhaHash" placeholder="Sua senha" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100  p-3 mt-3 mb-4 fw-bold">
                        Entrar ➔
                    </button>

                    <div class="text-center ">
                        <a href="cadastro.php" class="mb-2 text-decoration-none border-0">Ainda não possui conta?</a>
                        <a href="#" class="btn p-3 mt-2 btn-outline-primary w-100 fw-bold">Criar conta da empresa</a>
                    </div>

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