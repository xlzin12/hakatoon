<?php

class PainelEmpresa
{
    private $apiUrl = "http://localhost:3001";

    public function login($senhaHash, $emailCorporativo)
    {
        $dados_capturados = [
            "emailCorporativo" => $emailCorporativo,
            "senhaHash" => $senhaHash
        ];

        $texto_json = json_encode($dados_capturados);
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

    public function cadastrar($dadosFormulario)
    {
        $endpoint = $this->apiUrl . "/empresas";

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dadosFormulario));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $resposta_da_api = curl_exec($ch);
        $codigo_http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'http_code' => $codigo_http,
            'body' => json_decode($resposta_da_api, true)
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
        $erro_curl = curl_error($ch);
        curl_close($ch);

        if ($erro_curl) {
            return "ERRO DE CONEXÃO: " . $erro_curl;
        }

        return json_decode($resposta_da_api, true);
    }

    public function listarCandidatos()
    {
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
}