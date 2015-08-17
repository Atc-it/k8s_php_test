<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client as GuzzleHttpClient;
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

    private function getInstances()
    {
        $client = new GuzzleHttpClient();
        $response = $client->get('https://10.0.0.1/api/v1/pods', ['verify' => false]);
        $apiResponse = json_decode($response->getBody()->getContents());
        $response = [];
        foreach ($apiResponse->items as $item) {
            if (strpos($item->metadata->name, "k8s-test-app") !== false) {
                $response[] = $item->status->podIP;
            }
        }
        return $response;
    }

    private function renderInstances($instances)
    {
        $renders = [];
        foreach ($instances as $instance) {
            $client = new GuzzleHttpClient();
            $response = $client->get(sprintf('http://%s/app_dev.php/display', $instance));
            $renders[] = $response->getBody()->getContents();
        }
        return $renders;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/dashboard.html.twig', ["renders" => $this->renderInstances($this->getInstances())]);
    }

    /**
     * @Route("/display", name="display")
     */
    public function displayAction(Request $request)
    {
        return $this->render('default/display.html.twig', ["hostName" => gethostname()]);
    }
}
