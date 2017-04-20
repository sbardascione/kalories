<?php

namespace KaloriesBundle\Controller;

use KaloriesBundle\Entity\UserConfig;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Userconfig controller.
 *
 */
class UserConfigController extends Controller
{
    /**
     * Lists all userConfig entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $userConfigs = $em->getRepository('KaloriesBundle:UserConfig')->findBy(['user' => $usr]);

        return $this->render('userconfig/index.html.twig', array(
            'userConfigs' => $userConfigs,
        ));
    }

    /**
     * Creates a new userConfig entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $userConfigs = $em->getRepository('KaloriesBundle:UserConfig')->findOneBy(['user' => $usr]);

        if(!$userConfigs){
            $userConfig = new UserConfig();
            $userConfig->setUser($this->get('security.token_storage')->getToken()->getUser());
            $form = $this->createForm('KaloriesBundle\Form\UserConfigType', $userConfig);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($userConfig);
                $em->flush();

                return $this->redirectToRoute('userconfig_show', array('id' => $userConfig->getId()));
            }

            return $this->render('userconfig/new.html.twig', array(
                'userConfig' => $userConfig,
                'form' => $form->createView(),
            ));
        }else{
            return $this->redirectToRoute('userconfig_edit', array('id' => $userConfigs->getId()));
        }


    }

    /**
     * Finds and displays a userConfig entity.
     *
     */
    public function showAction(UserConfig $userConfig)
    {
        $deleteForm = $this->createDeleteForm($userConfig);

        return $this->render('userconfig/show.html.twig', array(
            'userConfig' => $userConfig,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userConfig entity.
     *
     */
    public function editAction(Request $request, UserConfig $userConfig)
    {
        $deleteForm = $this->createDeleteForm($userConfig);
        $editForm = $this->createForm('KaloriesBundle\Form\UserConfigType', $userConfig);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userconfig_edit', array('id' => $userConfig->getId()));
        }

        return $this->render('userconfig/edit.html.twig', array(
            'userConfig' => $userConfig,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userConfig entity.
     *
     */
    public function deleteAction(Request $request, UserConfig $userConfig)
    {
        $form = $this->createDeleteForm($userConfig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userConfig);
            $em->flush();
        }

        return $this->redirectToRoute('userconfig_index');
    }

    /**
     * Creates a form to delete a userConfig entity.
     *
     * @param UserConfig $userConfig The userConfig entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserConfig $userConfig)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userconfig_delete', array('id' => $userConfig->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
