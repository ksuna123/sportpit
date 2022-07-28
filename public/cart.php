<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

?>

<!DOCTYPE html>
<html lang="en">
<? include_once "$path/private/head.php"; ?>

<body>
    <div class="cont cart-wrapper">
        <? include_once "$path/private/header.php"; ?>
        <div class="cart_cont_main">

            <div class="cart_cont">
                <div class="cart-page_header">
                    <ul>
                        <li><a href="/index.php" class="red">Главная</a></li>
                        <li><span class="gray">Корзина</span></li>
                    </ul>
                </div>

                <h1 class="cart-h1">Корзина</h1>
                <div class="cart-body" id="cart">
                
                            
        <? if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) : ?>
        <table border=1 cellpadding=6 cellspacing=1 width=90% bordercolor="#cf66d3" class="mytable">

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
              <td><input type="number" data-price="<?php echo $row['price']; ?>" class="count-product" id="<?php echo $row['id']; ?>" min="1" max="<?php echo $row['quantity']; ?>"value="<?php echo $value; ?>"></td>
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

                </div>

                    <div class="continue"><h2><a href="/index.php">Продолжить покупки</a></h2></div>

                   <? $c=$_SESSION['cart'];
                  
                     print_r($c);
                   
                   
                
              
                
                   ?>
                

            </div>

        </div>

        <? include_once "$path/private/footer.php"; ?>

    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    //---------------------отправка заказа------------
    // $('.my-form').submit(function(e) {
    //     e.preventDefault();
    //     let th = $(this);
    //     let mess = $('.mess');
    //     let btn = th.find('.btnCart');

    //     $.ajax({
    //         url: '/sys/sendOrder.php',
    //         type: 'post',
    //         data: th.serialize(),
    //         success: function(data) {
    //             if (data == 3) {
    //                 mess.html('Введите корректный номер телефона');
    //                 return false;
    //             }
    //             if (data == 2) {
    //                 mess.html('Вы ничего еще не выбрали');
    //                 return false;
    //             }
    //             if (data == 1) {
    //                 mess.html('Не верно указан email');
    //                 return false;
    //             } else {
    //                 mess.html('Ваш заказ отправлен. На Ваш номер телефона будет отправлено сообщение о статусе Вашего заказа.');
    //                 setTimeout(function() {
    //                     th.trigger('reset');
    //                     ReloadCart();
    //                 }, 2000);

    //             }
    //         },
    //         error: function() {
    //             mess.html('Произошла ошибка. Ваш заказ не был отправлен.');
    //         }

    //     })
    // })

    $(document).on('submit', '.my-form', function(e) {
        e.preventDefault();
        let th = $(this);
        let mess = $('.mess');
        let btn = th.find('.btnCart');

        $.ajax({
            url: '/sys/sendOrder.php',
            type: 'post',
            data: th.serialize(),
            success: function(data) {
                if (data == 3) {
                    mess.html('Введите корректный номер телефона');
                    return false;
                }
                if (data == 2) {
                    mess.html('Вы ничего еще не выбрали');
                    return false;
                }
                if (data == 1) {
                    mess.html('Не верно указан email');
                    return false;
                } else {
                    mess.html('Ваш заказ отправлен. На Ваш номер телефона будет отправлено сообщение о статусе Вашего заказа.');
                    setTimeout(function() {
                        th.trigger('reset');
                        ReloadCart();
                    }, 2000);

                }
            },
            error: function() {
                mess.html('Произошла ошибка. Ваш заказ не был отправлен.');
            }

        })
    })
//   Протестировать код

    // $(document).on('change', '.count-product', function() {
    //     let col = $(this).val();
    //     let current_price = $(this).closest('tr').find('.priceProduct');
    //     let new_price = $(this).closest('tr').find('.totalPrice');
 
    //     console.log(new_price);
    //     let id = $(this).attr('id');
    //     //console.log(id);
    //     $.ajax({
    //         url: '/sys/changeProductQuantity.php',
    //         type: 'post',
    //         data: {
    //             col_tov: col,
    //             id_tov: id
    //         },
    //         success: function() {
                
    //             new_price.text(col * current_price);
 
    //         }
    //     });
    // });
  
  
</script>

</html>