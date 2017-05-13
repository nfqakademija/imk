<?php

namespace AppBundle\Services;


use AppBundle\Entity\Category;
use AppBundle\Entity\Poll;
use AppBundle\Entity\PollOption;

class PostUploader
{
    private $title;
    private $files;
    private $categoryNames;
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
     * @return void
     */
    public function insert()
    {

        if (!empty($this->title) and !empty($this->files) and !empty($this->categoryNames)) {


            $this->poll->setTitle($this->title);
            $this->poll->setCreateDate(new \DateTime("now"));
            $this->poll->setUpdateDate();

            foreach ($this->categoryNames as $name) {
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

            foreach ($this->files as $file) {
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

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCategoryNames()
    {
        return $this->categoryNames;
    }

    /**
     * @param mixed $categoryNames
     */
    public function setCategoryNames($categoryNames)
    {
        $categoryNames = explode(' ', $categoryNames);
        $this->categoryNames = $categoryNames;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

}