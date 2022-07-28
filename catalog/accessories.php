<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 4;
$offset = $limit * ($page - 1);

$queryR = $db->query("SELECT * FROM `good` JOIN `category` ON good.cat_id=category.id WHERE good.status=1 AND category.status=2");
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
                        <li><span class="gray">Каталог</span></li>
                        <li><span class="gray">Экипировка и аксессуары</span></li>
                    </ul>
                </div>
            <div class="catalog_cont" id="catcont">
                <?
                    $query = $db->query("SELECT g.id,g.name,g.cat_id,g.subcat_id,g.price,g.quantity,g.link_img,s.name AS namesubcat FROM `good`AS g JOIN `subcategory`AS s ON g.subcat_id=s.id JOIN `category` AS c ON c.id=g.cat_id WHERE g.status=1 AND c.status=2 LIMIT $limit OFFSET $offset ");

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
                
                
                
                ?>



            </div>
            <? include_once "$path/catalog/pagination.php"; ?>
        </div>

        <? include_once "$path/private/footer.php"; ?>

    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    
 
</script>

</html>