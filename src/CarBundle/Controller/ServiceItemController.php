<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CarBundle\Model\ServiceItem;
use CarBundle\Model\Service;


class ServiceItemController extends Controller
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\ServiceItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Service Item entity.');
        }

    }

}
