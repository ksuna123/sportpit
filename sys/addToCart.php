<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

if (isset($_POST['product_id']) && isset($_POST['product_col'])) {

    $id = $_POST['product_id'];
    $col = $_POST['product_col'];
    $current_cart_value = 0;

    $cart = $_SESSION['cart'];
    if(isset($cart[$id])){
        $cart[$id]++;
    }else {$cart[$id]= $col;}
    $_SESSION['cart'] = $cart;
    $current_cart_value = count($_SESSION['cart']);
    echo $current_cart_value;

    // if (!isset($_SESSION['cart'])) {
    //     $cart = $_SESSION['cart'];
    //     $newProduct['idProduct'] = $ol;
    //     $cart[count($cart)] = $newProduct;
    //     $_SESSION['cart'] = $cart;
    //     $current_cart_value = count($_SESSION['cart']);
    // }

    // $product_check = false;
    // if (isset($_SESSION['cart'])) {
    //     foreach ($_SESSION['cart'] as $value) {
    //         if ($value['idProduct'] == $ol) { 
    //             $current_cart_value = count($_SESSION['cart']);
    //             echo $current_cart_value;
    //             die();
    //         }
    //     }
    //     $cart = $_SESSION['cart'];
    //     $newProduct['idProduct'] = $ol;
    //     $cart[count($cart)] = $newProduct;
    //     $_SESSION['cart'] = $cart;
    //     $current_cart_value = count($_SESSION['cart']);
    // }
    //echo $current_cart_value;
}
