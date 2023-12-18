<?php

namespace App\Form;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class CursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder
            ->add('nomecurso', TextType::class, ['label' => 'Nome do Curso'])
            ->add('duracaocursomeses', TextType::class, ['label' => 'Duraçao do Curso'])
            ->add('datapublicacao', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',])
            ->add('Salvar', SubmitType::class);


    }

}

