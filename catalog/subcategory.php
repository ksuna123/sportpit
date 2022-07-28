<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 1;
$offset = $limit * ($page - 1);

$queryR = $db->query("SELECT * FROM good WHERE good.status=1 AND good.subcat_id=$_GET[id]");
$pageAll = round($queryR->num_rows / $limit, 0, PHP_ROUND_HALF_UP);

?>
<!DOCTYPE html>
<html lang="en">
<? include_once "$path/private/head.php"; ?>

<body>
    <div class="cont catalog-wrapper">
        <? include_once "$path/private/header.php"; ?>
        <div class="catalog_cont_main">

            <div class="catalog_cont" id="catcont">
                <?

                if (isset($_GET['name'], $_GET['id'])) {
                    $catName = $_GET['name'];
                    $catId = $_GET['id'];



                    $query = $db->query("SELECT g.name,g.cat_id,g.subcat_id,g.price,g.quantity,g.link_img,s.id,s.name AS namesubcat, g.id AS goodid FROM `good`AS g JOIN `subcategory`AS s ON g.subcat_id=$catId WHERE g.status=1 AND s.id=$catId LIMIT $limit OFFSET $offset ");

                    foreach ($query as $row) {


                ?>

                        <div class="product-wrap">
                        <div class="product-like">
                                <a title="Перейти в Избранное" data-like="<? echo $row['goodid']; ?>" class="product-like_link <? if(isset($_SESSION['favorite']) && count($_SESSION['favorite'])!=0){
                                    $f=$_SESSION['favorite'];
                                     foreach($f as $key=>$value){
                                        if($value['product_favorite']==$row['goodid']){
                                            echo "like";
                                        }
                                }}?>" >
                                    <img src="/img/red_heart.png" title="Избранное" alt="Избранное" class="img-top" height="30px" width="30px">
                                    <img src="/img/heart.svg" title="Избранное" alt="Избранное" class="img-bottom" height="30px" width="30px">
                                    <!-- <img src="/img/like.svg" title="Избранное" alt="Избранное" class="img-like" height="30px" width="30px"> -->
                                </a>
                            </div>
                            <div class="product-item">
                           
                                <img src="/img/good/<? echo $row['link_img']; ?>" alt="">
                                <div class="product-buttons">
                                    <!-- <a href="cart.php?product_id=<//?echo $row['id'];?>"class="product_links_with_id">В корзину</a> -->
                                    <a data-catid="<? echo $row['goodid']; ?>" class="product_links_with_id">В корзину</a>
                                </div>
                            </div>
                            <div class="product-subcat"><? echo $row['namesubcat']; ?></div>
                            <div class="product-title">
                                <div class="product-title_name">
                                    <a href="product.php?name=<? echo $row['name']; ?>&id=<? echo $row['goodid']; ?>&page=1"><? echo $row['name']; ?></a>
                                </div>
                                <span class="product-price"><? echo $row['price']; ?> ₽</span>
                            </div>
                        </div>

                <?
                    }
                }
                ?>



            </div>
            <? include_once "$path/catalog/pagination.php"; ?>
        </div>

        <? include_once "$path/private/footer.php"; ?>

    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    // $(function() {
    //     let links_with_id = $('.product_links_with_id');
    //     let cart_value = $('#cart_count');

    //     $.each(links_with_id, function() {
    //         $(this).bind('click', function() {
    //             $(this).addClass('hv');
    //             $(this).html('В корзине');
    //             let current_id = $(this).attr('data-catid');
    //             $.post("/sys/add.php", {
    //                     "product_id": current_id
    //                 })
    //                 .done(function(data) {
    //                     cart_value.html(data);
    //                 });
    //         });
    //     });

    // });
</script>

</html>