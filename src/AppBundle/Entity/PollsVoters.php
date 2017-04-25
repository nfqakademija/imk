<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PollsVoters
 *
 * @ORM\Table(name="PollsVoters", indexes={@ORM\Index(name="pollId", columns={"pollId", "voterId"})})
 * @ORM\Entity
 */
class PollsVoters
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
     * @var \AppBundle\Entity\Polls
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Polls")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pollId", referencedColumnName="pollId")
     * })
     */
    private $pollId;

    /**
     * @var \AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users")
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
     * @return PollsVoters
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
     * @return PollsVoters
     */
    public function setVoteoptionid($voteOptionId)
    {
        $this->voteOptionId = $voteOptionId;

        return $this;
    }

    /**
     * Get voteOptionId
     *
     * @return integer
     */
    public function getVoteoptionid()
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
     * @param \AppBundle\Entity\Polls $pollId
     *
     * @return PollsVoters
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
     * Set voterId
     *
     * @param \AppBundle\Entity\Users $voterId
     *
     * @return PollsVoters
     */
    public function setVoterId(\AppBundle\Entity\Users $voterId = null)
    {
        $this->voterId = $voterId;

        return $this;
    }

    /**
     * Get voterId
     *
     * @return \AppBundle\Entity\Users
     */
    public function getVoterId()
    {
        return $this->voterId;
    }
}