<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('isEnabled')
            //->add('roles')
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'required' => false,
                'type'=> PasswordType::class,
                'constraints' => new Regex([
                    'pattern' => "/^[a-z0-9]{3,}$/",
                    'message' => 'Au moins trois lettres/chiffres'
                ])
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
