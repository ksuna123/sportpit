<?$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";



$id = $_POST['id'];
$status = $_POST['ostatus'];

$query = $db->query("UPDATE orders SET `status`='$status' WHERE id='$id' ");
if ($query === TRUE) {
    echo "1";
} else {
    echo "Error updating record: " . $db->error;
}
