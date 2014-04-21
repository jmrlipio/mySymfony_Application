<?php

namespace Jone\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jone\BlogBundle\Entity\Property;
use Jone\BlogBundle\Entity\PropertyRepository;
use Jone\BlogBundle\Form\PropertyType;

/**
 * Property controller.
 *
 */
class PropertyController extends Controller
{

    /**
     * Lists all Property entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('JoneBlogBundle:Property')->findAll();
        
        
        //~ $em = $this->getDoctrine()->getManager();
        //~ $entities = $em->getRepository('JoneBlogBundle:Property')->findLatestPropertybyId();
       
        return $this->render('JoneBlogBundle:Property:property.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Property entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Property();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('property_show', array('id' => $entity->getId())));
        }

        return $this->render('JoneBlogBundle:Property:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Property entity.
    *
    * @param Property $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Property $entity)
    {
        $form = $this->createForm(new PropertyType(), $entity, array(
            'action' => $this->generateUrl('property_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Property entity.
     *
     */
    public function newAction()
    {
        $entity = new Property();
        $form   = $this->createCreateForm($entity);

        return $this->render('JoneBlogBundle:Property:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Property entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JoneBlogBundle:Property')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Property entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JoneBlogBundle:Property:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Property entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JoneBlogBundle:Property')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Property entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JoneBlogBundle:Property:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Property entity.
    *
    * @param Property $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Property $entity)
    {
        $form = $this->createForm(new PropertyType(), $entity, array(
            'action' => $this->generateUrl('property_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Property entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JoneBlogBundle:Property')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Property entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('property_edit', array('id' => $id)));
        }

        return $this->render('JoneBlogBundle:Property:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Property entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JoneBlogBundle:Property')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Property entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('property'));
    }

    /**
     * Creates a form to delete a Property entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('property_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    //~ public function showLatestProject($id)
	//~ {
    //~ $em = $this->getDoctrine()->getManager();
        //~ $query = $em->createQuery(
        //~ 'SELECT MAX(p.id) FROM JoneBlogBundle:Product'
        //~ )
        //~ try{
			//~ $entities = $query->getSingleResult();
		//~ } catch (\Doctrine\Orm\NoResultException $e) {
			//~ $entities = null;
        //~ }
	//~ }
	
	 public function findLatestPropertybyId()
			{
				return $this->getEntityManager()
				->createQuery('SELECT MAX(id),property_detail,property_image,slug,date_published FROM JoneBlogBundle:Property')
				->getResult();
			}
}
