<?php
/**
 * ArticlesRepository
 */

namespace Repositories;

class ArticlesRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct();

		self::$table = 'articles';
	}


	public function fetchAllBy(array $where)
	{
		$articles = parent::fetchAllBy($where);
		if (count($articles))
		{
			$sql = '
				SELECT [t].*, COUNT([c.id]) AS [count_comments]
				FROM %n [t]
					LEFT JOIN %n [lt] ON [lt.id_articles]=[t.id]
				WHERE %and
			';
			return $this->connect->fetchAll($sql, self::$table, CommentsRepository::$table, $where);
		}

		return $articles;
	}
}
