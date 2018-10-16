<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VehicleModelsController extends Controller
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\VehicleModels')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Service Item entity.');
        }

    }
}