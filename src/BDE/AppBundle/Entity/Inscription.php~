<?php

namespace BDE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="BDE\AppBundle\Repository\InscriptionRepository")
 */
class Inscription
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="BDE\UserBundle\Entity\User")
     * @ORM\JoinColumn{name="user", referencedColumnName="id"}
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="activity_id", type="integer")
     */
     private $activity;



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
     * Set user
     *
     * @param \BDE\UserBundle\Entity\User $user
     *
     * @return Inscription
     */
    public function setUser(\BDE\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BDE\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set activity
     *
     * @param \BDE\UserBundle\Entity\Activity $activity
     *
     * @return Inscription
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \BDE\UserBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }
}
