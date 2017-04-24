<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersFavoriteCategories
 *
 * @ORM\Table(name="UsersFavoriteCategories", indexes={@ORM\Index(name="userId", columns={"userId", "categoryId", "lastUseDate"})})
 * @ORM\Entity
 */
class UsersFavoriteCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lastUseDate", type="integer", nullable=false)
     */
    private $lastUseDate = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     * })
     */
    private $userId;

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
     * Set lastUseDate
     *
     * @param integer $lastUseDate
     *
     * @return UsersFavoriteCategories
     */
    public function setLastUseDate($lastUseDate)
    {
        $this->lastUseDate = $lastUseDate;

        return $this;
    }

    /**
     * Get lastUseDate
     *
     * @return integer
     */
    public function getLastUseDate()
    {
        return $this->lastUseDate;
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

    /**
     * Set userId
     *
     * @param \AppBundle\Entity\Users $userId
     *
     * @return UsersFavoriteCategories
     */
    public function setUserId(\AppBundle\Entity\Users $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\Users
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set categoryId
     *
     * @param \AppBundle\Entity\Categories $categoryId
     *
     * @return UsersFavoriteCategories
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
