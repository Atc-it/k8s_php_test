<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client as GuzzleHttpClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations AS FOSRestBundleAnnotations;

class DefaultController extends FOSRestController
{

    /**
     * @FOSRestBundleAnnotations\View()
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $data = ["Hello World!!"];

        return $data;
    }
}
