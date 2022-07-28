<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";
?>

                        
<? if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) : ?>
        <table border=1 cellpadding=6 cellspacing=0 width=90% bordercolor="#cf66d3" class="mytable">

                <tr bgcolor="#c143d1" class="table-head">
                    <td><b>Название товара</b></td>  
                    <td><b>Количество</b></td>  
                    <td><b>Цена в руб.</b></td>  
                    <td><b>Всего в руб.</b></td>  
                    <td></td>
                </tr>

        <? $c = $_SESSION['cart'];
        foreach ($c as $key => $value) {
          $query = $db->query("SELECT * FROM good WHERE id=$key");
        foreach ($query as $row){{?>
              
         <tr class="col-row">
          <td> <div class="col-prod"> 
            <div class="col-prod-img"><img src="/img/good/<? echo $row['link_img']; ?>" alt="<?php echo $row['name'];?>" title="<?php echo $row['name'];?>"></div>
      
        <div><?php echo $row['name'];?></div></div></td>
              <td><input type="number" data-price="<?php echo $row['price']; ?>" class="count-product" id="<?php echo $row['id']; ?>" min="1" max="<?php echo $row['quantity']; ?>" value="<?php echo $value; ?>"></td>
              <td> <?php echo $row['price']; ?> </td>
              <td id="realP" class="realP"> <?php echo $row['price']*$value; ?></td>
              <td><button data-del="<?php echo $row['id']; ?>" class="del" id="del">Удалить товар</button></td>
          </tr>
          <?}
          $total = $total + ($value * $row["price"]);}};?>
   
        <tr>  
          <td class="table-footer" colspan=3 bgcolor="#c143d1" align=right><b>Итого:</b></td> 
          <td class="table-footer" colspan=2 bgcolor="#c143d1" align=center><b><?php echo $total ;?> руб.</b></td>  
       </tr>
</table>           
        
                         <div class="mess"></div>
                            <div class="form-style-6">
                                <h1>Данные для заказа</h1>
                                <form class="my-form">
                                    <input type="text" name="name" placeholder="Ваше имя*" required>
                                    <input type="email" name="email" placeholder="Email*" maxlength="50" required>
                                    <input type="text" name="tel" placeholder="Телефон*" required>
                                    <textarea name="message" placeholder="Комментарий к заказу"></textarea>
                                    <input type="submit" value="Отправить" class="btnCart">
                                </form>
                            </div>
                           

                            </table>
                        <div class="order-delivery-cont">
                        <div>
                        <h2>Способ получения</h2>
                        <div class="order-delivery"><div class="order-delivery-self">Самовывоз</div></div>
                        <div class="order-delivery-b">ул. Краснофлотская, 37</div>
                        </div>
                        <div>
                        <h2>Способ оплаты</h2>
                        <div class="order-delivery"><div class="order-delivery-self">Оплата в магазине</div></div>
                        <div class="order-delivery-b">наличными или картой</div>
                        </div>
                        </div>




                        <?php else : ?>

                        <div class="empty">
                            <h3>Ваша корзина пуста</h3>
                        </div>

                    <?php endif; ?>
    


