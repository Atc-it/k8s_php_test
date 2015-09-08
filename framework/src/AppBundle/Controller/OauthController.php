<?php

namespace AppBundle\Controller;

use AppBundle\Form\ClientType;
use GuzzleHttp\Client as GuzzleHttpClient;
use FOS\RestBundle\Controller\Annotations as FOSRestBundleAnnotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * @FOSRestBundleAnnotations\View()
 */
class OauthController extends FOSRestController implements ClassResourceInterface
{

    /**
     * Create a new oauth client
     *
     * @ApiDoc(
     *  section="OAuth",
     *  description="Create a new OAuth client",
     *  input="AppBundle\Form\ClientType",
     *  output="AppBundle\Entity\Client",
     *  statusCodes={
     *         200="Returned when successful"
     *  },
     *  tags={
     *   "stable" = "#4A7023",
     *   "need validations" = "#ff0000"
     *  }
     * )
     */
    public function postAction(Request $request)
    {
        $clientManager = $this->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $clientForm = $this->createForm(new ClientType(), $client);

        $clientForm->handleRequest($request);

        if ($clientForm->isValid()) {
            $clientManager->updateClient($client);

            $customer = $this->getDoctrine()->getRepository('AppBundle:Customer')->find('55ef2f09d359e');

            $queryData = [];
            $queryData['client_id'] = $client->getPublicId();
            $queryData['redirect_uri'] = $client->getRedirectUris()[0];
            $queryData['response_type'] = 'code';
            $authRequest = new Request($queryData);

            $oauthServer = $this->get('fos_oauth_server.server');
            $oauthServer->finishClientAuthorization(true, $customer, $authRequest, 'code');

            $queryData = [];
            $queryData['grant_type'] = 'code';
            $grantRequest = new Request($queryData);

            $oauthServer->grantAccessToken($grantRequest);

            return $client;
        }

        return $clientForm->getErrors();
    }
}
