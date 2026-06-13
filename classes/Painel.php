<?php

class Painel
{
    // 1. Porta corrigida para 3001 (onde a API Node está rodando)
    private $apiUrl = "http://localhost:3001";

    public function loginEmpresa($senhaHash, $emailCorporativo)
    {
        $dados_capturados = [
            "emailCorporativo" => $emailCorporativo, // Mantenha exatamente como você espera no Node
            "senhaHash" => $senhaHash
        ];

        $texto_json = json_encode($dados_capturados);

        // 2. Rota corrigida (assumindo que você criará uma rota /login dentro de empresas)
        // Removi o /api e o ; do final
        $endpoint = $this->apiUrl . "/empresas/login";

        $ch = curl_init($endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $texto_json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($texto_json)
        ]);

        $resposta_da_api = curl_exec($ch);
        $codigo_http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return [
            "status" => $codigo_http,
            "resposta" => json_decode($resposta_da_api, true)
        ];
    }

    public function loginEstudante($senha, $emailAcademico)
    {
        $dados_capturados = [
            "emailAcademico" => $emailAcademico,
            "senha" => $senha
        ];

        $texto_json = json_encode($dados_capturados);

        // 2. Rota corrigida (assumindo que você criará uma rota /login dentro de alunos)
        $endpoint = $this->apiUrl . "/alunos/login";

        $ch = curl_init($endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $texto_json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($texto_json)
        ]);

        $resposta_da_api = curl_exec($ch);
        $codigo_http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return [
            "status" => $codigo_http,
            "resposta" => json_decode($resposta_da_api, true)
        ];
    }

    public function listarAlunos()
    {
        $endpoint = $this->apiUrl . "/alunos";

        $ch = curl_init($endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $resposta_da_api = curl_exec($ch);

        // 🚨 NOVO: Captura qualquer erro de conexão do cURL
        $erro_curl = curl_error($ch);

        curl_close($ch);

        // Se deu erro de conexão (ex: Node desligado), ele devolve o erro em texto
        if ($erro_curl) {
            return "ERRO DE CONEXÃO: " . $erro_curl;
        }

        // Se conectou, devolve os dados
        return json_decode($resposta_da_api, true);
    }

    public function listarVagas()
    {
        // Supondo que a sua rota no Node seja /vagas
        $endpoint = $this->apiUrl . "/vagas";

        $ch = curl_init($endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $resposta_da_api = curl_exec($ch);
        $erro_curl = curl_error($ch);
        curl_close($ch);

        if ($erro_curl) {
            return "ERRO DE CONEXÃO: " . $erro_curl;
        }

        return json_decode($resposta_da_api, true);
    }

    public function listarCandidatos()
    {
        // A rota da sua API que lista as candidaturas
        $endpoint = $this->apiUrl . "/candidaturas";

        $ch = curl_init($endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $resposta_da_api = curl_exec($ch);
        $erro_curl = curl_error($ch);
        curl_close($ch);

        if ($erro_curl) {
            return "ERRO DE CONEXÃO: " . $erro_curl;
        }

        return json_decode($resposta_da_api, true);
    }

    public function cadastrarEmpresa($dadosFormulario)
    {
        // A rota da sua API que cria a empresa (geralmente POST /empresas)
        $endpoint = $this->apiUrl . "/empresas";

        $ch = curl_init($endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true); // Agora é POST (enviar dados)
        // Transforma a lista do PHP num JSON que o Node.js entende
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dadosFormulario));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $resposta_da_api = curl_exec($ch);
        $codigo_http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Retorna o que o Node.js respondeu junto com o código (ex: 200, 201, 400)
        return [
            'http_code' => $codigo_http,
            'body' => json_decode($resposta_da_api, true)
        ];
    }
   public function buscarVagas($termoPesquisa = '', $categoria = '') {
        // Corrigido para a rota de vagas e acessando $this corretamente
        $endpoint = $this->apiUrl . "/vagas";
        
        // Constrói os parâmetros de consulta (Query Params) se existirem
        $queryParams = [];
        if (!empty($termoPesquisa)) {
            $queryParams['titulo'] = $termoPesquisa;
        }
        if (!empty($categoria)) {
            $queryParams['categoria'] = $categoria;
        }

        if (!empty($queryParams)) {
            $endpoint .= '?' . http_build_query($queryParams);
        }

        // Inicializa o cURL
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $erro_curl = curl_error($ch);
        curl_close($ch);

        // Adicionado o mesmo tratamento de erro de conexão das outras funções
        if ($erro_curl) {
            return "ERRO DE CONEXÃO: " . $erro_curl;
        }

        // Se a API retornar sucesso, decodifica o JSON para Array do PHP
        if ($httpCode === 200) {
            return json_decode($response, true);
        }

        return [];
    }
    
    
}
