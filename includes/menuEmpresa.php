<?php
// Descobre o nome do arquivo que está sendo acessado no momento
$paginaAtual = basename($_SERVER['PHP_SELF']);
?>

<nav class="nav-estagios bg-white d-flex flex-column border-end-3" style="width: 260px;">

    <!-- Início -->
    <a href="inicioEmpresa.php" class="text-decoration-none px-3 d-flex align-items-center py-2 mt-3 <?= ($paginaAtual == 'inicioEmpresa.php') ? 'ativo' : '' ?>">
        <img src="../assets/imagens/portal-estagio/inicio.png" alt="">
        <p class="mb-0 ms-3 fw-bold nav-esagios-texto <?= ($paginaAtual != 'inicioEmpresa.php') ? 'text-muted' : '' ?>">Início</p>
    </a>

    <!-- Vagas -->
    <a href="vagasEmpresa.php" class="text-decoration-none px-3 d-flex my-1 align-items-center py-2 <?= ($paginaAtual == 'vagasEmpresa.php') ? 'ativo' : '' ?>">
        <img src="../assets/imagens/portal-estagio/Vagas.png" alt="">
        <p class="mb-0 ms-3 fw-bold nav-esagios-texto <?= ($paginaAtual != 'vagasEmpresa.php') ? 'text-muted' : '' ?>">Vagas</p>
    </a>

    <!-- Candidatos -->
    <a href="candidatosEmpresa.php" class="text-decoration-none px-3 d-flex my-1 align-items-center py-2 <?= ($paginaAtual == 'candidatosEmpresa.php') ? 'ativo' : '' ?>">
        <img src="../assets/imagens/portal-estagio/candidatos.png" alt="">
        <p class="mb-0 ms-3 fw-bold nav-esagios-texto <?= ($paginaAtual != 'candidatosEmpresa.php') ? 'text-muted' : '' ?>">Candidatos</p>
    </a>

    <!-- Processo Seletivo -->
    <a href="processoEmpresa.php" class="text-decoration-none px-3 d-flex my-1 align-items-center py-2 <?= ($paginaAtual == 'processoEmpresa.php') ? 'ativo' : '' ?>">
        <img src="../assets/imagens/portal-estagio/processo.png" alt="">
        <p class="mb-0 ms-3 fw-bold nav-esagios-texto <?= ($paginaAtual != 'processoEmpresa.php') ? 'text-muted' : '' ?>">Processo Seletivo</p>
    </a>

    <!-- Perfil -->
    <a href="perfilEmpresa.php" class="text-decoration-none px-3 d-flex my-1 align-items-center py-2 <?= ($paginaAtual == 'perfilEmpresa.php') ? 'ativo' : '' ?>">
        <img src="../assets/imagens/portal-estagio/Perfil.png" alt="">
        <p class="mb-0 ms-3 fw-bold nav-esagios-texto <?= ($paginaAtual != 'perfilEmpresa.php') ? 'text-muted' : '' ?>">Perfil</p>
    </a>

    <!-- Sair -->
    <a href="../index.php" class="text-decoration-none px-3 d-flex align-items-center py-2 mt-auto mb-4">
        <img src="../assets/imagens/portal-estagio/Sair.png" alt="">
        <span class="mb-0 ms-3 fw-bold nav-esagios-texto-sair text-muted">Sair</span>
    </a>

</nav>