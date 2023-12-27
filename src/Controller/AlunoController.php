<?php

namespace App\Controller; #definido que o arquivo pertence aos controllers
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AlunoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Aluno;
use App\Form\AlunoType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;

class AlunoController extends AbstractController
{
    #[Route('/aluno', name: 'aluno_index')]
    public function index(Request $request,AlunoRepository $alunoRepository, PaginatorInterface $pg): Response{

        $nomeAluno =  $request->query->get('nome');

        $data['alunos'] = is_null($nomeAluno)
                        ? $alunoRepository->findAll()
                        : $alunoRepository->findAlunoByLikeNome($nomeAluno);
          
        $data['nome'] = $nomeAluno;
        $query = $alunoRepository->findAll();

        $data['alunos'] = $pg->paginate(
            $query,
            $request->query->get('page', 1),
            5
        );

        return $this->render('aluno/index.html.twig',$data);

    }

    #[Route('aluno/adicionar', name: 'aluno_adicionar')]
    public function adicioar(Request $request, EntityManagerInterface $em ): Response{


        $aluno = new Aluno();

        $form = $this->createForm(AlunoType::class,$aluno);
        $data['titulo'] = 'Adicionar Aluno';
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($aluno);
            $em->flush();
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
        }



        $data['form'] = $form;
        return $this->renderForm('aluno/form.html.twig',$data);

    }
    
    #[Route('aluno/editar/{id}', name: 'aluno_editar')]
    public function editar($id, Request $request, EntityManagerInterface $em, AlunoRepository $alunoRepository): Response{

        $aluno = $alunoRepository->find($id);
        $form = $this->createForm(AlunoType::class, $aluno);
        $form->handleRequest($request);
        $data['titulo'] = 'Editar aluno' ;

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($aluno);
            $em->flush();

            return $this->redirectToRoute('aluno_index');

        }

        $data['form'] = $form;
        return $this->renderForm('aluno/form.html.twig',$data);

    }

    #[Route('aluno/excluir/{id}', name: 'aluno_excluir')]
    public function excluir(AlunoRepository $alunoRepository, $id, EntityManagerInterface $em, Request $request): Response{

        $aluno = $alunoRepository->find($id);
        $em->remove($aluno);
        $em->flush();

        return $this->redirectToRoute('aluno_index');

    }



}

