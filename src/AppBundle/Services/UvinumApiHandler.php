<?php

namespace AppBundle\Services;

use GuzzleHttp\Client;


class UvinumApiHandler
{
    
    const BASE_API_URL = 'https://api.vcst.net';
    const API_INSTANCE = 'uvinum';
    const API_LANGUAGE = 'es_ES';

    private $apiKey;
    private $httpClient;




    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new Client(['base_uri' => self::BASE_API_URL]);
    }




    public function searchProducts($productName)
    {
        $request = self::BASE_API_URL
            . '/productSearch/' . str_replace(' ', '+', $productName)
            . '?api_key=' . $this->apiKey
            . '&instance=' . self::API_INSTANCE
            . '&language=' . self::API_LANGUAGE;

        $resultProducts = $this->sendRequest($request)['products'];
        $productIds = [];
        foreach ($resultProducts as $product) {
            array_push($productIds, $product['id_product']);
        }

        return $productIds;
    }




    public function getProduct($productId)
    {
        $request = self::BASE_API_URL
            . '/getProduct:p:' . $productId
            . '?api_key=' . $this->apiKey
            . '&instance=' . self::API_INSTANCE
            . '&language=' . self::API_LANGUAGE;

        return $this->sendRequest($request)['product_data'];
    }




    private function sendRequest($request)
    {
        $response = (string) $this->httpClient->get($request)->getBody();
        return json_decode($response, true);
    }

}
