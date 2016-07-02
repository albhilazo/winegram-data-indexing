<?php

namespace AppBundle\Entity;

/**
 * Comment
 */
class Comment
{
    /**
     * @var string
     */
    private $originaltext;

    /**
     * @var string
     */
    private $lang;

    /**
     * @var string
     */
    private $englishtext;

    /**
     * @var string
     */
    private $textsentiment;

    /**
     * @var string
     */
    private $texttwittsentiment;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $idredis;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $likesCount;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $media;

    /**
     * @var string
     */
    private $searchId;

    /**
     * @var string
     */
    private $searchContent;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $id;


    /**
     * Set originaltext
     *
     * @param string $originaltext
     *
     * @return Comment
     */
    public function setOriginaltext($originaltext)
    {
        $this->originaltext = $originaltext;

        return $this;
    }

    /**
     * Get originaltext
     *
     * @return string
     */
    public function getOriginaltext()
    {
        return $this->originaltext;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return Comment
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set englishtext
     *
     * @param string $englishtext
     *
     * @return Comment
     */
    public function setEnglishtext($englishtext)
    {
        $this->englishtext = $englishtext;

        return $this;
    }

    /**
     * Get englishtext
     *
     * @return string
     */
    public function getEnglishtext()
    {
        return $this->englishtext;
    }

    /**
     * Set textsentiment
     *
     * @param string $textsentiment
     *
     * @return Comment
     */
    public function setTextsentiment($textsentiment)
    {
        $this->textsentiment = $textsentiment;

        return $this;
    }

    /**
     * Get textsentiment
     *
     * @return string
     */
    public function getTextsentiment()
    {
        return $this->textsentiment;
    }

    /**
     * Set texttwittsentiment
     *
     * @param string $texttwittsentiment
     *
     * @return Comment
     */
    public function setTexttwittsentiment($texttwittsentiment)
    {
        $this->texttwittsentiment = $texttwittsentiment;

        return $this;
    }

    /**
     * Get texttwittsentiment
     *
     * @return string
     */
    public function getTexttwittsentiment()
    {
        return $this->texttwittsentiment;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Comment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set idredis
     *
     * @param string $idredis
     *
     * @return Comment
     */
    public function setIdredis($idredis)
    {
        $this->idredis = $idredis;

        return $this;
    }

    /**
     * Get idredis
     *
     * @return string
     */
    public function getIdredis()
    {
        return $this->idredis;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Comment
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set likesCount
     *
     * @param string $likesCount
     *
     * @return Comment
     */
    public function setLikesCount($likesCount)
    {
        $this->likesCount = $likesCount;

        return $this;
    }

    /**
     * Get likesCount
     *
     * @return string
     */
    public function getLikesCount()
    {
        return $this->likesCount;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Comment
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set media
     *
     * @param string $media
     *
     * @return Comment
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set searchId
     *
     * @param string $searchId
     *
     * @return Comment
     */
    public function setSearchId($searchId)
    {
        $this->searchId = $searchId;

        return $this;
    }

    /**
     * Get searchId
     *
     * @return string
     */
    public function getSearchId()
    {
        return $this->searchId;
    }

    /**
     * Set searchContent
     *
     * @param string $searchContent
     *
     * @return Comment
     */
    public function setSearchContent($searchContent)
    {
        $this->searchContent = $searchContent;

        return $this;
    }

    /**
     * Get searchContent
     *
     * @return string
     */
    public function getSearchContent()
    {
        return $this->searchContent;
    }

    /**
     * Set query
     *
     * @param string $query
     *
     * @return Comment
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
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

