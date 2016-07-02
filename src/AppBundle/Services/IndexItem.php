<?php

namespace AppBundle\Services;

use AppBundle\Services\ItemRetriever;
use AppBundle\Services\ItemIndexer;
use AppBundle\Domain\ItemReference;


class IndexItem
{

    private $itemRetriever;
    private $itemIndexer;




    public function __construct(ItemRetriever $itemRetriever, ItemIndexer $itemIndexer)
    {
        $this->itemRetriever = $itemRetriever;
        $this->itemIndexer   = $itemIndexer;
    }




    public function execute(ItemReference $itemReference)
    {
        $itemToIndex = $this->itemRetriever->get($itemReference);

        switch ($itemReference->type()) {
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
