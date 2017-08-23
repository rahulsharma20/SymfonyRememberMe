<?php

// src/AppBundle/Security/WebserviceUserProvider.php
namespace AppBundle\Security;

use AppBundle\Security\WebServiceUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class WebServiceUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $username = 'testuser';
        $password = 'testpassword';
        $salt = null;
        $roles = ['ROLE_MEMBER'];

        return new WebserviceUser($username, $password, $salt, $roles);

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return WebserviceUser::class === $class;
    }
}
