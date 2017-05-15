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
     * @param string $categoryNames tag/category names
     * @return void
     */
    public function insert($title, $files, $categoryNames)
    {

        if (!$title || !$files || !$categoryNames) {
            return;
        }

        $this->poll->setTitle($title);
        $this->poll->setCreateDate(new \DateTime("now"));
        $this->poll->setUpdateDate();

        $categoryNames = array_filter(explode(' ', $categoryNames));
        $categoryNames = array_unique($categoryNames);

        $this->persistAllCategories($categoryNames);
        $this->persistAllFiles($files);

        $this->em->persist($this->poll);
        $this->em->flush();
    }


    /**
     * @param array $categories
     * @return void
     */
    private function persistAllCategories($categories)
    {

        foreach ($categories as $name) {
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
    }


    /**
     * @param array $files
     * @return void
     */
    private function persistAllFiles($files)
    {
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
    }

}