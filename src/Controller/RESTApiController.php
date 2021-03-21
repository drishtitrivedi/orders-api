<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * REST controller.
 * @Route("/api",name="api_")
 * */

class RESTApiController extends AbstractFOSRestController
{
   
    /**
    * List all Contacts.
    *@Rest\Get("/contacts")
    *
    *@return Response
    */

    public function getContacts()
    {
        return new JsonResponse([
            'name' => "Carlos",
            'age' => 22,
            'location' => [
                'city' => 'Bucaramanga',
                'state' => 'Santander',
                'country' => 'Colombia',
            ],
            'contact' => [
                'phone' => '608-898-5487',
                'email' => 'email@example.com'
            ]
        ]);
    }

    /**
    * Create new order.
    *@Rest\GET("/order")
    *
    *@return Response
    */

    public function getOrder(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        return new JsonResponse($request->getContent());
    }

    /**
    * Create new order.
    *@Rest\Post("/order")
    *
    *@return Response
    */   

    public function postOrder(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        $price_value = ['iPhone 11' => '1000', "wired-charger" => '15', "wireless-charger" => '25', 'earpods' => '100', 'screen-protactor' => '15', 'case' => '12'];
        $client_details = [
            "orderNumber" => "001",
            "name" => $data['contact']['firstName']." ".$data['contact']['lastName'],
            "phone" => $data['contact']['phone'],
            "email" => $data['contact']['email']
        ];
        $total = 0;
        $order_details = [
            'item' => [
                "itemName" => $data['item'],
                "price" => '$'.$price_value[$data['item']],
                "quantity" => $data['quantity'],
                "subtotal" => '$'.$data['quantity'] * $price_value[$data['item']],
            ],
        ];
        $total += $data['quantity'] * $price_value[$data['item']];
        $i = 1;
        foreach($data['additional-items'] as $key => $value) {
            $arr = [
                "itemName" => $key,
                "price" => '$'.$price_value[$key],
                "quantity" => $value,
                "subtotal" => '$'.$value * $price_value[$key],
            ];
            $order_details['item'.$i] = $arr;
            $total += $value * $price_value[$key];
            $i++;
        }
        $order_details['total'] = $total;
        $request = array_merge($client_details,$order_details);
        return new JsonResponse($request);
    }
}