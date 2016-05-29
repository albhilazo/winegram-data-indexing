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

}
