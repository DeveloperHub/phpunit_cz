<?php
date_default_timezone_set('Europe/Prague');

require_once 'dibi/dibi/dibi.php';
require_once 'repositories/BaseRepository.php';
require_once 'repositories/ArticlesRepository.php';
require_once 'repositories/CategoriesRepository.php';
require_once 'repositories/CommentsRepository.php';
require_once 'repositories/LinksRepository.php';
require_once 'repositories/UsersRepository.php';

$arguments = $_POST;

$action = $arguments['action'];
$table = $arguments['table'];
$id = isset($arguments['id']) ? (int) $arguments['id'] : null;

$category = isset($arguments['category']) ? $arguments['category'] : null;
$saveData = isset($arguments['data']) ? $arguments['data'] : array();

$repositoryClass = 'Repositories\\' . ucfirst($table) . 'Repository';
$repository = new $repositoryClass;

$articles = new \Repositories\ArticlesRepository;

try {
	switch ($action) {
		case 'fetch':
			$where = array();

			// fetch article(s)
			if ($table === $articles->table) {
				if (isset($category)) {
					$categories = new \Repositories\CategoriesRepository;
					$where['id_' . $categories->table] = $category;
				}
			}

			// if set ID, always has priority over the other conditions
			$fetchData = isset($id) ? $repository->fetchById($id) : $repository->fetchAllBy($where);
			$send = json_encode($fetchData);

			header('HTTP/1.0 200 OK');
			echo $send;
			break;

		case 'save':
			$id = $repository->save($saveData, $id);
			header('HTTP/1.0 200 OK');
			echo $id;
			break;

		case 'delete':
			$affectedRows = $repository->delete($id);

			header('HTTP/1.0 200 OK');
			echo $affectedRows;
			break;
	}
} catch (InvalidArgumentException $e) {
	header('HTTP/1.0 400 Bad Request');
	echo $e->getMessage();
} catch (Exception $e) {
	header('HTTP/1.0 500 Internal Server Error');
	echo $e->getMessage();
}