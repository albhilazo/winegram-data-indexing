<?php

namespace AppBundle\Entity;

/**
 * Tag
 */
class Tag
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $commentId;

    /**
     * @var string
     */
    private $id;


    /**
     * Set text
     *
     * @param string $text
     *
     * @return Tag
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
     * Set commentId
     *
     * @param string $commentId
     *
     * @return Tag
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;

        return $this;
    }

    /**
     * Get commentId
     *
     * @return string
     */
    public function getCommentId()
    {
        return $this->commentId;
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

