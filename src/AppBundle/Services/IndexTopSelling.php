<?php

namespace AppBundle\Services;

class IndexTopSelling
{

    private $itemIndexer;




    public function __construct(ItemIndexer $itemIndexer)
    {
        $this->itemIndexer = $itemIndexer;
    }




    public function execute($wineCategory)
    {
        $this->itemIndexer->indexTopSelling($wineCategory);
    }

}
