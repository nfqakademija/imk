<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PollVoter
 *
 * @ORM\Table(name="PollsVoters", indexes={@ORM\Index(name="pollId", columns={"pollId", "voterId"})})
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Poll")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pollId", referencedColumnName="pollId")
     * })
     */
    private $pollId;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="voterId", referencedColumnName="userId")
     * })
     */
    private $voterId;



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
     * Set voterId
     *
     * @param \AppBundle\Entity\User $voterId
     *
     * @return PollVoter
     */
    public function setVoterId(\AppBundle\Entity\User $voterId = null)
    {
        $this->voterId = $voterId;

        return $this;
    }

    /**
     * Get voterId
     *
     * @return \AppBundle\Entity\User
     */
    public function getVoterId()
    {
        return $this->voterId;
    }
}
