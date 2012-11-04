<?php
echo '<pre>';

require_once 'dibi/dibi/dibi.php';
require_once 'repositories/BaseRepository.php';
require_once 'repositories/ArticlesRepository.php';
require_once 'repositories/CategoriesRepository.php';
require_once 'repositories/CommentsRepository.php';
require_once 'repositories/LinksRepository.php';
require_once 'repositories/UsersRepository.php';

$arguments = $_GET;

print_r($arguments);

$repositoryClass = 'Repositories\\' . ucfirst($arguments['table']) . 'Repository';
$action = $arguments['action'];
$id = isset($arguments['id']) ? (int) $arguments['id'] : null;
$saveData = isset($arguments['data']) ? $arguments['data'] : array();

$repository = new $repositoryClass;

switch ($action) {
	case 'fetch':
		print_r('fetch');
		$data = isset($id) ? $repository->fetchById($id) : $repository->fetchAll();
		$send = json_encode($data);
		print_r($send);
		break;
	case 'save':
		print_r('save');
		$id = $repository->save($data, $id);
		print_r($id);
		break;
	case 'delete':
		print_r('delete');
		$affectedRows = $repository->delete($id);
		print_r($affectedRows);
		break;
}