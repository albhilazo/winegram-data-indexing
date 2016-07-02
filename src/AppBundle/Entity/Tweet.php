<?php

namespace AppBundle\Entity;

/**
 * Tweet
 */
class Tweet
{
    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $text;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set user
     *
     * @param string $user
     *
     * @return Tweet
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Tweet
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

