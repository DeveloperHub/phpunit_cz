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

		$this->table = 'articles';
	}


	public function fetchAllBy(array $where)
	{
		$categories = new CategoriesRepository;
		$comments = new CommentsRepository;

		$sql = '
			SELECT [t].*, [lt1.name] AS [category_name], COUNT([lt2.id]) AS [count_comments]
			FROM %n [t]
				LEFT JOIN %n [lt1] ON [lt1.id]=[t.id_' . $categories->table . ']
				LEFT JOIN %n [lt2] ON [lt2.id_' . $this->table . ']=[t.id]
			WHERE %and
			GROUP BY [t.id]
		';

		return $this->connect->fetchAll($sql, $this->table, $categories->table, $comments->table, $where);
	}
}
