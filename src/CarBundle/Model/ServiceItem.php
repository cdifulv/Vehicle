<?php

namespace CarBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="service_item")
 */

class ServiceItem
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
     * @ORM\Column(name="item_type", type="string", length=255)
     *
     */
    private $itemType;

    /**
     * One Service Item can be a part of many Services
     *
     * @ORM\OneToMany(targetEntity="Service", mappedBy="serviceItem", cascade={"persist"})
     */
    private $services;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ServiceItem
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * @param string $itemType
     * @return ServiceItem
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param mixed $services
     * @return ServiceItem
     */
    public function setServices($services)
    {
        $this->services = $services;
        return $this;
    }
}

