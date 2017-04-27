<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserFavoriteCategory
 *
 * @ORM\Table(name="UsersFavoriteCategories", indexes={@ORM\Index(name="userId", columns={"userId", "categoryId", "lastUseDate"})})
 * @ORM\Entity
 */
class UserFavoriteCategory
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
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     * })
     */
    private $userId;

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
     * Set lastUseDate
     *
     * @param integer $lastUseDate
     *
     * @return UserFavoriteCategory
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
     * @param \AppBundle\Entity\User $userId
     *
     * @return UserFavoriteCategory
     */
    public function setUserId(\AppBundle\Entity\User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set categoryId
     *
     * @param \AppBundle\Entity\Category $categoryId
     *
     * @return UserFavoriteCategory
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
