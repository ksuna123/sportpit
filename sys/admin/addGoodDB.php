<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";


$name = $_POST['gname'];
$catID=$_POST['gcatId'];
$subCatID=$_POST['gsubCatId'];
$price = $_POST['gprice'];
$quantity = $_POST['gquantity'];
$status=$_POST['gstatus'];
$img = $_POST['gimg'];


$query = $db->query("INSERT INTO good (`id`,`name`,`cat_id`,`subcat_id`,`price`,`quantity`,`status`,`link_img`) VALUES (NULL, '$name', '$catID','$subCatID','$price','$quantity','$status','$img')"); //Добавить все поля
if ($query === TRUE) {
    echo "1";
} else {
    echo "Error updating record: " . $db->error;
}
