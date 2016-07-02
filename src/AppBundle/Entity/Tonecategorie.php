<?php

namespace AppBundle\Entity;

/**
 * Tonecategorie
 */
class Tonecategorie
{
    /**
     * @var string
     */
    private $categoryId;

    /**
     * @var string
     */
    private $categoryName;

    /**
     * @var string
     */
    private $commentId;

    /**
     * @var string
     */
    private $id;


    /**
     * Set categoryId
     *
     * @param string $categoryId
     *
     * @return Tonecategorie
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return string
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set categoryName
     *
     * @param string $categoryName
     *
     * @return Tonecategorie
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set commentId
     *
     * @param string $commentId
     *
     * @return Tonecategorie
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

