<?php
// Se o usuário já estiver logado, manda ele direto para o painel dele
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    if ($_SESSION['usuario_tipo'] === 'aluno') {
        header("Location: painel_aluno.php");
    } else {
        header("Location: portaDeEstagiosInicio.php");
    }
    exit;
}
require_once 'classes/Painel.php';

$painel = new Painel();
$mensagem = ''; // Variável para mostrar alertas de sucesso ou erro na tela

// Verifica se o usuário clicou no botão de enviar (se foi feito um POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Pega todos os dados digitados nos inputs do HTML
    // ATENÇÃO: Os nomes das chaves ('nome', 'cnpj', etc) devem ser EXATAMENTE 
    // os mesmos que a sua Entidade Empresa.ts no Node.js está esperando!
    $dadosParaNode = [
        'razaoSocial' => trim($_POST['razaoSocial'] ?? ''),
        'cnpj' => trim($_POST['cnpj'] ?? ''),
        'telefone' => trim($_POST['telefone'] ?? ''),
        // 'endereco' => trim($_POST['endereco'] ?? ''),
        'nomeFantasia' => trim($_POST['nomeFantasia'] ?? ''),
        // 'cpf' => trim($_POST['cpf'] ?? ''),
        'emailCoportaivo' => trim($_POST['emailCoportaivo'] ?? ''),
        'senhaHash' => $_POST['senhaHash'] ?? ''
    ];

    // 2. Envia para a função que criamos no Painel.php
    $resposta = $painel->cadastrarEmpresa($dadosParaNode);

    // 3. Verifica se deu certo (Código 200 ou 201 significa Sucesso)
    if ($resposta['http_code'] == 200 || $resposta['http_code'] == 201) {
        $mensagem = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Conta criada com sucesso! <a href="login.php" class="alert-link">Clique aqui para entrar</a>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
    } else {
        // Se o Node.js recusar (ex: E-mail já cadastrado), mostra o erro
        $erroMsg = $resposta['body']['message'] ?? 'Ocorreu um erro ao cadastrar. Tente novamente.';
        $mensagem = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Erro: ' . htmlspecialchars($erroMsg) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Criar Conta - UniALFA</title>
   <link rel="stylesheet" href="css/stylee.css">
   
   
</head>
<body class="min-vh-100 d-flex flex-column position-relative">
    
   

    <header class="d-flex justify-content-between align-items-center p-3 px-5 bg-white border-bottom shadow-sm">
        <img src="imagens/logo-unialfa.png" style="width: 150px;" alt="Logo UniALFA">
        <div>
            <span class="text-muted">Já tem uma conta?</span>
            <a href="empresa.php" class="text-decoration-none fw-bold texto-azul ms-1">Entrar</a>
        </div>
    </header>

    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="container">
            
            <?php if(!empty($mensagem)) echo $mensagem; ?>

            <div class="row align-items-stretch">
                
                <div class="col-lg-4 d-flex flex-column justify-content-center mb-4 mb-lg-0">
                    <div class="caixa-informativa p-4 rounded h-100 bg-white">
                        <h2 class="fw-bold mb-3">Crie sua conta como empresa</h2>
                        <p class="text-muted mb-4" style="font-size: 0.95rem;">Conecte-se com os melhores talentos da UniALFA e encontre o estágio ideal para sua equipe.</p>
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="icone-redondo me-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16"><path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/></svg>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Acesse talentos qualificados</h6>
                                <p class="text-muted mb-0" style="font-size: 0.8rem;">Encontre estudantes alinhados com as necessidades da sua empresa.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="icone-redondo me-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16"><path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/><path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/></svg>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Publique vagas facilmente</h6>
                                <p class="text-muted mb-0" style="font-size: 0.8rem;">Divulgue oportunidades de estágio em poucos minutos.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="icone-redondo me-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16"><path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/></svg>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Gerencie candidatos</h6>
                                <p class="text-muted mb-0" style="font-size: 0.8rem;">Acompanhe todas as candidaturas e selecione os melhores perfis.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card border-0 shadow rounded-3 h-100 p-4 p-md-5">
                        <h4 class="fw-bold mb-1">Criar conta da empresa</h4>
                        <p class="text-muted mb-4">Preencha os dados abaixo para criar sua conta</p>

                        <form method="POST" action="">
                            
                            <h6 class="texto-azul fw-bold mb-3 mt-2">Dados da empresa</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="font-size: 0.85rem;">Nome da empresa <span class="text-danger">*</span></label>
                                <input type="text" name="razaoSocial" class="form-control" placeholder="Digite o nome da empresa" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label fw-bold" style="font-size: 0.85rem;">CNPJ <span class="text-danger">*</span></label>
                                    <input type="text" name="cnpj" class="form-control" placeholder="00.000.000/0000-00" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold" style="font-size: 0.85rem;">Telefone <span class="text-danger">*</span></label>
                                    <input type="text" name="telefone" class="form-control" placeholder="(00) 00000-0000" required>
                                </div>
                            </div>
<!-- 
                            <div class="mb-4">
                                <label class="form-label fw-bold" style="font-size: 0.85rem;">Endereço da empresa <span class="text-danger">*</span></label>
                                <input type="text" name="endereco" class="form-control" placeholder="Digite o endereço completo" required>
                            </div> -->

                            <h6 class="texto-azul fw-bold mb-3 border-top pt-4">Dados do responsável</h6>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label fw-bold" style="font-size: 0.85rem;">Nome Completo <span class="text-danger">*</span></label>
                                    <input type="text" name="nomeFantasia" class="form-control" placeholder="Digite seu nome completo" required>
                                </div>
                                <!-- <div class="col-md-6">
                                    <label class="form-label fw-bold" style="font-size: 0.85rem;">CPF <span class="text-danger">*</span></label>
                                    <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00" required>
                                </div> -->
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label fw-bold" style="font-size: 0.85rem;">E-mail <span class="text-danger">*</span></label>
                                    <input type="email" name="emailCoportaivo" class="form-control" placeholder="seuemail@empresa.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold" style="font-size: 0.85rem;">Senha <span class="text-danger">*</span></label>
                                    <input type="password" name="senhaHash" class="form-control" placeholder="Crie uma senha segura" required>
                                </div>
                            </div>

                            <button type="submit" class=" bg-azul text-white w-100 fw-bold py-2 fs-5 mt-2" style="border-radius: 6px;">
                                Criar conta da empresa
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>