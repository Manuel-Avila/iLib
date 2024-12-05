<?php

declare(strict_types=1);

final class ApiHandler {
    private string $apiBaseUrl;

    public function __construct(string $baseUrl)
    {
        $this->apiBaseUrl = $baseUrl;
    }

    /**
     * @throws Exception
     */
    public function makeRequest(
        string $endpoint,
        string $method = 'GET',
        array $data = [],
        array $headers = [
            'Content-Type: application/json',
            'Accept: application/json'
        ]
    ): array {
        $url = $this->apiBaseUrl . $endpoint;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'PATCH') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            }
        }

        try {
            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($response === false) {
                throw new Exception("Error en la solicitud CURL: " . curl_error($curl));
            }

            $decodedResponse = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("La respuesta no es un JSON válido: " . json_last_error_msg());
            }

            if ($httpCode >= 400) {
                throw new Exception("Error HTTP $httpCode: " . json_encode($decodedResponse));
            }

            return $decodedResponse;
        } finally {
            curl_close($curl);
        }
    }
}