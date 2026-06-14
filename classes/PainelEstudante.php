<?php

class PainelEstudante
{
    private $apiUrl = "http://localhost:3001";

    public function login($senha, $emailAcademico)
    {
        $dados_capturados = [
            "emailAcademico" => $emailAcademico,
            "senha" => $senha
        ];

        $texto_json = json_encode($dados_capturados);
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

    public function listarVagas()
    {
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

    public function buscarVagas($termoPesquisa = '', $categoria = '')
    {
        $endpoint = $this->apiUrl . "/vagas";
        
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

        if ($erro_curl) {
            return "ERRO DE CONEXÃO: " . $erro_curl;
        }

        if ($httpCode === 200) {
            return json_decode($response, true);
        }

        return [];
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
}