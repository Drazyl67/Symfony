<?php

namespace BDE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="BDE\AppBundle\Repository\ActivityRepository")
 */
class Activity
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateActivity", type="datetime")
     */
    private $dateActivity;

    /**
     * @var float
     *
     * @ORM\Column(name="Price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     *
     * @ORM\Column(name="pictureSource", type="string")
#     * @ORM\OneToMany(targetEntity="BDE\AppBundle\Entity\Picture", mappedBy="Activity")
     */
    private $pictureSource;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="BDE\AppBundle\Entity\Picture", mappedBy="activity")
     */
    protected $images;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name ? $this->name : '';
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
     * Set name
     *
     * @param string $name
     * @return Activity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add images
     *
     * @param BDE\AppBundle\Entity\Picture $image
     * @return Activity
     */
    public function addImage($image)
    {
        $this->images[] = $image;
        $image->setActivity($this);
        return $this;
    }


    /**
     * Remove images
     *
     * @param BDE\AppBundle\Entity\Picture $image
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);
        $image->setActivity(null);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set dateActivity
     *
     * @param \DateTime $dateActivity
     * @return Activity
     */
    public function setDateActivity($dateActivity)
    {
        $this->dateActivity = $dateActivity;

        return $this;
    }

    /**
     * Get dateActivity
     *
     * @return \DateTime 
     */
    public function getDateActivity()
    {
        return $this->dateActivity;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Activity
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Activity
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
     * Set pictureSource
     *
     * @param string $pictureSource
     * @return Activity
     */
    public function setPictureSource($pictureSource)
    {
        $this->pictureSource = $pictureSource;

        return $this;
    }

    /**
     * Get pictureSource
     *
     * @return string 
     */
    public function getPictureSource()
    {
        return $this->pictureSource;
    }

    /**
     * Add pictureSource
     *
     * @param \BDE\AppBundle\Entity\Picture $pictureSource
     *
     * @return Activity
     */
    public function addPictureSource(\BDE\AppBundle\Entity\Picture $pictureSource)
    {
        $this->pictureSource[] = $pictureSource;

        return $this;
    }

    /**
     * Remove pictureSource
     *
     * @param \BDE\AppBundle\Entity\Picture $pictureSource
     */
    public function removePictureSource(\BDE\AppBundle\Entity\Picture $pictureSource)
    {
        $this->pictureSource->removeElement($pictureSource);
    }
}
