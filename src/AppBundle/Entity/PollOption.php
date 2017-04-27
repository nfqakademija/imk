<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PollOption
 *
 * @ORM\Table(name="PollsOptions", indexes={@ORM\Index(name="pollId", columns={"pollId"})})
 * @ORM\Entity
 */
class PollOption
{
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=250, nullable=false)
     */
    private $content = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="votesCount", type="integer", nullable=false)
     */
    private $votesCount = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="optionId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $optionId;

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
     * Set content
     *
     * @param string $content
     *
     * @return PollOption
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set votesCount
     *
     * @param integer $votesCount
     *
     * @return PollOption
     */
    public function setVotesCount($votesCount)
    {
        $this->votesCount = $votesCount;

        return $this;
    }

    /**
     * Get votesCount
     *
     * @return integer
     */
    public function getVotesCount()
    {
        return $this->votesCount;
    }

    /**
     * Get optionId
     *
     * @return integer
     */
    public function getOptionId()
    {
        return $this->optionId;
    }

    /**
     * Set pollId
     *
     * @param \AppBundle\Entity\Poll $pollId
     *
     * @return PollOption
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
}
