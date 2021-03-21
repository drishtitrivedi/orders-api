<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\OrderType;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OrdersController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/", name="contacts")
     */
    public function index(Request $request)
    {      
        return $this->render('orders/index.html.twig', [
            'orders' => 'My Orders',
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */

    public function create(Request $request)
    {
        $form = $this->createForm(OrderType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $body = $form["body"]->getData();

            $response = $this->client->request(
                'POST',
                'http://localhost:8001/public/api/order', [
                    "body" => $body
                ]
            );

            $statusCode = $response->getStatusCode();

            $contentType = $response->getHeaders()['content-type'][0];

            $content = $response->getContent();

            $responseObject = [ 'statusCode' => $statusCode,
                                 'contentType' => $contentType,
                                 'content' => $content];

            return $this->render('orders/create.html.twig',[
                'form' => $form->createView(),
                'response_object' => $responseObject
            ]);
        }

        return $this->render('orders/create.html.twig',[
            'form' => $form->createView()
        ]);
    
    }
}
