<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Controller;
use App\Article;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates/');
$twig = new Environment($loader);
$connection = new Controller($twig);
$article = new Article();

$connection->__invokeMenu();
if (isset($_GET['getAllRecords'])) $connection->__invokeShowTable($article->getAll());

if (isset($_GET['getByID'])) $connection->__invokeFindByID();
$getId = $_GET['id2'];
if ($getId != '') $connection->__invokeShowTable($article->findById($getId));

if (isset($_GET['getByFieldValue'])) $connection->__invokeFindByField();
$action3 = $_GET['action3'];
$value = $_GET['value'];
if ($value != null) $connection->__invokeShowTable($article->findByField("$action3", $value));

if (isset($_GET['saveRecord'])) $connection->__invokeSave();
$article_id = $_GET['id'];
$article_name = $_GET['name'];
$article_author_name = $_GET['author_name'];
$action = $_GET['action'];
if ($article_id != null && $article_name != null && $article_author_name != null)
{
    $u = new Article();
    $u->setAll($article_id,$article_name,$article_author_name);
    switch ($action)
    {
        case "add":
            $u->add();
            break;
        case "upd":
            $u->update();
            break;
    }
}

if (isset($_GET['deleteRecord'])) $connection->__invokeDelete();
$getId2 = $_GET['id4'];
if ($getId2 != '') $article->delete($getId2);