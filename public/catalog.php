<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 2;
$offset = $limit * ($page - 1);

$queryR = $db->query("SELECT * FROM good WHERE good.status=1 AND good.cat_id=$_GET[id]");
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
				// $check_name = $db->query("SELECT * FROM `category` WHERE `name`=`$catName`");
				// if ($check_name->num_rows > 0) 

				if (isset($_GET['name'], $_GET['id'])) {
					$catName = $_GET['name'];
					$catId = $_GET['id'];



					$query = $db->query("SELECT g.id,g.name,g.cat_id,g.subcat_id,g.price,g.quantity,g.link_img,s.name AS namesubcat FROM `good`AS g JOIN `subcategory`AS s ON g.subcat_id=s.id WHERE g.status=1 AND g.cat_id=$catId AND s.cat_id=$catId LIMIT $limit OFFSET $offset ");

					foreach ($query as $row) {


				?>

						<div class="product-wrap">
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
									<a href=""><? echo $row['name']; ?></a>
								</div>
								<span class="product-price"><? echo $row['price']; ?> ₽</span>
							</div>
						</div>

				<?
					}
				}
				?>



			</div>
			<? include_once "$path/public/pagination.php"; ?>
		</div>

		<? include_once "$path/private/footer.php"; ?>

	</div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>

$(function() {
		let links_with_id = $('.product_links_with_id');
		let cart_value = $('#cart_count');

		$.each(links_with_id, function() {
			$(this).bind('click', function() {
				$(this).addClass('hv');
				$(this).html('В корзине');
				let current_id = $(this).attr('data-catid');
				$.post("api.php", {
						"product_id": current_id
					})
					.done(function(data) {
						cart_value.html(data);
					});
			});
		});

	});
</script>

</html>