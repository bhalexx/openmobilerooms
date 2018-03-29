<?php

namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Event\UserEvents;

/**
 * Listener responsible to send ApiUser to Bilemo API on register
 */
class RegistrationListener implements EventSubscriberInterface
{
	private $router;
	private $dispatcher;

	public function __construct(UrlGeneratorInterface $router, EventDispatcherInterface $dispatcher)
	{
		$this->router = $router;
		$this->dispatcher = $dispatcher;
	}

	public static function getSubscribedEvents()
	{
		return array(
			FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
		);
	}

	/**
	 * Dispatch UserEvent creation and redirect to homepage on registration success
	 * @param  FormEvent $event
	 */
	public function onRegistrationSuccess(FormEvent $event)
	{
		$user = $event->getForm()->getData();

		// Dispatch UserEvent creation to send ApiUser to Bilemo API
		$userEvent = new UserEvents($user);
		$this->dispatcher->dispatch(UserEvents::USER_CREATED, $userEvent);

		//Redirect on HomePage
		$url = $this->router->generate('mobiles');
		$event->setResponse(new RedirectResponse($url));
	}
}