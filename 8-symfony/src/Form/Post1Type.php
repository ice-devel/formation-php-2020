<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Post1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class)
            ->add('isEnabled')
            /*
            ->add('user', null, [
                // propriété affichée dans la liste déroulante
                'choice_label' => 'idAndEmail', // idAndEmail est une fonction de User (getIdAndEmail())

                // par défaut un champ Entity affiche dans une liste déroulante
                // tous les enregistrements en bdd
                // on peut avec un query_builder restreindre les choix grâce à une requete
                'query_builder' => function (UserRepository $userRepository) {
                    return $userRepository->findAllEnabled();
                },

                // liste déroulante (false) ou bouton radio (true) ?
                'expanded' => false
            ])
            */
            ->add('user', User1Type::class, [
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
