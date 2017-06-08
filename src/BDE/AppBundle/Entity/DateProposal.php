<?php

namespace BDE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateProposal
 *
 * @ORM\Table(name="date_proposal")
 * @ORM\Entity(repositoryClass="BDE\AppBundle\Repository\DateProposalRepository")
 */
class DateProposal
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
     * @ORM\ManyToOne(targetEntity="BDE\AppBundle\Entity\ActivityProposal")
     * @ORM\JoinColumn{name="ActivityProposal", referencedColumnName="id"}
     */
    private $activityProposal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateProposal", type="datetime")
     */
    private $dateProposal;

    /**
     * @var string
     *
     * @ORM\Column(name="TimeProposal", type="string")
     */
    private $timeProposal;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="BDE\UserBundle\Entity\User")
     * @ORM\JoinColumn{name="user", referencedColumnName="id"}
     */
    private $user;

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
     * Set dateProposal
     *
     * @param \DateTime $dateProposal
     * @return DateProposal
     */
    public function setDateProposal($dateProposal)
    {
        $this->dateProposal = $dateProposal;

        return $this;
    }

    /**
     * Get dateProposal
     *
     * @return \DateTime 
     */
    public function getDateProposal()
    {
        return $this->dateProposal;
    }

    /**
     * Set timeProposal
     *
     * @param string $timeProposal
     *
     * @return DateProposal
     */
    public function setTimeProposal($timeProposal)
    {
        $this->timeProposal = $timeProposal;

        return $this;
    }

    /**
     * Get timeProposal
     *
     * @return string
     */
    public function getTimeProposal()
    {
        return $this->timeProposal;
    }

    /**
     * Set activityProposal
     *
     * @param \BDE\AppBundle\Entity\ActivityProposal $activityProposal
     *
     * @return DateProposal
     */
    public function setActivityProposal(\BDE\AppBundle\Entity\ActivityProposal $activityProposal = null)
    {
        $this->activityProposal = $activityProposal;

        return $this;
    }

    /**
     * Get activityProposal
     *
     * @return \BDE\AppBundle\Entity\ActivityProposal
     */
    public function getActivityProposal()
    {
        return $this->activityProposal;
    }

    /**
     * Set user
     *
     * @param \BDE\UserBundle\Entity\User $user
     *
     * @return DateProposal
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
}
