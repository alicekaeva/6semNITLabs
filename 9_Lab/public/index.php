<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Controllers\Controller;
use App\Model\Article;
use App\Repository\ArticleRepository;
use App\Repository\ArticleDataMapper;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates/');
$twig = new Environment($loader);
$connection = new Controller($twig);
$repos = new ArticleRepository();

$connection->__invokeMenu();
if (isset($_GET['getAllRecords'])) $connection->__invokeShowTable($repos->RepGetAll());

if (isset($_GET['getByID'])) $connection->__invokeFindByID();
$article_id2 = $_GET['id2'];
if ($article_id2 != null) $connection->__invokeShowTablePDO($repos->RepfindById($article_id2));

if (isset($_GET['getByFieldValue'])) $connection->__invokeFindByField();
$action3 = $_GET['action3'];
$value = $_GET['value'];
if ($value != null) $connection->__invokeShowTablePDO($repos->RepfindByValue("$action3", $value));

if (isset($_GET['saveRecord'])) $connection->__invokeSave();
$action = $_GET['action'];
if ($_GET['id'] != null && $_GET['name'] != null && $_GET['author_name'] != null)
{

    $article_id = (int)$_GET['id'];
    $article_name = $_GET['name'];
    $article_author_name = $_GET['author_name'];

    switch ($action)
    {
        case "add":
            $repos->Repadd($article_id, $article_name, $article_author_name);
            break;
        case "upd":
            $repos->Repupdate($article_id, $article_name, $article_author_name);
            break;
    }
}

if (isset($_GET['deleteRecord'])) $connection->__invokeDelete();
$getId2 = $_GET['id4'];
if ($getId2 != '') $repos->Repdelete($getId2);