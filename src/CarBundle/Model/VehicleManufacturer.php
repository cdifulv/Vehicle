<?php

namespace CarBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="vehicle_manufacturer")
 */

class VehicleManufacturer
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
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=255)
     *
     */
    private $manufacturer;

    /**
     * One Vehicle can be a part of many Manufacturers
     *
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="vehicleManufacturer", cascade={"persist"})
     */
    private $vehicles;

    /**
     * One Model can be a part of many Manufacturer
     *
     * @ORM\OneToMany(targetEntity="VehicleModels", mappedBy="manufacturers", cascade={"persist"})
     */
    private $vehicleModels;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return VehicleManufacturer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     * @return VehicleManufacturer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

    /**
     * @param mixed $vehicles
     * @return VehicleManufacturer
     */
    public function setVehicles($vehicles)
    {
        $this->vehicles = $vehicles;
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
     * @return VehicleManufacturer
     */
    public function setVehicleModels($vehicleModels)
    {
        $this->vehicleModels = $vehicleModels;
        return $this;
    }

}
