<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Domain\ItemReference;
use GuzzleHttp\Client;


class ItemRetriever
{

    const BASE_UVINUM_API_URL = 'https://api.vcst.net';
    const API_INSTANCE = 'uvinum';
    const API_LANGUAGE = 'es_ES';

    private $entityManager;
    private $api_key;




    public function __construct(EntityManager $entityManager, $api_key)
    {
        $this->entityManager = $entityManager;
        $this->api_key       = $api_key;
    }




    public function get(ItemReference $itemReference)
    {
        switch ($itemReference->type()) {
            case 'tweet':
                $repository = $this->entityManager->getRepository('AppBundle:Tweet');
                break;

            case 'uvinum-product':
                return $this->getUvinumProduct($itemReference->id());
                break;

            default:
                return;
        }

        return $repository->find($itemReference->id());
    }




    private function getUvinumProduct($productId)
    {
        $http_client = new Client(['base_uri' => self::BASE_UVINUM_API_URL]);
        $request_url = self::BASE_UVINUM_API_URL
            . '/getProduct:p:' . $productId
            . '?api_key=' . $this->api_key
            . '&instance=' . self::API_INSTANCE
            . '&language=' . self::API_LANGUAGE;

        $response = (string) $http_client->get($request_url)->getBody();
        $response = json_decode($response, true);

        return $response['product_data'];
    }

}
