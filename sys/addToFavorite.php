<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

if (isset($_POST['Fproduct_id'])) {
    $id = $_POST['Fproduct_id'];
    $favo = $_SESSION['favorite'];
    foreach ($favo as $key => $value) {
        if ($value['product_favorite'] == $id) {
            die();
        }
    }
    $newFavo['product_favorite'] = $id;
    $favo[count($favo)] = $newFavo;
    $_SESSION['favorite'] = $favo;


    if (isset($_SESSION['user']) && $_SESSION['user']['login']!="") {
        $user = $_SESSION['user']['login'];

        $queryAdd = $db->query("INSERT INTO `favoriteitems`(`id`,`login`,`product_id`,`date`) VALUES (NULL,'$user','$id',NOW())");

        //$queryFavorite = $db->query("SELECT `id` FROM `favorite` WHERE `login`='$user'");
        //$favoID = $queryFavorite->fetch_assoc();
        //    $favoid = $favoID['id'];         
        //   $queryAdd = $db->query("INSERT INTO `favoriteitems`(`id`,`favorite_id`,`product_id`) VALUES (NULL,'$favoid','$id')");



    }
}