<?php

namespace KaloriesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StatController extends Controller
{
    public function indexAction(Request $request){

        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $date_from = $request->query->get('date_from');
        $date_to = $request->query->get('date_to');



        $stats = $this->getDoctrine()->getManager()->getRepository('KaloriesBundle:Meal')
            ->findByUserFilterByDateGroupedByDay($usr,$date_from,$date_to);

        $userConfig = $this->getDoctrine()->getManager()->getRepository('KaloriesBundle:UserConfig')
            ->findOneBy(['user'=>$usr]);

        return $this->render('stat/index.html.twig',[
            'stats' => $stats,
            'day_calories' => $userConfig->getDayCalories()
        ]);
    }

}