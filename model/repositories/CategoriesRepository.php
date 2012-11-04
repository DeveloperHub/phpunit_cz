<?php
/**
 * CategoriesRepository
 */

namespace Repositories;

class CategoriesRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct();

		self::$table = 'categories';
	}
}
