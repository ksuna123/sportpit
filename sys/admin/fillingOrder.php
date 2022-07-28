<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

if (isset($_POST['order_id'])) {
    $id = $_POST['order_id'];
    $query = $db->query("SELECT * FROM `orders` WHERE `id`='$id'");
    $order = $query->fetch_assoc();
    echo json_encode($order);
}