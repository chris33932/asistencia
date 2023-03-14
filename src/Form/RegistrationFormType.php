<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Area;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          //  ->add('nombre')
            ->add('nombre', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])

            ->add('apellido', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dni', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('domicilio', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('contacto', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('area', EntityType::class, ['class' => Area::class,
                'attr' => ['class' => 'form-control'],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Aceptar términos',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password','class' => 'form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
