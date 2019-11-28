<?php

namespace App\Form;

use App\Entity\Expedient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Validator\IsValidDNI;

class ExpedientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dni', null, [
                'constraints' => [
//                    new IsValidDNI(),
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
            ->add('incomeAndAid', null, [
                'constraints' => [
                ],
                'label' => 'expedient.incomeAndAid',
            ])
            ->add('professionalIncome', null, [
                'constraints' => [
                ],
                'label' => 'expedient.professionalIncome',
            ])
            ->add('capitalIncome', null, [
                'constraints' => [
                ],
                'label' => 'expedient.capitalIncome',
            ])
            ->add('pensioner', null, [
                'constraints' => [
                ],
                'label' => 'expedient.pensioner',
            ])
            ->add('heritage', null, [
                'constraints' => [
                ],
                'label' => 'expedient.heritage',
            ])
            ->add('equityIncrease', null, [
                'constraints' => [
                ],
                'label' => 'expedient.equityIncrease',
                'data' => 0,
            ])
            ->add('rentExpense', null, [
                'constraints' => [
                ],
                'label' => 'expedient.rentExpense',
            ])
            ->add('mortgageExpense', null, [
                'constraints' => [
                ],
                'label' => 'expedient.mortgageExpense',
            ])
            ->add('dependencyBonus', null, [
                'constraints' => [
                ],
                'label' => 'expedient.dependencyBonus',
            ])
            ->add('rentBonus', null, [
                'constraints' => [
                ],
                'label' => 'expedient.rentBonus',
            ])
            ->add('mortgageBonus', null, [
                'constraints' => [
                ],
                'label' => 'expedient.mortgageBonus',
            ])
            ->add('rawIncome', null, [
                'constraints' => [
                ],
                'label' => 'expedient.rawIncome',
            ])
            ->add('netIncome', null, [
                'constraints' => [
                ],
                'label' => 'expedient.netIncome',
            ])
            ->add('numberOfHours', null, [
                'constraints' => [
                ],
                'label' => 'expedient.numberOfHours',
                'data' => 0,
            ])
            ->add('monthlyContribution', null, [
                'constraints' => [
                ],
                'label' => 'expedient.monthlyContribution',
                'data' => 0,
            ])
            ->add('pricePerHour', null, [
                'constraints' => [
                ],
                'label' => 'expedient.pricePerHour',
                'data' => 0,
            ])
            ->add('members', CollectionType::class, [
                'entry_type' => MemberType::class,
//                'entry_options' => [
//                    'attr' => ['class' => 'form-row'],
//                ],
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
            'data_class' => Expedient::class,
        ]);
    }
}
