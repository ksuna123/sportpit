<?
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";
if (!$_SESSION['user']['login']) {
      header("location:/index.php");
      exit;
}
if (isset($_SESSION['user'])&& $_SESSION['user']['login']!="") {
      unset($_SESSION['favorite']);
      $user = $_SESSION['user']['login'];
      $queryFvr = $db->query("SELECT `product_id` FROM `favoriteitems` WHERE `login`='$user'");
      $favo = $_SESSION['favorite'];
      foreach ($queryFvr as $row) {
            $id = $row['product_id'];
            $newFavo['product_favorite'] = $id;
            $favo[count($favo)] = $newFavo;
      }
      $_SESSION['favorite'] = $favo;
}
?>
<!DOCTYPE html>
<html lang="en">

<? include_once "$path/private/head.php"; ?>
<body>
	<div class="cont profile-wrapper">
		<? include_once "$path/private/header.php"; ?>
            <div class="profile_cont_main">
                  <div class="profile_cont">

                  
                <div class="cart-page_header">
                    <ul>
                        <li><a href="/index.php" class="red">Главная</a></li>
                        <li><span class="gray">Профиль</span></li>
                    </ul>
                </div>

                <h1 class="cart-h1">Ваши данные</h1>

           
            
                  <div>
                  Ваш логин: <h2><?= $_SESSION['user']['login'];?></h2>
                  Ваш email: <h3><?= $_SESSION['user']['email'];?></h3>
                   </div>
                 
                  <h1 class="cart-h1">Ваши заказы</h1>

                  <table border=1 cellpadding=6 cellspacing=1 width=90% bordercolor="#cf66d3" class="mytable">
                  
                 <? if (isset($_SESSION['user'])):?>
                 <? $user = $_SESSION['user']['login'];
                  //$queryOrder = $db->query("SELECT * FROM `orders` JOIN `orderitems` ON orders.id=orderitems.order_id WHERE orders.login=$user");
                  $queryOrder = $db->query("SELECT * FROM `orders` WHERE orders.login='Николай.G'");
                  foreach($queryOrder as $row):?>
                  <tr class="ordernumber"><td colspan=5><b>Заказ №<? echo $row['id']?></b></td>  </tr>
                                                   
                              <tr bgcolor="#c143d1" class="table-head"> 
                                                <td><b>Название товара</b></td>  
                                                <td><b>Количество</b></td>  
                                                <td><b>Цена в руб.</b></td>  
                                                <td><b>Всего в руб.</b></td>
                                                <td><b>Статус</b></td>    
                                             
                                          </tr>


                                         
            
                  <?  $queryOrderItem = $db->query("SELECT * FROM `orderitems` JOIN `good` ON orderitems.product_id=good.id WHERE order_id='$row[id]'");
                 
                   foreach($queryOrderItem as $rowS){{ ?>
                  <tr class="col-row">
                  <td> <div class="col-prod"> 
                        <div class="col-prod-img"><img src="/img/good/<? echo $rowS['link_img']; ?>" alt="<?php echo $rowS['name'];?>" title="<?php echo $rowS['name'];?>"></div>
                  
                  <div><?php echo $rowS['name'];?></div></div></td>
                        <td> <?php echo $rowS['quantityorder']; $qe=$rowS['quantityorder'];?></td>
                        <td> <?php echo $rowS['priceOrder']; ?> </td>
                       <td> <?php echo $rowS['priceOrder']*$qe;?></td>
                        <td><?if ($row['status']==0){
                              echo "Готов к выдаче";}else{
                                    echo "Получен";
                              }
                              ?></td>
          </tr>
          <?}
          $total = $total + ($rowS['quantityorder'] * $rowS['priceOrder']);};?>
  
        <tr>  
          <td class="table-footer" colspan=3 bgcolor="#c143d1" align=right><b>Итого заказ на сумму: </b></td> 
          <td class="table-footer" colspan=2 bgcolor="#c143d1" align=center><b><?php echo $total ;?> руб.</b></td>  
       </tr>
 <? endforeach;?>
</table>           
              
              
<?php else : ?>

<div class="empty">
    <h3>У Вас нет ни одного заказа</h3>
</div>

<?php endif; ?>

			 
		 </div>

		

	</div>
	<? include_once "$path/private/footer.php"; ?>
</body>

<script>

</script>
</html>