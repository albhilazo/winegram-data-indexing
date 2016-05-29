<?php

namespace AppBundle\Infrastructure;

use AppBundle\Services\IndexItem;
use AppBundle\Domain\ItemReference;


class IndexItemMessageHandler
{

    private $indexItem;




    public function __construct(IndexItem $indexItem)
    {
        $this->indexItem = $indexItem;
    }




    public function processMessage($properties)
    {
        if (!isset($properties['type']) || !isset($properties['id'])) {
            return;
        }

        $this->indexItem->execute(
            new ItemReference($properties['type'], $properties['id'])
        );
    }

}
