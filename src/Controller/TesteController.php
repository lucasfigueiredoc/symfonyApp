<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TesteController extends AbstractController
{
    public function index() : Response {
        $data['nome'] = 'Lucas';
        $data['lista'] = [
            [
                'nome'=> 'banana',
                'valor'=> 232
            ],
            [
                'nome'=> 'sa',
                'valor'=> 23223
            ],
            [
                'nome'=> 'ds',
                'valor'=> 23223
            ]

        ];
        return $this->render('teste/index.html.twig', $data);
    }
    public function second($id): Response {
        return new Response($id);
    }
}