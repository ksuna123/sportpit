<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

unset($_SESSION['user']['id']);
unset($_SESSION['user']['login']);
unset($_SESSION['user']['email']);
unset($_SESSION['user']['admin']);

header('location:/index.php');