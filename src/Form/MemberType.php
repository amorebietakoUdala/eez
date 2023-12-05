<?php

namespace App\Form;

use App\Entity\Member;
use App\Validator\IsValidDNI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni', null, [
                'constraints' => [
                    new NotBlank(),
                    new IsValidDNI(),
                ],
                'label' => 'member.dni',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('name', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.name',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('surname1', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.surname1',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('surname2', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.surname2',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('incomeAndAid', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.incomeAndAid',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('heritage', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.heritage',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('dependencyGrade', ChoiceType::class, [
                'choices' => [
                    'quota.dependencyGrade0' => null,
                    'quota.dependencyGrade1' => 1,
                    'quota.dependencyGrade2' => 2,
                    'quota.dependencyGrade3' => 3,
                ],
                'label' => 'quota.dependencyGrade',
            ])
            ->add('discapacity65', null, [
                'constraints' => [
                ],
                'label' => 'quota.discapacity65',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
            'validation_groups' => ['Default', 'saveQuota'],
        ]);
    }
}
