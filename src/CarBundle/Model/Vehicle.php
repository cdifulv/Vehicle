<?php

namespace CarBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="vehicles")
 */

class Vehicle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer")
     *
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="make", type="string", length=255)
     *
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var integer
     *
     * @ORM\Column(name="odometer", type="integer")
     */
    private $odometer;

    /**
     * One Vehicle has Many Services
     *
     * @ORM\OneToMany(targetEntity="Service", mappedBy="vehicle", cascade={"persist"})
     */
    private $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }
    public function __toString()
    {
        return strval($this->id);
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services->toArray();
    }

    public function addService(Service $service)
    {
        if ($this->services->contains($service)) {
            throw new \Exception("Cannot add same service twice");
        }

        $this->services->add($service);
        $service->setVehicle($this);
    }

    public function removeService(Service $service)
    {
      $this->services->removeElement($service);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return Vehicle
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @param string $make
     * @return Vehicle
     */
    public function setMake($make)
    {
        $this->make = $make;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Vehicle
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return float
     */
    public function getOdometer()
    {
        return $this->odometer;
    }

    /**
     * @param float $odometer
     * @return Vehicle
     */
    public function setOdometer($odometer)
    {
        $this->odometer = $odometer;
        return $this;
    }


}
