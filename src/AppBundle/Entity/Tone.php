<?php

namespace AppBundle\Entity;

/**
 * Tone
 */
class Tone
{
    /**
     * @var string
     */
    private $score;

    /**
     * @var string
     */
    private $toneId;

    /**
     * @var string
     */
    private $toneName;

    /**
     * @var string
     */
    private $toneCategorieId;

    /**
     * @var string
     */
    private $id;


    /**
     * Set score
     *
     * @param string $score
     *
     * @return Tone
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set toneId
     *
     * @param string $toneId
     *
     * @return Tone
     */
    public function setToneId($toneId)
    {
        $this->toneId = $toneId;

        return $this;
    }

    /**
     * Get toneId
     *
     * @return string
     */
    public function getToneId()
    {
        return $this->toneId;
    }

    /**
     * Set toneName
     *
     * @param string $toneName
     *
     * @return Tone
     */
    public function setToneName($toneName)
    {
        $this->toneName = $toneName;

        return $this;
    }

    /**
     * Get toneName
     *
     * @return string
     */
    public function getToneName()
    {
        return $this->toneName;
    }

    /**
     * Set toneCategorieId
     *
     * @param string $toneCategorieId
     *
     * @return Tone
     */
    public function setToneCategorieId($toneCategorieId)
    {
        $this->toneCategorieId = $toneCategorieId;

        return $this;
    }

    /**
     * Get toneCategorieId
     *
     * @return string
     */
    public function getToneCategorieId()
    {
        return $this->toneCategorieId;
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

