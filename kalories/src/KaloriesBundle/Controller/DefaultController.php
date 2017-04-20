<?php

namespace KaloriesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $mealsRepository = $this->getDoctrine()->getRepository('KaloriesBundle:Meal');

        $meals = $mealsRepository->findBy('user',$usr);

        return $this->render('KaloriesBundle:Default:index.html.twig',$meals);
    }
}
