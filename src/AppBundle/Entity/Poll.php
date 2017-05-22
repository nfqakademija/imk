<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

// @codingStandardsIgnoreStart
/**
 * Poll
 *
 * @ORM\Table(name="Polls", indexes={@ORM\Index(name="authorId", columns={"authorId"}), @ORM\Index(name="createDate", columns={"createDate"}), @ORM\Index(name="updateDate", columns={"updateDate"}), @ORM\Index(name="hitsCount", columns={"hitsCount"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PollRepository")
 */
class Poll
{
    /**
     * @var integer
     *
     * @ORM\Column(name="createDate", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="updateDate", type="datetime", nullable=false)
     */
    private $updateDate;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", nullable=false)
     */
    private $language = 'en';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250, nullable=false)
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
     * @ORM\Column(name="pollId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pollId;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="authorId", referencedColumnName="userId", nullable=true)
     * })
     */
    private $authorId;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $images
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PollOption", mappedBy="pollId")
     *
     */
    private $images;

    /**
     * Set createDate
     *
     * @param integer $createDate
     *
     * @return Poll
     */

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category", inversedBy="polls")
     * @ORM\JoinTable(name="PollCategories",
     *     joinColumns={@ORM\JoinColumn(name="pollId", referencedColumnName="pollId")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="categoryId", referencedColumnName="categoryId")}
     * )
     */
    private $categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function addCategory(Category $category)
    {
        $category->addPoll($this);
        $this->categories[] = $category;
    }

    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return integer
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set updateDate
     *
     *
     * @return Poll
     */
    public function setUpdateDate()
    {
        $this->updateDate = new \DateTime("now");

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return integer
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set language
     *
     * @param string $language
     *
     * @return Poll
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Poll
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
     * @return Poll
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
     * Get pollId
     *
     * @return integer
     */
    public function getPollId()
    {
        return $this->pollId;
    }

    /**
     * Set authorId
     *
     * @param \AppBundle\Entity\User $authorId
     *
     * @return Poll
     */
    public function setAuthorId(\AppBundle\Entity\User $authorId = null)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }


    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
// @codingStandardsIgnoreEnd