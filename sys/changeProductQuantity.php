<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

if (isset($_POST['id_tov']) && isset($_POST['col_tov'])) {
    $id = $_POST['id_tov'];
    $col = $_POST['col_tov'];
  
    $cart = $_SESSION['cart'];
    $cart[$id] = $col;
    $_SESSION['cart'] = $cart;
        
}
    

