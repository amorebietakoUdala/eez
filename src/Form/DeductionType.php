<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dependencyPercentage', null, [
                'constraints' => [
                ],
                'label' => 'deduction.dependencyPercentage',
            ])
            ->add('dependencyMaximum', null, [
                'constraints' => [
                ],
                'label' => 'deduction.dependencyMaximum',
            ])
            ->add('rentalPercentage', null, [
                'constraints' => [
                ],
                'label' => 'deduction.rentalPercentage',
            ])
            ->add('rentalMaximum', null, [
                'constraints' => [
                ],
                'label' => 'deduction.rentalMaximum',
            ])
            ->add('mortgagePercentage', null, [
                'constraints' => [
                ],
                'label' => 'deduction.mortgagePercentage',
            ])
            ->add('mortgageMaximum', null, [
                'constraints' => [
                ],
                'label' => 'deduction.mortgageMaximum',
            ])
            ->add('realPricePerHour', null, [
                'constraints' => [
                ],
                'label' => 'deduction.realPricePerHour',
            ])
            ->add('maximumPricePerHour', null, [
                'constraints' => [
                ],
                'label' => 'deduction.maximumPricePerHour',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
