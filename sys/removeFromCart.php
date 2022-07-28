<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";


if (isset($_SESSION['cart'])&& isset($_POST['product_id'])) {
    $id = $_POST['product_id'];
  
    $current_cart_value = 0;
    $cart=$_SESSION['cart'];
    // if(isset($cart[$id])){
    //     unset($cart[$id]);
    // }
    unset($cart[$id]);
    $_SESSION['cart']=$cart;
    $current_cart_value = count($_SESSION['cart']);
    echo $current_cart_value;


    // if (isset($_SESSION['cart'])) {
    //  $cart=$_SESSION['cart'];
    //     for($i=0;$i<count($cart);$i++){
    //         $idProduct=$cart[$i]['idProduct'];
    //         if($ol!=$idProduct){
    //             $newCart[count($newCart)]=$cart[$i];
    //         }
    //     }
    //     $_SESSION['cart']=$newCart;
    //     $current_cart_value = count($_SESSION['cart']);
    // }
   
}