<?php

namespace App\Form;

use App\Entity\Agence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('idProp')
            ->add('nom', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Name',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your Nom nom should be at least {{ limit }} characters',
                        'max' => 69,
                    ]),
                ],
            ])
            ->add('numero',TextType::class, array(
                'required' => true,
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 8]
            ))
            ->add('nbEtoile')
            ->add('address', null, [
                
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agence::class,
        ]);
    }
}
