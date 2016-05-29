<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Domain\AnalyzedItemReference;


class ItemRetriever
{

    private $entityManager;




    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }




    public function get(AnalyzedItemReference $analyzedItemRef)
    {
        switch ($analyzedItemRef->type()) {
            case 'tweet':
                $repository = $this->entityManager->getRepository('AppBundle:Tweet');
                break;

            default:
                return;
        }

        return $repository->find($analyzedItemRef->id());
    }

}
