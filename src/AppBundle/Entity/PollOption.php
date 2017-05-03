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
     * @var integer
     *
     * @ORM\Column(name="sequence", type="smallint", nullable=false)
     */
    private $sequence = '0';

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
     * @var \AppBundle\Entity\Polls
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Polls")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pollId", referencedColumnName="pollId")
     * })
     */
    private $pollId;



    /**
     * Set sequence
     *
     * @param integer $sequence
     *
     * @return PollOption
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Get sequence
     *
     * @return integer
     */
    public function getSequence()
    {
        return $this->sequence;
    }

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
     * @param \AppBundle\Entity\Polls $pollId
     *
     * @return PollOption
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
}
