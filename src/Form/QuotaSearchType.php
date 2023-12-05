<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuotaSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni', null, [
                'constraints' => [
                ],
                'label' => 'quota.dni',
            ])
            ->add('name', null, [
                'constraints' => [
                ],
                'label' => 'quota.name',
            ])
            ->add('surname1', null, [
                'constraints' => [
                ],
                'label' => 'quota.surname1',
            ])
            ->add('surname2', null, [
                'constraints' => [
                ],
                'label' => 'quota.surname2',
            ])
            ->add('pensioner', null, [
                'constraints' => [
                ],
                'label' => 'quota.pensioner',
            ])
            ->add('fromDate', null, [
                'constraints' => [
                ],
                'label' => 'quota.fromDate',
            ])
            ->add('toDate', null, [
                'constraints' => [
                ],
                'label' => 'quota.toDate',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
