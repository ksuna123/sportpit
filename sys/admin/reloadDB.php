<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";


$id = $_POST['id'];
$name = $_POST['gname'];
$catID=$_POST['gcatId'];
$subCatID=$_POST['gsubCatId'];
$price = $_POST['gprice'];
$quantity = $_POST['gquantity'];
$status=$_POST['gstatus'];
$img = $_POST['gimg'];

$query = $db->query("UPDATE good SET `name`='$name',`cat_id`='$catID',`subcat_id`='$subCatID',`price`='$price',`quantity`='$quantity',`status`='$status',`link_img`='$img' WHERE id='$id' ");
if ($query === TRUE) {
    echo "1";
} else {
    echo "Error updating record: " . $db->error;
}
