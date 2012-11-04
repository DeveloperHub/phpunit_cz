<?php
/**
 * UsersRepository
 */

namespace Repositories;

class UsersRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct();

		self::$table = 'users';
	}
}
