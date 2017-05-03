<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PollCategory
 *
 * @ORM\Table(name="PollsCategories", indexes={@ORM\Index(name="pollId", columns={"pollId"}), @ORM\Index(name="categoryId", columns={"categoryId"})})
 * @ORM\Entity
 */
class PollCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Polls
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Polls")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pollId", referencedColumnName="pollId")
     * })
     */
    private $pollId;

    /**
     * @var \AppBundle\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoryId", referencedColumnName="categoryId")
     * })
     */
    private $categoryId;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pollId
     *
     * @param \AppBundle\Entity\Polls $pollId
     *
     * @return PollCategory
     */
    public function setPollId(\AppBundle\Entity\Polls $pollId = null)
    {
        $this->pollId = $pollId;

        return $this;
    }

    /**
     * Get pollId
     *
     * @return \AppBundle\Entity\Polls
     */
    public function getPollId()
    {
        return $this->pollId;
    }

    /**
     * Set categoryId
     *
     * @param \AppBundle\Entity\Categories $categoryId
     *
     * @return PollCategory
     */
    public function setCategoryId(\AppBundle\Entity\Categories $categoryId = null)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return \AppBundle\Entity\Categories
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
}
