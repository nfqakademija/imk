<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="Categories", indexes={@ORM\Index(name="hitsCount", columns={"hitsCount"})})
 * @ORM\Entity
 */
class Categories
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="hitsCount", type="integer", nullable=false)
     */
    private $hitsCount = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="categoryId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;



    /**
     * Set title
     *
     * @param string $title
     *
     * @return Categories
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set hitsCount
     *
     * @param integer $hitsCount
     *
     * @return Categories
     */
    public function setHitsCount($hitsCount)
    {
        $this->hitsCount = $hitsCount;

        return $this;
    }

    /**
     * Get hitsCount
     *
     * @return integer
     */
    public function getHitsCount()
    {
        return $this->hitsCount;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
}
