<?php
	
namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Event\UserEvents;
use AppBundle\Service\ApiClient;
use AppBundle\Entity\ApiUser;

class UserSubscriber implements EventSubscriberInterface
{
	private $apiClient;

	public function __construct(ApiClient $apiClient)
	{
		$this->apiClient = $apiClient;
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
		$apiUser = $this->setApiUser($event->getUser());
		
    	$this->apiClient->request('api/users', 'POST', $apiUser);
	}

	public function onUserUpdate(UserEvents $event)
	{
		// Waiting for API V2
		// $user = $event->getUser();

		// $uri = 'api/users/'.$user->getId();

		// $apiUser = $this->setApiUser($user);
		
  //   	$this->apiClient->request($uri, 'PUT', $apiUser);
	}

	public function onUserDeletion(UserEvents $event)
	{
		
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