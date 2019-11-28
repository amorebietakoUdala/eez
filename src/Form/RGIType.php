<?php

namespace App\Form;

use App\Entity\RGI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RGIType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oneMemberMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.oneMemberMaximum',
            ])
            ->add('oneMemberHeritageMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.oneMemberHeritageMaximum',
            ])
            ->add('oneMemberPensionerMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.oneMemberPensionerMaximum',
            ])
            ->add('oneMemberPensionerHeritageMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.oneMemberHeritagePensionerMaximum',
            ])
            ->add('twoMemberMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.twoMemberMaximum',
            ])
            ->add('twoMemberHeritageMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.twoMemberHeritageMaximum',
            ])
            ->add('twoMemberPensionerMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.twoMemberPensionerMaximum',
            ])
            ->add('twoMemberPensionerHeritageMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.twoMemberPensionerHeritageMaximum',
            ])
            ->add('threeOrMoreMemberMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.threeOrMoreMemberMaximum',
            ])
            ->add('threeOrMoreMemberHeritageMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.threeOrMoreMemberHeritageMaximum',
            ])
            ->add('threeOrMoreMemberPensionerMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.threeOrMoreMemberPensionerMaximum',
            ])
            ->add('threeOrMoreMemberPensionerHeritageMaximum', null, [
                'constraints' => [
                ],
                'label' => 'rgi.threeOrMoreMemberPensionerHeritageMaximum',
            ])
            ->add('maximumPricePerHour', null, [
                'constraints' => [
                ],
                'label' => 'rgi.maximumPricePerHour',
            ])
            ->add('minimumPricePerHour', null, [
                'constraints' => [
                ],
                'label' => 'rgi.minimumPricePerHour',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RGI::class,
        ]);
    }
}
