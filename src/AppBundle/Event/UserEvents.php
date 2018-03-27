<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\User;

class UserEvents extends Event
{
	/**
	 * This event occurs when a user is created (e.g. registration)
	 */
	const USER_CREATED = 'app.user_created';

	/**
	 * This event occurs when a user is updated (e.g. profile edition)
	 */
	const USER_UPDATED = 'app.user_updated';

	/**
	 * This event occus when a user is deleted
	 */
	const USER_DELETED = 'app.user_deleted';

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getUser()
	{
		return $this->user;
	}
}