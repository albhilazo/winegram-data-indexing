<?php

namespace AppBundle\Services;

class IndexAll
{

    private $itemRetriever;
    private $itemIndexer;




    public function __construct(ItemRetriever $itemRetriever, ItemIndexer $itemIndexer)
    {
        $this->itemRetriever = $itemRetriever;
        $this->itemIndexer   = $itemIndexer;
    }




    public function execute($itemType)
    {
        $allItems = $this->itemRetriever->getAll($itemType);

        foreach ($allItems as $itemToIndex) {
            switch ($itemType) {
                case 'comment':
                    $this->itemIndexer->indexComment($itemToIndex);
                    break;

                case 'wine':
                    $this->itemIndexer->indexWine($itemToIndex);
                    break;

                default:
                    return;
            }
        }
    }

}
