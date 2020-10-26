<?php


namespace App\Manager;


use App\Entity\User;
use App\Service\MailSender;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    private $em;
    private $mailSender;

    public function __construct(EntityManagerInterface $em, MailSender $mailSender)
    {
        $this->em = $em;
        $this->mailSender = $mailSender;
    }

    public function insert(User $user, $mailAdmin=true) {
        // crypter le mot de passe

        $this->em->persist($user);
        $this->em->flush();

        $this->sendMailConfirm($user);

        if ($mailAdmin) {
            $this->sendMailAdmin();
        }

    }

    public function insertByAdmin(User $user) {
        $this->insert($user, false);
    }

    public function sendMailConfirm(User $user) {
        // envoyer un mail de confirm
        $this->mailSender->send($user->getEmail(), "Bienvenue chez nous");
    }

    public function sendMailAdmin() {
        // envoyer un mail de confirm
        $this->mailSender->send('admin@gmail.com', 'Un nouvel utilisateur s\'est inscrit.');
    }
}