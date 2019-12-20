<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Quota;

class QuotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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
            ->add('numberOfHours', null, [
                'constraints' => [
                ],
                'label' => 'quota.numberOfHours',
            ])
            ->add('pensioner', null, [
                'constraints' => [
                ],
                'label' => 'quota.pensioner',
            ])
            ->add('incomeAndAid', null, [
                'constraints' => [
                ],
                'label' => 'quota.incomeAndAid',
            ])
            ->add('heritage', null, [
                'constraints' => [
                ],
                'label' => 'quota.heritage',
            ])
            ->add('housingExpediture', null, [
                'constraints' => [
                ],
                'label' => 'quota.housingExpediture',
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
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'quota.sexFemale' => 'F',
                    'quota.sexMale' => 'M',
                ],
                'constraints' => [
                ],
                'multiple' => false,
                'expanded' => true,
//                'label' => 'quota.sex',
            ])
            ->add('housingBonus', null, [
                'constraints' => [
                ],
                'label' => 'quota.housingBonus',
            ])
            ->add('dependencyBonus', null, [
                'constraints' => [
                ],
                'label' => 'quota.dependencyBonus',
            ])
            ->add('totalHouseholdIncome', null, [
                'constraints' => [
                ],
                'label' => 'quota.totalHouseholdIncome',
            ])
            ->add('equityIncrease', null, [
                'constraints' => [
                ],
                'label' => 'quota.equityIncrease',
            ])
            ->add('monthlyContribution', null, [
                'constraints' => [
                ],
                'label' => 'quota.monthlyContribution',
            ])
            ->add('pricePerHour', null, [
                'constraints' => [
                ],
                'label' => 'quota.pricePerHour',
            ])
            ->add('members', CollectionType::class, [
                'entry_type' => MemberType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quota::class,
            'validation_groups' => ['Default', 'saveQuota'],
        ]);
    }
}
