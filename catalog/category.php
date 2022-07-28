<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 3;
$offset = $limit * ($page - 1);

$queryR = $db->query("SELECT * FROM good WHERE good.status=1 AND good.cat_id=$_GET[id]");
$pageAll = round($queryR->num_rows / $limit, 0, PHP_ROUND_HALF_UP);
//unset($_SESSION['favorite']);
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
                        <li><span class="gray"> <a href="/catalog/sportpitanie.php?page=1" class="sec">Спортивное питание</a> </span></li>
                        <li><span class="gray"><?echo $_GET['name']?></span></li>
                    </ul>
                </div>
            <div class="catalog_cont" id="catcont">
                <?
//print_r($_SESSION['favorite']);
// $quant = count($_SESSION['favorite']);
// print_r($quant);
// $pageAl = round(4 / 3, 0, PHP_ROUND_HALF_UP);
// print_r($pageAl);
//  $favo=$_SESSION['favorite'];
// // foreach($favo as $key=>$value){
// //     print_r($value['product_favorite']);
// // }
// foreach($favo as $key=>$value){
//     if($value['product_favorite']=='3'){
//         unset($key print_r($_SESSION['favorite']););
//     }
// }
                if (isset($_GET['name'], $_GET['id'])) {
                    $catName = $_GET['name'];
                    $catId = $_GET['id'];



                    $query = $db->query("SELECT g.id,g.name,g.cat_id,g.subcat_id,g.price,g.quantity,g.link_img,s.name AS namesubcat FROM `good`AS g JOIN `subcategory`AS s ON g.subcat_id=s.id WHERE g.status=1 AND g.cat_id=$catId AND s.cat_id=$catId LIMIT $limit OFFSET $offset ");

                    foreach ($query as $row) {


                ?>

                        <div class="product-wrap">
                        <div class="product-like">
                                <a title="Перейти в Избранное" data-like="<? echo $row['id']; ?>" class="product-like_link <? if(isset($_SESSION['favorite']) && count($_SESSION['favorite'])!=0){
                                    $f=$_SESSION['favorite'];
                                     foreach($f as $key=>$value){
                                        if($value['product_favorite']==$row['id']){
                                            echo "like";
                                        }
                                }}?>" >
                                    <img src="/img/red_heart.png" title="Избранное" alt="Избранное" class="img-top" height="30px" width="30px">
                                    <img src="/img/heart.svg" title="Избранное" alt="Избранное" class="img-bottom" height="30px" width="30px">
                                    <!-- <img src="/img/like.svg" title="Избранное" alt="Избранное" class="img-like" height="30px" width="30px"> -->
                                </a>
                            </div>
                            <div class="product-item">
                                <img src="/img/good/<? echo $row['link_img']; ?>" alt="<? echo $row['name']; ?>">
                                <div class="product-buttons">
                                    <!-- <a href="cart.php?product_id=<//?echo $row['id'];?>"class="product_links_with_id">В корзину</a> -->
                                    <a data-catid="<? echo $row['id']; ?>" class="product_links_with_id">В корзину</a>
                                </div>
                            </div>
                            <div class="product-subcat"><? echo $row['namesubcat']; ?></div>
                            <div class="product-title">
                                <div class="product-title_name">
                                    <a href="product.php?name=<? echo $row['name']; ?>&id=<? echo $row['id']; ?>&page=1"><? echo $row['name']; ?></a>
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
               
    //             $.post("api.php", {
    //                     "product_id": current_id
    //                 })
    //                 .done(function(data) {
    //                     cart_value.html(data);
    //                 });
    //         });
    //     });

    // });

    // $(function() {
    //     let link_like = $('.product-like_link');

    //     $.each(link_like, function() {
    //         $(this).bind('click', function() {
    //             let curr_id = $(this).attr('data-like');
              
    //             if (!$(this).hasClass("like")) {
    //                 $(this).addClass('like');
    //                   console.log(this);
    //                 $.post("/sys/addTofavorite.php", {
    //                         "Fproduct_id": curr_id
    //                     })
    //                     .done(function() {
    //                         //$(this).addClass('like');
                            
    //                     });
    //             } else { $(this).removeClass('like');
    //                 let curr_id = $(this).attr('data-like');
    //                 console.log(curr_id);
    //                 $.post("/sys/removeFromefavorite.php", {
    //                         "Fproduct_id": curr_id
    //                     })
    //                     .done(function() {
    //                         //$(this).removeClass('like');
    //                     });

    //             }

    //         });
    //     });



    // });

 
</script>

</html>