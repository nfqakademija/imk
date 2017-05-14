<?php

namespace AppBundle\Services;


use AppBundle\Entity\Category;
use AppBundle\Entity\Poll;
use AppBundle\Entity\PollOption;

class PostUploader
{
    private $em;
    private $fileUploader;
    private $poll;
    private $sequence;

    /**
     * PostUploader constructor.
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, FileUploader $fileUploader)
    {
        $this->em = $em;
        $this->fileUploader = $fileUploader;
        $this->poll = new Poll();
        $this->sequence = 1;

    }


    /**
     *Persists new post and associated data.
     *
     * @param string $title New post title
     * @param array $files Uploaded files/pictures
     * @param mixed $categoryNames tag/category names
     * @return void
     */
    public function insert($title, $files, $categoryNames)
    {

        if (!empty($title) and !empty($files) and !empty($categoryNames)) {


            $this->poll->setTitle($title);
            $this->poll->setCreateDate(new \DateTime("now"));
            $this->poll->setUpdateDate();

            $categoryNames = explode(' ', $categoryNames);
            foreach ($categoryNames as $name) {
                $exists = $this->em->getRepository('AppBundle:Category')->findOneBy(['title' => $name]);
                if (!$exists) {
                    $category = new Category();
                    $category->setTitle($name);
                    $this->poll->addCategory($category);
                    $this->em->persist($category);
                } else {
                    $this->poll->addCategory($exists);
                }

            }

            foreach ($files as $file) {
                $option = new PollOption();
                $fileName = $this->fileUploader->upload($file);
                $option->setContent($fileName);
                $option->setSequence($this->sequence);
                $option->setVotesCount(0);
                $option->setPollId($this->poll);
                $this->em->persist($option);
                $this->sequence += 1;
            }

            $this->em->persist($this->poll);
            $this->em->flush();
        }

    }

}