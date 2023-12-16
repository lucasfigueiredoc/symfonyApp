<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class NotationController extends AbstractController{
    /**
     * @Route("/notation/{nome}",name="notation")
     */
    public function index($nome): Response {

        return new Response($nome);
    }
}
