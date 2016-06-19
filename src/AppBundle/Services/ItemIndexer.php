<?php

namespace AppBundle\Services;

use Elasticsearch\Client;
use AppBundle\Entity\Tweet;


class ItemIndexer
{

    const INDEX_NAME = 'winegram';

    private $elasticClient;




    public function __construct(Client $elasticClient)
    {
        $this->elasticClient = $elasticClient;
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




    public function indexUvinumProduct(array $item)
    {
        $grapes = [];
        foreach ($item['attributes']['grapes'] as $grape_type) {
            array_push($grapes, $grape_type['value']);
        }

        $params = [
            'index' => self::INDEX_NAME,
            'type'  => 'uvinum-product',
            'id'    => $item['id_product'],
            'body'  => [
                'name' => $item['name'],
                'rank' => $item['rank'],
                'producer_description' => $item['producer_description'],
                'maker_description' => $item['maker_description'],
                'url' => $item['url'],
                'vintage' => $item['attributes']['vintage']['value'],
                'wine_type' => $item['attributes']['wine_type']['value'],
                'bottle_volume' => $item['attributes']['bottle_volume']['value'],
                'grapes' => $grapes,
                'alcohol_volume' => $item['attributes']['alcohol_volume']['value'],
                'image_full' => $item['image_full'],
                'image_maker_full' => $item['image_maker_full'],
                'maker' => $item['maker']
            ]
        ];

        $response = $this->elasticClient->index($params);
    }

}
