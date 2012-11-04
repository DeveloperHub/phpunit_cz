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


	/**
	 * @param array $where
	 * @return array
	 */
	public function fetchAllBy(array $where)
	{
		$categories = new CategoriesRepository;
		$comments = new CommentsRepository;
		$users = new UsersRepository;

		$sql = '
			SELECT [t.id], [t.title], [t.perex], [t.content], [t.tags],
				[lt1.name] AS [category_name],
				COUNT([lt2.id]) AS [count_comments],
				[lt3.name] AS [author_name]
			FROM %n [t]
				LEFT JOIN %n [lt1] ON [lt1.id]=[t.id_' . $categories->table . ']
				LEFT JOIN %n [lt2] ON [lt2.id_' . $this->table . ']=[t.id]
				LEFT JOIN %n [lt3] ON [lt3.id]=[t.id_' . $users->table . ']
			WHERE %and
			GROUP BY [t.id]
		';

		$data = $this->connect->fetchAll($sql, $this->table, $categories->table, $comments->table, $users->table, $where);
		foreach ($data as &$row) {
			$row->tags = explode('#', $row->tags);
		}
		return $data;
	}


	/**
	 * @param array $where
	 * @return bool|\DibiRow
	 */
	public function fetchBy(array $where)
	{
		$categories = new CategoriesRepository;
		$comments = new CommentsRepository;
		$users = new UsersRepository;

		$sql = '
			SELECT [t.id], [t.title], [t.perex], [t.content], [t.tags],
				[lt1.name] AS [category_name],
				COUNT([lt2.id]) AS [count_comments],
				[lt3.name] AS [author_name]
			FROM %n [t]
				LEFT JOIN %n [lt1] ON [lt1.id]=[t.id_' . $categories->table . ']
				LEFT JOIN %n [lt2] ON [lt2.id_' . $this->table . ']=[t.id]
				LEFT JOIN %n [lt3] ON [lt3.id]=[t.id_' . $users->table . ']
			WHERE %and
			GROUP BY [t.id]
		';

		$data = $this->connect->fetch($sql, $this->table, $categories->table, $comments->table, $users->table, $where);
		$data->tags = explode('#', $data->tags);
		return $data;
	}


	/**
	 * @param int $id
	 * @return bool|\DibiRow
	 */
	public function fetchById($id)
	{
		return $this->fetchBy(array('t.id' => $id));
	}


	/**
	 * @param array $data
	 * @param int|null $id
	 * @return int
	 */
	public function save(array $data, $id = NULL)
	{
		$data['tags'] = implode('#', $data['tags']);
		return parent::save($data, $id);
	}
}
