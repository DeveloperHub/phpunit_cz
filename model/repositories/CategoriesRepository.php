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

		$this->table = 'categories';
	}


	public function fetchAllBy(array $where)
	{
		$articles = new ArticlesRepository;

		$sql = '
			SELECT [t.id], [t.name],
				COUNT([lt.id]) AS [count_articles]
			FROM %n AS [t]
				LEFT JOIN %n AS [lt] ON [lt.id_' . $this->table . ']=[t.id]
			WHERE %and
			GROUP BY [t.id]
		';
		return $this->connect->fetchAll($sql, $this->table, $articles->table, $where);
	}
}
