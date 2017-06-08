<?php

namespace BDE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="BDE\AppBundle\Repository\PictureRepository")
 */
class Picture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     * @ORM\Column(name="activity_id", type="integer")
     *
     */
    protected $activity_id;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Veuillez upload l'image au format jpeg")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    protected $image;

    /**
     *
     * @var string
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     *
     * @var string
     * @ORM\Column(name="file_name", type="string")
     */
    public $file_name;

    /**
     *
     * @var AppBundle\Entity\Activity
     * @ORM\ManyToOne(targetEntity="BDE\AppBundle\Entity\Activity", inversedBy="images")
     * @ORM\JoinColumn{name="activity_id", referencedColumnName="id", onDelete="cascade"}
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
     * Set activity_id
     *
     * @param integer $bikeId
     * @return ActivityImage
     */
    public function setActivityId($activityId)
    {
        $this->activity_id = $activityId;
        return $this;
    }

    /**
     * Get activity_id
     *
     * @return integer
     */
    public function getActivityId()
    {
        return $this->activity_id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ActivityImage
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
     * Set file_name
     *
     * @param string $fileName
     * @return ActivityImage
     */
    public function setFileName($fileName)
    {
        $this->file_name = $fileName;
        return $this;
    }

    /**
     * Get file_name
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set activity
     *
     * @param \BDE\AppBundle\Entity\Activity $activity
     *
     * @return ActivityImage
     */
    public function setActivity(\BDE\AppBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \BDE\AppBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    public function setImage(File $image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }


}
