<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as FOSRestBundleAnnotations;
use FOS\RestBundle\Controller\FOSRestController;
use Greetings\Hello;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @FOSRestBundleAnnotations\View()
 */
class DefaultController extends FOSRestController
{

    /**
     * @Route("/", name="helloWorld")
     */
    public function indexAction()
    {
            return new Hello();
    }
}
