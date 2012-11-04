<?php
/**
 * LinksRepository
 */

namespace Repositories;

class LinksRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct();

		$this->table = 'links';
	}
}
