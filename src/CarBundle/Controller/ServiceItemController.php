<?php

namespace CarBundle\Controller;

use http\Env\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarBundle\Model\ServiceItem;
use CarBundle\Form\ServiceType;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Model\ServiceItem controller.
 *
 */
class ServiceItemController extends Controller
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $item = $em->getRepository('CarBundle:Model\Service')->find($id);

        if (!$item){
            throw $this->createNotFoundException(
                'No Service Item found for id'.$id);
        }
    }
}
