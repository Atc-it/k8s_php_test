<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Instance;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ));
    }

    private function getInstances(){
        $doctrine = $this->getDoctrine();
        return $doctrine->getRepository("AppBundle:Instance")->findAll();
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/dashboard.html.twig', ["instances"=>$this->getInstances()]);
    }

    /**
     * @Route("/display", name="display")
     */
    public function displayAction(Request $request)
    {
        // replace this example code with whatever you need
        $response = $this->render('default/display.html.twig', ["hostName"=>gethostname()]);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
