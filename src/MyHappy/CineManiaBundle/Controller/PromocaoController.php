<?php

namespace MyHappy\CineManiaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MyHappy\CineManiaBundle\Entity\Promocao;
use MyHappy\CineManiaBundle\Form\PromocaoType;

/**
 * Promocao controller.
 *
 * @Route("/promocao")
 */
class PromocaoController extends Controller
{

    /**
     * Lists all Promocao entities.
     *
     * @Route("/", name="promocao")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MyHappyCineManiaBundle:Promocao')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Promocao entity.
     *
     * @Route("/", name="promocao_create")
     * @Method("POST")
     * @Template("MyHappyCineManiaBundle:Promocao:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Promocao();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('promocao_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Promocao entity.
    *
    * @param Promocao $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Promocao $entity)
    {
        $form = $this->createForm(new PromocaoType(), $entity, array(
            'action' => $this->generateUrl('promocao_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Promocao entity.
     *
     * @Route("/new", name="promocao_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Promocao();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Promocao entity.
     *
     * @Route("/{id}", name="promocao_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyHappyCineManiaBundle:Promocao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Promocao entity.
     *
     * @Route("/{id}/edit", name="promocao_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyHappyCineManiaBundle:Promocao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocao entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Promocao entity.
    *
    * @param Promocao $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Promocao $entity)
    {
        $form = $this->createForm(new PromocaoType(), $entity, array(
            'action' => $this->generateUrl('promocao_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Promocao entity.
     *
     * @Route("/{id}", name="promocao_update")
     * @Method("PUT")
     * @Template("MyHappyCineManiaBundle:Promocao:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MyHappyCineManiaBundle:Promocao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Promocao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('promocao_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Promocao entity.
     *
     * @Route("/{id}", name="promocao_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MyHappyCineManiaBundle:Promocao')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Promocao entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('promocao'));
    }

    /**
     * Creates a form to delete a Promocao entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('promocao_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
