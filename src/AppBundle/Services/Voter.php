<?php

namespace AppBundle\Services;

use AppBundle\Entity\PollVoter;
use Symfony\Component\Config\Definition\Exception\Exception;

class Voter
{
    private $em;


    /**
     * Voter constructor.
     */
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @param int $pollId
     * @param int $optionId
     * @param string $userIp
     * @param string $userAgent
     * @return array
     */
    public function vote($pollId, $optionId, $userIp, $userAgent)
    {

        if (!$pollId || !$optionId || !$userIp || !$userAgent) {
            return ["success" => false, "error" => "No data received."];
        }

        $poll = $this->em->getRepository('AppBundle:Poll')->find($pollId);
        $checkIfVoted = $this->em->getRepository('AppBundle:PollVoter')
            ->findOneBy(['voterIp' => $userIp, 'userAgent' => $userAgent, 'pollId' => $poll]);

        if ($checkIfVoted) {
            return ["success" => false, "error" => "You have already voted on this poll."];
        }

        $option = $this->em->getRepository('AppBundle:PollOption')->find($optionId);

        if (!$option) {
            return ["success" => false, "error" => "Vote option not found"];
        }

        $voter = new PollVoter();
        $voter->setUserAgent($userAgent);
        $voter->setVoterIp($userIp);
        $voter->setVoteOptionId($optionId);
        $voter->setPollId($poll);
        $this->em->persist($voter);

        $voteCount = $option->incrementVoteCount();

        try {
            $this->em->flush();
        } catch (Exception $e) {
            return ["success" => false, "error" => "Error saving data"];
        }


        return ["success" => true, "voteCount" => $voteCount];
    }
}
