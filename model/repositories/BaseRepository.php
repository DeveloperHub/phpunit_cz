<?php
/**
 * BaseRepository
 */

namespace Repositories;

abstract class BaseRepository
{
	/** @var \DibiConnection */
	protected $connect;

	/** @var string */
	public $table;


	public function __construct()
	{
		$this->connect = new \DibiConnection(array(
			'drive' => 'mysqli',
			'host' => 'localhost',
			'username' => 'root',
			'password' => '',
			'database' => 'phpunit_cz',
		));
	}


	/**
	 * @param array $where
	 * @return \DibiRow
	 */
	public function fetchBy(array $where)
	{
		return $this->connect->fetch('SELECT * FROM %n WHERE %and', $this->table, $where);
	}


	/**
	 * @param array $where
	 * @return array
	 */
	public function fetchAllBy(array $where)
	{
		return $this->connect->fetchAll('SELECT * FROM %n WHERE %and', $this->table, $where);
	}


	/**
	 * @param int $id
	 * @return \DibiRow
	 */
	public function fetchById($id)
	{
		return $this->fetchBy(array('id' => $id));
	}


	public function fetchAll()
	{
		return $this->fetchAllBy(array());
	}


	/**
	 * @param array $data
	 * @param int|null $id
	 * @return int|null
	 * @throws \InvalidArgumentException
	 */
	public function save(array $data, $id = NULL)
	{
		if (!count($data)) {
			throw new \InvalidArgumentException('No data to save.');
		}

		if (isset($id)) {
			$this->connect->update($this->table, $data)->where(array('id' => $id))->execute();
			if ($this->connect->getAffectedRows() == 0) {
				throw new \InvalidArgumentException('No record was affected.');
			}
			return $id;
		} else {
			$this->connect->insert($this->table, $data)->execute();
			return $this->connect->getInsertId();
		}
	}


	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id)
	{
		$this->connect->delete($this->table)->where(array('id' => $id))->execute();
		return $this->connect->getAffectedRows() == 0 ? FALSE : TRUE;
	}
}
