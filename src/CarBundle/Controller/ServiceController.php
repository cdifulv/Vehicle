<?php

namespace CarBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarBundle\Model\Service;
use CarBundle\Form\ServiceType;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Model\Service controller.
 *
 */
class ServiceController extends Controller
{

    /**
     * Lists all Model\Service entities.
     *
     */
    public function indexAction($vehicleId)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarBundle:Model\Service')->findBy(array('vehicle' => $vehicleId));

        return $this->render('CarBundle:Service:index.html.twig', array(
            'entities' => $entities,
            'vehicleId' => $vehicleId
        ));
    }
    /**
     * Creates a new Model\Service entity.
     *
     */
    public function createAction($vehicleId, Request $request)
    {
        $service = new Service();
        $form = $this->createCreateForm($service, $vehicleId);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $vehicle = $em->getRepository('CarBundle:Model\Vehicle')->find($vehicleId);

            if ($vehicle === null) {
                throw new HttpException(404);
            }

            $vehicle->addService($service);

            $em->flush();

            return $this->redirect($this->generateUrl(
                'Service_show',
                array('id' => $service->getServiceID(), 'vehicleId' => $service->getVehicle()->getID()
            )));
        }

        return $this->render('CarBundle:Service:new.html.twig', array(
            'entity' => $service,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Model\Service entity.
     *
     * @param Service $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Service $entity, $vehicleId)
    {
        $form = $this->createForm(new ServiceType(), $entity, array(
            'action' => $this->generateUrl('Service_create', array('vehicleId' => $vehicleId)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Model\Service entity.
     *
     */
    public function newAction($vehicleId)
    {
        $entity = new Service();
        $form   = $this->createCreateForm($entity, $vehicleId);

        return $this->render('CarBundle:Service:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Model\Service entity.
     *
     */
    public function showAction($vehicleId, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\Service')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Model\Service entity.');
        }

        $deleteForm = $this->createDeleteForm($id, $vehicleId);

        return $this->render('CarBundle:Service:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Model\Service entity.
     *
     */
    public function editAction($vehicleId, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\Service')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Model\Service entity.');
        }

        $editForm = $this->createEditForm($entity, $vehicleId);
        $deleteForm = $this->createDeleteForm($id, $vehicleId);

        return $this->render('CarBundle:Service:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
    * Creates a form to edit a Model\Service entity.
    *
    * @param Service $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Service $entity, $vehicleId)
    {
        $form = $this->createForm(new ServiceType(), $entity, array(
            'action' => $this->generateUrl('Service_update', array('id' => $entity->getServiceID(), 'vehicleId' => $entity->getVehicle()->getID())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Model\Service entity.
     *
     */
    public function updateAction(Request $request, $id, $vehicleId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\Service')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Model\Service entity.');
        }

        $deleteForm = $this->createDeleteForm($id, $vehicleId);
        $editForm = $this->createEditForm($entity, $vehicleId);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Service_index', array('vehicleId'=> $vehicleId)));
        }

        return $this->render('CarBundle:Service:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Model\Service entity.
     *
     */
    public function deleteAction(Request $request, $id, $vehicleId)
    {
        $form = $this->createDeleteForm($id, $vehicleId);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CarBundle:Model\Service')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Model\Service entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Service_index', array('vehicleId'=> $vehicleId)));
    }

    /**
     * Creates a form to delete a Model\Service entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id, $vehicleId)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Service_delete', array('id' => $id, 'vehicleId' => $vehicleId)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
