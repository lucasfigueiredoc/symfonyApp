<?php

namespace App\Controller; #definido que o arquivo pertence aos controllers
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AlunoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AlunoController extends AbstractController
{
    #[Route('/aluno', name: 'aluno_index')]
    public function index(AlunoRepository $alunoRepository): Response{

        $data['alunos'] = $alunoRepository->findAll();

        return $this->render('aluno/index.html.twig',$data);

    }
}

