<?php

namespace App\Form;

use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('idAgence')
            ->add('capacity',TextType::class, array(
                'required' => true,
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 5]
            ))
            ->add('prix', TextType::class, array(
                'required' => true,
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 5]
            ))
            ->add('company', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Name',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your Comapny nom should be at least {{ limit }} characters',
                        'max' => 69,
                    ]),
                ],
            ])
            ->add('depart', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Name',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your depart should be at least {{ limit }} characters',
                        'max' => 69,
                    ]),
                ],
            ])
            ->add('destination', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Name',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your destination should be at least {{ limit }} characters',
                        'max' => 69,
                    ]),
                ],
            ])
            ->add('date')
            // ->add('agence')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
