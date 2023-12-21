<?php

namespace App\Controller; #definido que o arquivo pertence aos controllers

use App\Form\CursoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Curso;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\CursoRepository;

class CursoController extends AbstractController

{
    #[Route('/', name: 'curso_index')]
    public function index(Request $request,PaginatorInterface $pg, CursoRepository $cursoRepository): Response{

        $query = $cursoRepository->findAll();

        $data['cursos']  = $pg->paginate(
            $query,
            $request->query->get('page',1),
            5
        );

        return $this->render('curso/index.html.twig',$data);


    }

    #[Route('/curso/adicionar', name: 'curso_adicionar')]
    public function adicionar(Request $request,  EntityManagerInterface $em): Response {

        $curso = new Curso();
    
        $form = $this->createForm(CursoType::class, $curso);
        $data['titulo'] = 'Adicionar Categoria';
        $data['form'] = $form;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($curso);
            $em->flush();
        }

        return $this->renderForm('curso/form.html.twig', $data);

    }

    #[Route('curso/editar/{id}', name:'curso_editar')]
    public function editar($id, Request $request, EntityManagerInterface $em, CursoRepository $cursoRepository) : Response{

        $curso = $cursoRepository->find($id);
        $form = $this->createForm(CursoType::class, $curso);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($curso);
            $em->flush();
            return $this->redirectToRoute('curso_index');
        }

        $data['form'] = $form;
        return $this->renderForm('curso/form.html.twig',$data);

    }

    #[Route('curso/excluir/{id}', name:'curso_excluir')]
    public function excluir($id,Request $request, EntityManagerInterface $em, CursoRepository $cursoRepository){

        $curso = $cursoRepository->find($id);
        $em->remove($curso);
        $em->flush();

        return $this->redirectToRoute('curso_index');

        }

}


