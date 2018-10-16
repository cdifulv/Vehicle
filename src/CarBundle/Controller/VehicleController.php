<?php

namespace CarBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

use CarBundle\Model\VehicleModels;
use CarBundle\Model\VehicleManufacturer;
use CarBundle\Model\Vehicle;
use CarBundle\Form\VehicleType;

/**
 * Model\Vehicle controller.
 *
 */
class VehicleController extends Controller
{

    /**
     * Lists all Model\Vehicle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarBundle:Model\Vehicle')->findAll();

        return $this->render('CarBundle:Vehicle:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Model\Vehicle entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Vehicle();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Vehicle_show', array('id' => $entity->getId())));
        }

        return $this->render('CarBundle:Vehicle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Model\Vehicle entity.
     *
     * @param Vehicle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vehicle $entity)
    {
        $form = $this->createForm(new VehicleType(), $entity, array(
            'action' => $this->generateUrl('Vehicle_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Model\Vehicle entity.
     *
     */
    public function newAction()
    {
        $entity = new Vehicle();
        $form   = $this->createCreateForm($entity);

        return $this->render('CarBundle:Vehicle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Model\Vehicle entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\Vehicle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Model\Vehicle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarBundle:Vehicle:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Model\Vehicle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\Vehicle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Model\Vehicle entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarBundle:Vehicle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Model\Vehicle entity.
    *
    * @param Vehicle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vehicle $entity)
    {
        $form = $this->createForm(new VehicleType(), $entity, array(
            'action' => $this->generateUrl('Vehicle_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Model\Vehicle entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarBundle:Model\Vehicle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Model\Vehicle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Vehicle_edit', array('id' => $id)));
        }

        return $this->render('CarBundle:Vehicle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Model\Vehicle entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CarBundle:Model\Vehicle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Model\Vehicle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Vehicle'));
    }

    /**
     * Creates a form to delete a Model\Vehicle entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Vehicle_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
