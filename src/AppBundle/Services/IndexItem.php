<?php

namespace AppBundle\Services;

use AppBundle\Services\ItemRetriever;
use AppBundle\Domain\ItemReference;


class IndexItem
{

    private $itemRetriever;




    public function __construct(ItemRetriever $itemRetriever)
    {
        $this->itemRetriever = $itemRetriever;
    }




    public function execute(ItemReference $itemReference)
    {
        $itemToIndex = $this->itemRetriever->get($itemReference);

        var_dump($itemToIndex);
    }

}
