<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Curso;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AlunoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class)
            ->add('dtnascimento', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('telefone', TextType::class)
            ->add('endereco',TextType::class)
            ->add('curso', EntityType::class,[
                'class' => Curso::class,
                'choice_label' => 'nomecurso' 
            ])
            ->add('Salvar', SubmitType::class);
 
    }

}

