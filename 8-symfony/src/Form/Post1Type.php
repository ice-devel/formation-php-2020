<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
             * si on veut choisir parmi des users existants en bdd :
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
            /*
             * Ou si l'on veut créer un nouvel utilisateur en même temps que l'on crée le post
             **/
            ->add('user', User1Type::class, [
            ])

            /*
             * Associer des tags qui existent ?
             */
            ->add('tags', null, ['choice_label' => 'name'])

            /*
             * Créer des tags en même qu'on créé un post
             */
                /*
            ->add('tags', CollectionType::class, [
                'entry_type' => TagType::class,
                'prototype' => true,
                'allow_add' => true,
            ])
                */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
