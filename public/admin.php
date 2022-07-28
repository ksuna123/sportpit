<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

if (!($_SESSION['user']['login'] && $_SESSION['user']['admin'])) {
    header("location:/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<? include_once "$path/private/head.php"; ?>

<body>
    <div class="cont catalog-wrapper">
        <? include_once "$path/private/header.php"; ?>
        <div class="catalog_cont_main">
        <div class="cart-page_header">
                    <ul>
                        <li><a href="/index.php" class="red">Главная</a></li>
                        <li><span class="gray">Админка</span></li>
                    </ul>
                </div>
            <div id="goodAdmin">
                <? $query = $db->query("SELECT `id`,`name`FROM `good`"); ?>
                <select class="good-out">
                    <option data-id="0">Новый товар</option>
                    <? foreach ($query as $row) { ?>
                        <option data-id="<? echo $row['id'] ?>"><? echo $row['name'] ?></option>
                    <? } ?>
                </select>
            </div>
            <h2>Товар</h2>
            <p>Название: <input type="text" id="gname" size="35"></p>
            <p>Категория: <input type="text" id="gcatId" size="5"></p>
            <p>Подкатегория: <input type="text" id="gsubCatId" size="5"></p>
            <p>Стоимость: <input type="text" id="gprice" size="10"></p>
            <p>Количество: <input type="text" id="gquantity" size="5"></p>
            <p>Товар в продаже (0/1): <input type="text" id="gstatus" size="5"></p>
            <p>Изображение <input type="text" id="gimg" size="35"></p>
            <input type="hidden" id="gid">
            <button class="add-to-db">Обновить товар</button>

            <h2>Статус заказа</h2>
            <div id="orderAdmin">
                <? $queryOrder = $db->query("SELECT `id`FROM `orders`"); ?>
                <select class="order-out">
                    <option data-id="0">Заказ</option>
                    <? foreach ($queryOrder as $row) { ?>
                        <option data-id="<? echo $row['id'] ?>"><? echo $row['id'] ?></option>
                    <? } ?>
                </select>
                 
            </div>
            <p>Товар получен (0/1): <input type="text" id="ostatus" size="5"></p>
            <input type="hidden" id="oid">
            <button class="chng-order">Обновить статус</button>
           

        </div>

        <? include_once "$path/private/footer.php"; ?>

    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
     $(document).on('change','.good-out',function() {
       // $('.good-out').on('change', function() {
            let id = $('.good-out option:selected').attr('data-id');
            console.log(id);

            $.ajax({
                url: '/sys/admin/filling.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'product_id': id

                },
                success(data) {
                    console.log(data);
                    if (data == null) {
                        $('#gname').val('');
                        $('#gcatId').val('');
                        $('#gsubCatId').val('');
                        $('#gprice').val('');
                        $('#gquantity').val('');
                        $('#gstatus').val('');
                        $('#gimg').val('');
                        $('#gid').val('');
                    } else {
                        $('#gname').val(data.name);
                        $('#gcatId').val(data.cat_id);
                        $('#gsubCatId').val(data.subcat_id);
                        $('#gprice').val(data.price);
                        $('#gquantity').val(data.quantity);
                        $('#gstatus').val(data.status);
                        $('#gimg').val(data.link_img);
                        $('#gid').val(data.id);
                    }
                }
            });
        })



    $(document).ready(function() { //Событие ready выстреливает в момент готовности DOM, что происходит раньше начала загрузки мультимедийных файлов.
        $('.add-to-db').on('click', function() {
            let id = $('#gid').val();
            if (id != "") {
                $.post("/sys/admin/reloadDB.php", {
                        "id": id,
                        "gname": $('#gname').val(),
                        "gcatId": $('#gcatId').val(),
                        "gsubCatId": $('#gsubCatId').val(),
                        "gprice": $('#gprice').val(),
                        "gquantity": $('#gquantity').val(),
                        "gstatus": $('#gstatus').val(),
                        "gimg": $('#gimg').val(),
                    },
                    function(data) {
                        if (data == 1) {
                            alert("Запись добавлена");
                            ReloadDB();
                            $('#gname').val('');
                        $('#gcatId').val('');
                        $('#gsubCatId').val('');
                        $('#gprice').val('');
                        $('#gquantity').val('');
                        $('#gstatus').val('');
                        $('#gimg').val('');
                        $('#gid').val('');
                        } else {
                            console.log(data);
                        }
                    }

                )
            } else {
                $.post("/sys/admin/addGoodDB.php", {
                        "id": 0,
                        "gname": $('#gname').val(),
                        "gcatId": $('#gcatId').val(),
                        "gsubCatId": $('#gsubCatId').val(),
                        "gprice": $('#gprice').val(),
                        "gquantity": $('#gquantity').val(),
                        "gstatus": $('#gstatus').val(),
                        "gimg": $('#gimg').val(),
                    },
                    function(data) {
                        if (data == 1) {
                            alert("Запись добавлена");
                            ReloadDB();
                            $('#gname').val('');
                        $('#gcatId').val('');
                        $('#gsubCatId').val('');
                        $('#gprice').val('');
                        $('#gquantity').val('');
                        $('#gstatus').val('');
                        $('#gimg').val('');
                        $('#gid').val('');

                        } else {
                            console.log(data);
                        }
                    }

                )

            }

        })
    })

    function ReloadDB() {
        $.ajax({
            // type:"get",
            url: "/sys/admin/adminDB.php",
            //  data:{

            //   },
            error: function() {
                alert("Что-то пошло не так");
            },
            success: data => {
                goodAdmin.innerHTML = data;
            }
            // fetch("/sys/adminDB.php")
            //             .then(response=>response.text())
            //          .then(text=>{document.getElementById('cart').innerHTML = text;
        });
    }

// --------------------Обновление статуса заказа-----------------
    $(document).on('change','.order-out',function() {
       // $('.good-out').on('change', function() {
            let id = $('.order-out option:selected').attr('data-id');
            console.log(id);

            $.ajax({
                url: '/sys/admin/fillingOrder.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'order_id': id

                },
                success(data) {
                    console.log(data);
                        $('#ostatus').val(data.status);
                        $('#oid').val(data.id);
                      
                    
                }
            });
        })

        $(document).ready(function() { //Событие ready выстреливает в момент готовности DOM, что происходит раньше начала загрузки мультимедийных файлов.
        $('.chng-order').on('click', function() {
            let id = $('#oid').val();
                $.post("/sys/admin/reloadOrders.php", {
                        "id": id,
                        "ostatus": $('#ostatus').val(),
                       
                    },
                    function(data) {
                        if (data == 1) {
                            alert("Запись добавлена");
                            ReloadOrder();
                            $('#oid').val('');
                        $('#ostatus').val('');
                        } else {
                            console.log(data);
                        }
                    }

                )  })
    })

    function ReloadOrder() {
        $.ajax({
            // type:"get",
            url: "/sys/admin/adminOrder.php",
            //  data:{

            //   },
            error: function() {
                alert("Что-то пошло не так");
            },
            success: data => {
                orderAdmin.innerHTML = data;
            }
          
        });
    }
</script>