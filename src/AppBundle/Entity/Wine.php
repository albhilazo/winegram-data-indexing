<?php

namespace AppBundle\Entity;

/**
 * Wine
 */
class Wine
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Wine
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}

