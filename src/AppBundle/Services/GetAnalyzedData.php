<?php

namespace AppBundle\Services;

class GetAnalyzedData
{

    public static function getData($properties)
    {
        echo $properties['type'];
        echo $properties['id'];
    }

}
