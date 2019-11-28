<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Validator\IsValidDNI;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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
            ->add('professionalIncome', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.professionalIncome',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('capitalIncome', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.capitalIncome',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('dependency', null, [
                'constraints' => [
                ],
                'label' => 'member.dependency',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('dependencyAmount', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.dependencyAmount',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
            ->add('numberOfHours', null, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'member.numberOfHours',
                'attr' => [
                    'class' => 'form-control-sm',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
