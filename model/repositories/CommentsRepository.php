<?php
/**
 * CommentsRepository
 */

namespace Repositories;

class CommentsRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct();

		$this->table = 'comments';
	}
}
