<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('idResponsable')
            ->add('nom')
            ->add('address', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Name',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your address nom should be at least {{ limit }} characters',
                        'max' => 69,
                    ]),
                ],
            ])
            ->add('type', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Name',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your type nom should be at least {{ limit }} characters',
                        'max' => 69,
                    ]),
                ],
            ])
            ->add('nbEtoile')
            ->add('phone',  TextType::class, array(
                'required' => true,
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 5]
            ))
            ->add('capacite', TextType::class, array(
                'required' => true,
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 5]
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
