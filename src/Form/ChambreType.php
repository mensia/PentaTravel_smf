<?php

namespace App\Form;

use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number')
            ->add('prix', TextType::class, array(
                'required' => true,
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 5]
            ))
            ->add('image')
            ->add('description', null, [
                
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Name',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your Comapny nom should be at least {{ limit }} characters',
                        'max' => 500,
                    ]),
                ],
            ])
            // ->add('disp')
            // ->add('hotel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
