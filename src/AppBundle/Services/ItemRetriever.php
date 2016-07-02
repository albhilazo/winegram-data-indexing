<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Domain\ItemReference;


class ItemRetriever
{

    private $entityManager;




    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }




    public function get(ItemReference $itemReference)
    {
        $repository = $this->getRepository($itemReference->type());
        if (!$repository)  return;

        return $repository->find($itemReference->id());
    }




    private function getRepository($itemType)
    {
        switch ($itemType) {
            case 'comment':
                return $this->entityManager->getRepository('AppBundle:Comment');
                break;

            case 'wine':
                return $this->entityManager->getRepository('AppBundle:Wine');
                break;
        }
    }

}
