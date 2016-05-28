<?php

namespace AppBundle\Domain;

class AnalyzedItemReference
{

    private $type;
    private $id;

    public function __construct($type, $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

    public function type()
    {
        return $this->type;
    }

    public function id()
    {
        return $this->id;
    }

}
