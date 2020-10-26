<?php


namespace App\Manager;


use App\Entity\User;
use App\Service\MailSender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\UserPassportInterface;

class UserManager
{
    private $em;
    private $mailSender;
    private $encoder;

    public function __construct(EntityManagerInterface $em, MailSender $mailSender,
                                UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->em = $em;
        $this->mailSender = $mailSender;
        $this->encoder = $userPasswordEncoder;
    }

    public function insert(User $user, $mailAdmin=true) {
        // crypter le mot de passe
        $encodedPass = $this->encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encodedPass);

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
        // mot de passe en clair : $user->getPlainPassword()
        $this->mailSender->send($user->getEmail(), "Bienvenue chez nous");
    }

    public function sendMailAdmin() {
        // envoyer un mail de confirm
        $this->mailSender->send('admin@gmail.com', 'Un nouvel utilisateur s\'est inscrit.');
    }
}