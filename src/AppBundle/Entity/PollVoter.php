<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// @codingStandardsIgnoreStart
/**
 * PollVoter
 *
 * @ORM\Table(name="PollsVoters", indexes={@ORM\Index(name="pollId", columns={"pollId"})})
 * @ORM\Entity
 */
class PollVoter
{
    /**
     * @var string
     *
     * @ORM\Column(name="voterIp", type="string", length=45, nullable=false)
     */
    private $voterIp = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="voteOptionId", type="integer", nullable=false)
     */
    private $voteOptionId;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Poll", inversedBy="voters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pollId", referencedColumnName="pollId")
     * })
     */
    private $pollId;

    /**
     * @var string
     *
     * @ORM\Column(name="userAgent", type="string", length=255)
     */
    private $userAgent;


    /**
     * Set voterIp
     *
     * @param string $voterIp
     *
     * @return PollVoter
     */
    public function setVoterIp($voterIp)
    {
        $this->voterIp = $voterIp;

        return $this;
    }

    /**
     * Get voterIp
     *
     * @return string
     */
    public function getVoterIp()
    {
        return $this->voterIp;
    }

    /**
     * Set voteOptionId
     *
     * @param integer $voteOptionId
     *
     * @return PollVoter
     */
    public function setVoteOptionId($voteOptionId)
    {
        $this->voteOptionId = $voteOptionId;

        return $this;
    }

    /**
     * Get voteOptionId
     *
     * @return integer
     */
    public function getVoteOptionId()
    {
        return $this->voteOptionId;
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
     * Set pollId
     *
     * @param \AppBundle\Entity\Poll $pollId
     *
     * @return PollVoter
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
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return PollVoter
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }
}
