<?php namespace LynxGroup\Component\Authorizating;

use LynxGroup\Contracts\Authorizating\Authorizator as AuthorizatorInterface;

use LynxGroup\Contracts\Odm\Document;

use LynxGroup\Component\Authenticating\User;

class Authorizator implements AuthorizatorInterface
{
	protected $voters = [];

	public function __construct(array $voters)
	{
		$this->voters = $voters;
	}

	public function isGranted($permission, Document $document, User $user = null)
	{
		foreach( $this->voters as $voter )
		{
			if( $voter($permission, $document, $user) === false )
			{
				return false;
			}
		}

		return true;
	}
}
