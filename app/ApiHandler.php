<?php

class ApiHandler {
    private $apiBaseUrl;

    public function __construct($baseUrl)
    {
        $this->apiBaseUrl = $baseUrl;
    }

    public function makeRequest($endpoint, $method = 'GET', $data = [])
    {
        $url = $this->apiBaseUrl . $endpoint;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        } elseif ($method === 'PUT' || $method === 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
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