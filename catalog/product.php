<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

// $page = isset($_GET['page']) ? $_GET['page'] : 1;

// $limit = 2;
// $offset = $limit * ($page - 1);

// $queryR = $db->query("SELECT * FROM good WHERE good.status=1 AND g.name=$catName AND g.id=$catId");
// $pageAll = round($queryR->num_rows / $limit, 0, PHP_ROUND_HALF_UP);

?>
<!DOCTYPE html>
<html lang="en">
<? include_once "$path/private/head.php"; ?>

<body>
    <div class="cont product-wrapper">
        <? include_once "$path/private/header.php"; ?>
        <div class="catalog_cont_main">

            <div class="product_cont" id="catcont">
                <?

                if (isset($_GET['name'], $_GET['id'])) {
                    $Name = $_GET['name'];
                    $Id = $_GET['id'];



                    //$query = $db->query("SELECT *  FROM `good` WHERE g.status=1 AND g.name=$catName AND g.id=$catId");
                    $query = $db->query("SELECT g.id,g.name,g.cat_id,g.subcat_id,g.price,g.quantity,g.link_img,s.name AS namesubcat FROM `good`AS g JOIN `subcategory`AS s ON g.subcat_id=s.id WHERE g.status=1 AND g.id=$Id");

                    foreach ($query as $row) {


                ?>

                        <!-- Вывод карточки -->
                        <div class="product-self-block">

                            <div class="product_image_block">
                                <div class="product-like">
                                    <a title="Перейти в Избранное" data-like="<? echo $row['id']; ?>" class="product-like_link <? if (isset($_SESSION['favorite']) && count($_SESSION['favorite']) != 0) {
                                                                                                                                    $f = $_SESSION['favorite'];
                                                                                                                                    foreach ($f as $key => $value) {
                                                                                                                                        if ($value['product_favorite'] == $row['id']) {
                                                                                                                                            echo "like";
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                } ?>">
                                        <img src="/img/red_heart.png" title="Избранное" alt="Избранное" class="img-top" height="30px" width="30px">
                                        <img src="/img/heart.svg" title="Избранное" alt="Избранное" class="img-bottom" height="30px" width="30px">
                                        <!-- <img src="/img/like.svg" title="Избранное" alt="Избранное" class="img-like" height="30px" width="30px"> -->
                                    </a>
                                </div>
                                <img src="/img/good/<? echo $row['link_img']; ?>" title="<? echo $row['name']; ?>" alt="<? echo $row['name']; ?>" class="product_image_block_img">

                            </div>
                            <div class="product_right_block">
                                <div class="product-self-subcategory">
                                    <? echo $row['namesubcat']; ?>
                                </div>
                                <div class="product-self-name">
                                    <h1><? echo $row['name']; ?></h1>
                                </div>
                                <div class="product-self-info">
                                    <div class="product-self-info-price">
                                        <div class="p-s-i-price">
                                            <? echo $row['price']; ?> ₽
                                        </div>
                                        <div class="p-s-i-iprice">
                                            Цена актуальна только в интернет магазине
                                        </div>
                                    </div>
                                    <div class="product-self-info-quantity">
                                        <div class='number'>
                                            <div class="number-minus">-</div>
                                            <input class='number-text' type="text" value="1" id="myInput" />
                                            <div class="number-plus" data-q="<?php echo $row['quantity']; ?>">+</div>
                                        </div>
                                        <button class="btn_cart_add" data-goodid="<? echo $row['id']; ?>">
                                            В корзину <span id="cart_val"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
            </div>


    <?
                    }
                }
    ?>

    <div>
        <?

        if (isset($_GET['id'])) {
            $Id = $_GET['id'];
            $queryD = $db->query("SELECT *  FROM `description` WHERE `good_id`=$Id");

            foreach ($queryD as $row) {


        ?>
                <div class="abouteGood"><? echo $row['aboute'] ?></div>
                <div class="abouteGood"><b>Состав:</b><? echo $row['composition'] ?></div>
                <div class="howToUse"><b>Рекомендация к применению:</b><? echo $row['howtouse'] ?></div>
        <? }
        } ?>
    </div>

        </div>

    </div>

    <? include_once "$path/private/footer.php"; ?>

    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function() {
        $('.number-minus').click(function() {
            let $input = $(this).parent().find('input'); //возвращает родительский элемент а потом возвращает потомка его
            let count = parseInt($input.val()) - 1; //получаем значение инпут -возвращаем целое число в соответствии с указанным основанием системы счисления-уменьшаем на 1
            count = count < 1 ? 1 : count;
            $input.val(count); //устанавливаем значение инпуту    
            $input.change();
            return false;
        });
        $('.number-plus').click(function() {
            let $input = $(this).parent().find('input');
            let q = $(this).attr('data-q');
            console.log(q);
            if ($input.val()>=10) {
                return true;
            } else {
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            }
       
        });


    });
</script>

</html>