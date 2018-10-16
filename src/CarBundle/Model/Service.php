<?php

namespace CarBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="service")
 */
class Service
{
    /**
     * @var integer
     *
     * @ORM\Column(name="service_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $serviceID;

    /**
     * @var integer
     *
     * @ORM\Column(name="service_date", type="datetime")
     *
     */
    private $serviceDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="service_mileage", type="integer")
     */
    private $serviceMileage;

    /**
     * Many Services have One Vehicle.
     * @ORM\ManyToOne(targetEntity="Vehicle", inversedBy="services")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     */
    private $vehicle;

    /**
     * Many Services have the same service Item.
     * @ORM\ManyToOne(targetEntity="ServiceItem", inversedBy="services")
     * @ORM\JoinColumn(name="service_item_id", referencedColumnName="id")
     */
    private $serviceItem;

    /**
     * @return int
     */
    public function getServiceID()
    {
        return $this->serviceID;
    }

    /**
     * @param int $serviceID
     * @return Service
     */
    public function setServiceID($serviceID)
    {
        $this->serviceID = $serviceID;
        return $this;
    }

    /**
     * @return int
     */
    public function getServiceDate()
    {
        return $this->serviceDate;
    }

    /**
     * @param int $serviceDate
     * @return Service
     */
    public function setServiceDate($serviceDate)
    {
        $this->serviceDate = $serviceDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param mixed $vehicle
     * @return Service
     */
    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * @return int
     */
    public function getServiceMileage()
    {
        return $this->serviceMileage;
    }

    /**
     * @param int $serviceMileage
     * @return Service
     */
    public function setServiceMileage($serviceMileage)
    {
        $this->serviceMileage = $serviceMileage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiceItem()
    {
        return $this->serviceItem;
    }

    /**
     * @param mixed $serviceItem
     * @return Service
     */
    public function setServiceItem($serviceItem)
    {
        $this->serviceItem = $serviceItem;
        return $this;
    }


}
