<?php

namespace BDE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityProposal
 *
 * @ORM\Table(name="activity_proposal")
 * @ORM\Entity(repositoryClass="BDE\AppBundle\Repository\ActivityProposalRepository")
 */
class ActivityProposal
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /*
     * @ORM\OneToOne(targetEntity="BDE\UserBundle\Entity\Users")
     * @ORM\JoinColumn{nullable=false}
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="LikeActivity", type="integer")
     */
    private $likeActivity;


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
     * Set title
     *
     * @param string $title
     * @return ActivityProposal
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
     * Set description
     *
     * @param string $description
     * @return ActivityProposal
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set likeActivity
     *
     * @param integer $likeActivity
     * @return ActivityProposal
     */
    public function setLikeActivity($likeActivity)
    {
        $this->likeActivity = $likeActivity;

        return $this;
    }

    /**
     * Get likeActivity
     *
     * @return integer 
     */
    public function getLikeActivity()
    {
        return $this->likeActivity;
    }
}
