<?php

namespace App\Form;

use App\Entity\Asistencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AsistenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('fecha', HiddenType::class)
            //->add('fecha')
           // ->add('time')
           //->add('registro', HiddenType::class)
            
            ->add('registro', ChoiceType::class, array(
                'choices' => array(
                    'ENTRADA' => 'ENTRADA',
                    'SALIDA' => 'SALIDA'
                ),
                'required'    => true,
                'placeholder' => 'registrar',
                'attr' => array('class' => 'form-control'))
                                
                )
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asistencia::class,
        ]);
    }
}
