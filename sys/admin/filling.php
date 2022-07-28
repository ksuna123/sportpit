<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];
    $query = $db->query("SELECT *FROM `good` WHERE `id`='$id'");
    $good = $query->fetch_assoc();
    // $_SESSION['good'] = [
    //     "id" => $good['id'],
    //     "name" => $good['login'],
    //     "price" => $good['price'],
    //     "quantity" => $good['quantity']
    // ];

    echo json_encode($good);
}
