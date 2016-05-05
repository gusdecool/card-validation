<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CreditCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as FrameworkExtra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class CreditCardController extends Controller
{
    /**
     * @FrameworkExtra\Route("/", name="home_get")
     * @FrameworkExtra\Method("GET")
     * @FrameworkExtra\Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @FrameworkExtra\Route("/", name="home_post")
     * @FrameworkExtra\Method("POST")
     *
     * @param Request $request
     * @return array
     */
    public function postAction(Request $request)
    {
        $response = new JsonResponse();

        try {
            $creditCard = $this->get('jms_serializer')->deserialize($request->getContent(), CreditCard::class, 'json');

            $this->get('app.manager.credit_card')->save($creditCard);
            $response->setStatusCode(204);
        } catch (HttpExceptionInterface $exception) {
            $response->setData(['code' => $exception->getStatusCode(), 'message' => $exception->getMessage()]);
            $response->setStatusCode($exception->getStatusCode());
        }

        $this->getDoctrine()->getManager()->flush();

        return $response;
    }
}
