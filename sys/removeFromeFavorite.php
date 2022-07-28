<? $path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";


if (isset($_SESSION['favorite']) && isset($_POST['Fproduct_id'])) {
    $id = $_POST['Fproduct_id'];

    $favo = $_SESSION['favorite'];
    foreach ($favo as $key => $value) {
        if ($value['product_favorite'] == $id) {
            unset($favo[$key]);
        }
    }
    $_SESSION['favorite'] = $favo;

    if (isset($_SESSION['user']) && $_SESSION['user']['login'] != "") {
        $user = $_SESSION['user']['login'];
        // $queryFavo = $db->query("SELECT `id` FROM `favorite` WHERE `login`='$user'");
        //    $query = $db->query("SELECT `id` FROM `favorite` WHERE `login`='$user'");
        //    $number = $query->fetch_assoc();
        //    $idS = $number['id']; 
        //$queryFavo = $db->query("DELETE FROM `favoriteitems` WHERE `product_id`='$id'");

        $queryDelete = $db->query("DELETE FROM `favoriteitems` WHERE `product_id`='$id' AND `login`='$user'");
    }
}
