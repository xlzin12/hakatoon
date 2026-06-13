<?php
// session_start();
// include '../config/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil da Empresa - Portal de Estágios</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <div class="d-flex" id="wrapper">
        
        <div id="sidebar-wrapper" class="shadow">
            <div class="sidebar-heading text-center">
                <img src="../assets/imagens/logo-unialfa.png" alt="Logo Unialfa" class="img-fluid logo-sidebar">
            </div>
            
            <div class="list-group list-group-flush my-4">
                <a href="inicioEmpresa.php" class="list-group-item list-group-item-action bg-transparent">
                    <img src="../assets/imagens/poral-empresa/casa.png" alt="Início" class="menu-icon"> Início
                </a>
                <a href="vagasEmpresa.php" class="list-group-item list-group-item-action bg-transparent">
                    <img src="../assets/imagens/poral-empresa/Vagas (1).png" alt="Vagas" class="menu-icon"> Vagas
                </a>
                <a href="candidatosEmpresa.php" class="list-group-item list-group-item-action bg-transparent">
                    <img src="../assets/imagens/poral-empresa/Candidatura.png" alt="Candidaturas" class="menu-icon"> Candidaturas
                </a>
                <a href="processoEmpresa.php" class="list-group-item list-group-item-action bg-transparent">
                    <i class="bi bi-journal-check menu-icon-bi"></i> Processo Seletivo
                </a>
                <a href="perfilEmpresa.php" class="list-group-item list-group-item-action active-blue">
                    <img src="../assets/imagens/poral-empresa/Perfil (1).png" alt="Perfil" class="menu-icon"> Perfil
                </a>
                
                <a href="../index.php" class="list-group-item list-group-item-action bg-transparent text-danger mt-auto explicit-exit">
                    <img src="../assets/imagens/poral-empresa/Sair.png" alt="Sair" class="menu-icon"> Sair
                </a>
            </div>
        </div>
        <div id="page-content-wrapper" class="w-100">
            
            <div class="container-fluid px-4 py-4">
                <div class="row">
                    <div class="col-12">
                        <h2 class="fw-bold text-dark mb-4 text-blue-title">Meu Perfil</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xxl-10">
                        <div class="card card-profile shadow-sm border-0">
                            <div class="card-body p-5">
                                
                                <form action="atualizarPerfil.php" method="POST">
                                    
                                    <div class="text-center mb-5">
                                        <div class="avatar-upload position-relative d-inline-block">
                                            <div class="avatar-preview">
                                                <img src="../assets/imagens/Ícone da empresa.png" alt="Logo da Empresa" id="imagePreview">
                                            </div>
                                            <label for="imageUpload" class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center btn-camera">
                                                <i class="bi bi-camera-fill"></i>
                                            </label>
                                            <input type="file" id="imageUpload" name="logoEmpresa" accept=".png, .jpg, .jpeg" class="d-none">
                                        </div>
                                        <h4 class="fw-bold mt-2 text-dark">Dados Corporativos</h4>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="razaoSocial" class="form-label">Razão Social</label>
                                            <input type="text" class="form-control" id="razaoSocial" name="razaoSocial" placeholder="Razão Social da Empresa" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="nomeFantasia" class="form-label">Nome Fantasia</label>
                                            <input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia" placeholder="Nome Fantasia / Marca" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="cnpj" class="form-label">CNPJ</label>
                                            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="00.000.000/0001-00" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">E-mail de Contato</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@empresa.com" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="telefone" class="form-label">Telefone / Comercial</label>
                                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="site" class="form-label">Website / LinkedIn</label>
                                            <input type="url" class="form-control" id="site" name="site" placeholder="https://suaempresa.com.br">
                                        </div>

                                        <div class="col-12">
                                            <label for="descricao" class="form-label">Descrição da Empresa</label>
                                            <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Fale brevemente sobre o foco de atuação da empresa e mercado..."></textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-3 mt-5">
                                        <button type="button" class="btn btn-outline-secondary px-4 py-2 fw-semibold btn-cancel">Descartar</button>
                                        <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold btn-save-profile shadow-sm">Salvar Alterações</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>