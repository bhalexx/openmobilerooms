<?php

namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\UserBundle\Model\UserManager;
use AppBundle\Event\UserEvents;
use AppBundle\Service\ApiClient;
use AppBundle\Entity\ApiUser;

class UserSubscriber implements EventSubscriberInterface
{
    private $apiClient;
    private $userManager;

    public function __construct(ApiClient $apiClient, UserManager $userManager)
    {
        $this->apiClient = $apiClient;
        $this->userManager = $userManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            UserEvents::USER_CREATED => 'onUserCreation',
            UserEvents::USER_UPDATED => 'onUserUpdate',
            UserEvents::USER_DELETED => 'onUserDeletion'
        );
    }

    public function onUserCreation(UserEvents $event)
    {
        $user = $event->getUser();
        $apiUser = $this->setApiUser($user);

        $newUser = $this->apiClient->request('api/users', 'POST', $apiUser);
        $user->setApiId($newUser['id']);

        $this->userManager->updateUser($user);
    }

    public function onUserUpdate(UserEvents $event)
    {
        $user = $event->getUser();
        $uri = 'api/users/'.$user->getApiId();

        $apiUser = $this->setApiUser($user);

        $this->apiClient->request($uri, 'PUT', $apiUser);
    }

    public function onUserDeletion(UserEvents $event)
    {
        $user = $event->getUser();
        $uri = 'api/users/'.$user->getApiId();

        $this->apiClient->request($uri, 'DELETE');

        $this->userManager->deleteUser($user);
    }

    private function setApiUser($user)
    {
        $apiUser = new ApiUser();
        $apiUser
            ->setEmail($user->getEmail())
            ->setFirstname($user->getFirstname())
            ->setLastname($user->getLastname())
            ->setPhone($user->getPhone())
            ->setUsername($user->getUsername());

        return $apiUser;
    }
}
