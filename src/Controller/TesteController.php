<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TesteController extends AbstractController
{
    public function index() : Response {
        return new Response('teste');
    }
    public function second($id): Response {
        return new Response($id);
    }
}