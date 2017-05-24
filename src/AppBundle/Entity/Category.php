<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="Categories", indexes={@ORM\Index(name="hitsCount", columns={"hitsCount"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false, unique=true)
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Poll", mappedBy="categories")
     */
    private $polls;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->polls = new ArrayCollection();
    }

    public function addPoll(Poll $poll)
    {
        $this->polls[] = $poll;
    }

    public function removePoll(Poll $poll)
    {
        $this->polls->removeElement($poll);
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
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
     * @return Category
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
