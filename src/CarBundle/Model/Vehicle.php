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

    /**
     * Many Vehicles have One Manufacturer.
     * @ORM\ManyToOne(targetEntity="VehicleManufacturer", inversedBy="vehicles")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")
     */
    private $vehicleManufacturer;

    /**
     * Many Vehicles have One Model.
     * @ORM\ManyToOne(targetEntity="VehicleModels", inversedBy="vehicles")
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     */
    private $vehicleModels;

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

    /**
     * @return mixed
     */
    public function getVehicleManufacturer()
    {
        return $this->vehicleManufacturer;
    }

    /**
     * @param mixed $vehicleManufacturer
     * @return Vehicle
     */
    public function setVehicleManufacturer($vehicleManufacturer)
    {
        $this->vehicleManufacturer = $vehicleManufacturer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVehicleModels()
    {
        return $this->vehicleModels;
    }

    /**
     * @param mixed $vehicleModels
     * @return Vehicle
     */
    public function setVehicleModels($vehicleModels)
    {
        $this->vehicleModels = $vehicleModels;
        return $this;
    }




}
