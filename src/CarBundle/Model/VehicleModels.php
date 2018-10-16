<?php

namespace CarBundle\Model;

use Doctrine\ORM\Mapping as ORM;

    /**
     *
     * @ORM\Entity
     * @ORM\Table(name="vehicle_model")
     */
class VehicleModels
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
     * @ORM\Column(name="model", type="string", length=255)
     *
     */
    private $model;

    /**
     * One Model can be a part of many Vehicles
     *
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="vehicleModels", cascade={"persist"})
     */
    private $vehicles;

    /**
     * Many Models have the same Manufacturer.
     * @ORM\ManyToOne(targetEntity="VehicleManufacturer", inversedBy="vehicleModels")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")
     */
    private $manufacturers;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return VehicleModels
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return VehicleModels
     */
    public function setModel($model)
    {
        $this->model = $model;
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
     * @return VehicleModels
     */
    public function setVehicles($vehicles)
    {
        $this->vehicles = $vehicles;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getManufacturers()
    {
        return $this->manufacturers;
    }

    /**
     * @param mixed $manufacturers
     * @return VehicleModels
     */
    public function setManufacturers($manufacturers)
    {
        $this->manufacturers = $manufacturers;
        return $this;
    }
}
