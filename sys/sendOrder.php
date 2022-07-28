<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$to = "ksenia.konuk@mail.ru";
$name = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['name']))));
$email = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['email']))));
$tel = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['tel']))));
$text = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['message']))));
$subject = "Новый заказ №";



if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) :
  $c = $_SESSION['cart'];
  $order = "<html><body><center><table border=1 cellpadding=6 cellspacing=0 width=90% bordercolor='#DBDBDB'>
<tr align=center bgcolor='#E4E4E4'>  
    <td><b>Название товара</b></td>  
    <td><b>Количество</b></td>  
    <td><b>Цена</b></td>  
    <td><b>Всего</b></td>  
</tr>";
  foreach ($c as $key => $value) :
    $query = $db->query("SELECT * FROM good WHERE id=$key");
    foreach ($query as $row) { {
        $order .= "
<tr>      
    <td>" . $row['name'] . "</td>  
    <td align=center>" . $value . "</td>  
    <td align=center>" . $row['price'] . " руб.</td>  
    <td align=center>" . $row['price'] * $value . " руб.</td>                                               
</tr>";
      }
      $total = $total + ($value * $row["price"]);
    };
  endforeach;
  $order .= "<tr>  
    <td colspan=3 bgcolor='#E4E4E4' align=right><b>Итого</b></td> 
    <td align=center><b>" . $total . " руб.</b></td>  
</tr>
<tr><td colspan=4 align=center bgcolor='#E4E4E3'><b>Данные о покупателе</b></td></tr>
 <tr>
  <td><b>ФИО</b></td>
  <td colspan=3>" . $name . "</td>
 </tr>
 <tr>
  <td><b>Email</b></td>
  <td colspan=3><a href='mailto:" . $email . "'>" . $email . "</a></td>
 </tr>
 <tr>
  <td><b>Телефон</b></td>
  <td colspan=3>" . $tel . "</td>
 </tr>
 <tr>
  <td><b>Комментарий</b></td>
  <td colspan=3>" . $text . "</td>
 </tr>";

  $order .= " </table></center></body></html>";
endif;

//$headers  = "Content-type: text/html; charset=utf-8\r\n";

    
  
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html;";
$headers .= "From: $email";
if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) {
  if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if (!empty($tel) && preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $tel)) {
      if (!empty($name) && !empty($order)) {
       
        if (isset($_SESSION['user'])) {
          $user = $_SESSION['user']['login'];
          $queryOrder = $db->query("INSERT INTO `orders` (`id`,`login`,`date`,`tel`,`email`,`status`) VALUES (NULL,'$user',NOW(),'$tel','$email','0')");
          $last_id=$db->insert_id;
        } else {
          $queryOrder = $db->query("INSERT INTO `orders` (`id`,`login`,`date`,`tel`,`email`,`status`) VALUES (NULL,'$name.G',NOW(),'$tel','$email','0')");
          //DATE_ADD(NOW(), INTERVAL 3 DAY)); Реализовать хранение заказа не более 3 дней
          $last_id=$db->insert_id;
         
        }
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) {
          $c = $_SESSION['cart'];
          foreach ($c as $key => $value) {
            $query = $db->query("SELECT * FROM good WHERE id=$key");
            foreach ($query as $row) {
              $queryZ = $db->query("INSERT INTO `orderitems` (`id`,`order_id`,`product_id`,`priceOrder`,`quantityorder`) VALUES (NULL,'$last_id','$row[id]','$row[price]','$value')");
            }
          }
        }
        $subject .= "$last_id";
         $result = mail($to, $subject, $order, $headers);
        unset($_SESSION['cart']);
        
      }
    } else {
      echo 3;
    }
  } else {
    echo 1;
  }
} else {
  echo 2;
}

//preg_match("((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$", $tel)