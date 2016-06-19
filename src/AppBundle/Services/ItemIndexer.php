<?php

namespace AppBundle\Services;

use Elasticsearch\Client;
use AppBundle\Services\UvinumApiHandler;
use AppBundle\Entity\Tweet;
use AppBundle\Entity\Wine;


class ItemIndexer
{

    const INDEX_NAME = 'winegram';

    private $elasticClient;
    private $uvinumApi;




    public function __construct(Client $elasticClient, UvinumApiHandler $uvinumApi)
    {
        $this->elasticClient = $elasticClient;
        $this->uvinumApi = $uvinumApi;
    }




    public function indexTweet(Tweet $item)
    {
        $params = [
            'index' => self::INDEX_NAME,
            'type'  => 'tweet',
            'id'    => $item->getId(),
            'body'  => [
                'user' => $item->getUser(),
                'text' => $item->getText(),
            ]
        ];

        $response = $this->elasticClient->index($params);
    }




    public function indexWine(Wine $item)
    {
        $productIds = $this->uvinumApi->searchProducts($item->getName());

        foreach ($productIds as $id) {
            $params = $this->getWineParams($id);
            $response = $this->elasticClient->index($params);
        }
    }




    private function getWineParams($productId)
    {
        $result = $this->uvinumApi->getProduct($productId);

        $paramsBody = [];

        $dataFields = ['name', 'rank', 'producer_description', 'maker_description',
                       'url', 'long_name', 'image_full', 'image_maker_full', 'maker'];
        foreach ($dataFields as $fieldName) {
            if (!isset($result[$fieldName])) {
                continue;
            }

            $paramsBody[$fieldName] = $result[$fieldName];
        }

        $dataAttributes = ['vintage', 'wine_type', 'bottle_volume',
                           'grapes', 'pairing', 'alcohol_volume'];
        foreach ($dataAttributes as $attributeName) {
            if (!isset($result['attributes'][$attributeName])) {
                continue;
            }

            if (!isset($result['attributes'][$attributeName]['value'])) {
                $paramsBody[$attributeName] = [];
                foreach ($result['attributes'][$attributeName] as $attributeItem) {
                    array_push($paramsBody[$attributeName], $attributeItem['value']);
                }

                continue;
            }

            $paramsBody[$attributeName] = $result['attributes'][$attributeName]['value'];
        }


        return [
            'index' => self::INDEX_NAME,
            'type'  => 'wine',
            'id'    => $productId,
            'body'  => $paramsBody
        ];
    }

}
