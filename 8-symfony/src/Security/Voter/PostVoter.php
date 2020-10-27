<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PostVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['POST_EDIT', 'POST_DELETE'])
            && $subject instanceof \App\Entity\Post;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        //$subject est l'entité sur laquelle on effectue une action

        // user connected
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'POST_EDIT':
                // est-ce l'utilisateur connecté est bien le créateur du post ?
                if ($user->getId() == $subject->getUser()->getId()) {
                    return true;
                }
                break;
            case 'POST_DELETE':
                // est-ce l'utilisateur connecté est bien le créateur du post?
                if ($user->getId() == $subject->getUser()->getId()) {
                    return true;
                }
                break;
        }

        return false;
    }
}
