<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Entity\Project;
use App\Entity\User;

class UserUpsertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('firstname', TextType::class, [
            'required'      => true,
            'label'         => 'Firstname',
            'constraints'   => new NotBlank(),
        ]);
        $builder->add('lastname', TextType::class, [
            'required'      => true,
            'label'         => 'Lastname',
            'constraints'   => new NotBlank(),
        ]);
        $builder->add('project', EntityType::class, [
            'class'             => Project::class,
            'required'          => true,
            'label'             => 'Assigned to',
            'placeholder'       => 'Choose a project',
            'attr'      => [
                'class'     => 'select2'
            ],
        ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}