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
        array $headers = []
    ): array {
        $url = $this->apiBaseUrl . $endpoint;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if (!empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'PATCH') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        } elseif ($method === 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($response === false || $httpCode >= 400) {
            throw new Exception("Error en la solicitud: " . curl_error($curl));
        }

        curl_close($curl);
        return json_decode($response, true);
    }
}