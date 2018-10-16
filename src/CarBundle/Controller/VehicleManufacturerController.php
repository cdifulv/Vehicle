<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VehicleManufacturerController extends Controller
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\VehicleManufacturer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Service Item entity.');
        }

    }
}
