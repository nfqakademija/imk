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
     * @var \AppBundle\Entity\Poll
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Poll")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pollId", referencedColumnName="pollId")
     * })
     */
    private $pollId;

    /**
     * @var \AppBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
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
     * @param \AppBundle\Entity\Poll $pollId
     *
     * @return PollCategory
     */
    public function setPollId(\AppBundle\Entity\Poll $pollId = null)
    {
        $this->pollId = $pollId;

        return $this;
    }

    /**
     * Get pollId
     *
     * @return \AppBundle\Entity\Poll
     */
    public function getPollId()
    {
        return $this->pollId;
    }

    /**
     * Set categoryId
     *
     * @param \AppBundle\Entity\Category $categoryId
     *
     * @return PollCategory
     */
    public function setCategoryId(\AppBundle\Entity\Category $categoryId = null)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
}
