<?php

namespace App\Form;

use App\Entity\Expedient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpedientSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dni', null, [
                'constraints' => [
                ],
                'label' => 'expedient.dni',
            ])
            ->add('name', null, [
                'constraints' => [
                ],
                'label' => 'expedient.name',
            ])
            ->add('surname1', null, [
                'constraints' => [
                ],
                'label' => 'expedient.surname1',
            ])
            ->add('surname2', null, [
                'constraints' => [
                ],
                'label' => 'expedient.surname2',
            ])
            ->add('pensioner', null, [
                'constraints' => [
                ],
                'label' => 'expedient.pensioner',
            ])
            ->add('fromDate', null, [
                'constraints' => [
                ],
                'label' => 'expedient.fromDate',
            ])
            ->add('toDate', null, [
                'constraints' => [
                ],
                'label' => 'expedient.toDate',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
