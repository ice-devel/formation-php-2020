<?php


namespace App\Manager;


use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class PostManager
{
    private $em;
    private $um;

    public function __construct(EntityManagerInterface $em, UserManager $userManager)
    {
        $this->em = $em;
        $this->um = $userManager;
    }

    public function insert(Post $post) {
        $user = $post->getUser();

        // faut-il créer un new user en bdd ?
        if (!$user->getId()) {
            $this->um->insert($user);
        }

        $this->em->persist($post);
        $this->em->flush();
    }
}