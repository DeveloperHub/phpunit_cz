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

		$this->table = 'users';
	}
}
