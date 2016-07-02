<?php

namespace AppBundle\Services;

use Elasticsearch\Client;
use AppBundle\Services\UvinumApiHandler;
use AppBundle\Entity\Comment;
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




    public function indexComment(Comment $item)
    {
        $searchType = $this->getSearchType($item->getSearchId());
        $params = [
            'index' => self::INDEX_NAME,
            'type'  => 'comment',
            'id'    => $item->getId(),
            'body'  => [
                'original_text' => $item->getOriginalText(),
                'lang' => $item->getLang(),
                'text_sentiment' => $item->getTextSentiment(),
                'text_tweet_sentiment' => $item->getTextTwittSentiment(),
                'type' => $item->getType(),
                'username' => $item->getUsername(),
                'media' => $item->getMedia(),
                'query' => $item->getQuery(),
                'search_type' => $searchType,
                'search_content' => $item->getSearchContent(),
            ]
        ];

        $response = $this->elasticClient->index($params);

        if ($searchType == 'uvinum' && $item->getSearchContent()) {
            $response = $this->indexWineById($item->getSearchContent());
        }
    }




    public function indexWine(Wine $item)
    {
        $productIds = $this->uvinumApi->searchProducts($item->getName());

        foreach ($productIds as $id) {
            $this->indexWineById($id);
        }
    }




    public function indexWineById($id)
    {
        $params = $this->getWineParams($id);
        $response = $this->elasticClient->index($params);
    }




    public function indexTopSelling($wineCategory)
    {
        $productIds = $this->uvinumApi->getTopSelling($wineCategory);

        foreach ($productIds as $id) {
            $this->indexWineById($id);
        }
    }




    public function getSearchType($searchId)
    {
        switch ($searchId) {
            case '1':
                return 'uvinum';

            case '2':
                return 'do';

            default:
                return 'other';
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
