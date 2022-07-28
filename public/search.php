<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<? include_once "$path/private/head.php"; ?>
<body>
	<div class="cont search-wrapper">
		<? include_once "$path/private/header.php"; ?>

			<div class="search_cont">
			<div class="cart-page_header">
                    <ul>
                        <li><a href="/index.php" class="red">Главная</a></li>
                        <li><span class="gray">Поиск</span></li>
                    </ul>
                </div>
				<?
				if (!empty($_GET['searchAll'])) {
					
					$searchAl=trim(strip_tags(stripcslashes(htmlspecialchars($_GET['searchAll']))));//обезопасили строку
					$searchAll = explode(" ", trim(strip_tags(stripcslashes(htmlspecialchars($_GET['searchAll']))))); // разбили строку в массив слов
					$count = count($searchAll); //подсчитали кол-во слов
					$array = array();
					$arraySubcat=array();
					$i = 0;
					foreach ($searchAll as $key) {
						$i++;
						if ($i < $count) $array[] = "CONCAT (`name`) LIKE '%" . $key . "%' OR ";
						else $array[] = "CONCAT (`name`) LIKE '%" . $key . "%'";	
					}
				
					echo "<div class='search-found'><h1>Мы нашли по Вашему запросу &#171;$searchAl&#187; :</h1></div>";

					$qSearch = $db->query("SELECT `name`,`id` FROM category WHERE " . implode("", $array));
					$gSearch = $db->query("SELECT `name`,`id` FROM good WHERE " . implode("", $array));
					$sSearch = $db->query("SELECT `name`,`id` FROM subcategory WHERE " . implode("", $array));
						
					?>
					<div class="searchCat"><?
					if ($qSearch->num_rows > 0) {
						echo "<h3>Категории</h3>";
						foreach ($qSearch as $rows) {
							echo "<a href='/catalog/category.php?name=$rows[name]&id=$rows[id]&page=1' title='$rows[name]'>$rows[name]</a>";
						}
					}?>
					</div>
					<div class="searchGood"><?
					if ($gSearch->num_rows > 0) {
						echo "<h3>Товары</h3>";
						foreach ($gSearch as $rows) {
							echo "<a href='/catalog/product.php?name=$rows[name]&id=$rows[id]&page=1' title='$rows[name]'>$rows[name]</a>";
						}
					}?>
					</div>
					<div class="searchSubcat"><?
					if ($sSearch->num_rows > 0) {
						echo "<h3>Подкатегории</h3>";
						foreach ($sSearch as $rows) {
							echo "<a href='/catalog/subcategory.php?name=$rows[name]&id=$rows[id]&page=1' title='$rows[name]'>$rows[name]</a>";
						}
						
					}
					if($qSearch->num_rows==0 && $gSearch->num_rows==0 && $sSearch->num_rows==0){
						echo "<p>не удалось найти доступные товары </p>";
					}
					?>
					</div>
					<?
				} else {
					echo "<h2>Не найдена фраза для поиска</h2>";
				}
				?>
			</div>
		

		<? include_once "$path/private/footer.php"; ?>

	</div>
	<script>
		// //всплывающее окно для списка
		// let a = document.querySelectorAll(".header-category-second");
		// for (let i = 0; i < a.length; i++) {
		// 	a[i].onmouseover = function(event) {
		// 		console.log(event);
		// 		window_modal.style.display = "block";

		// 	}

		// 	a[i].onmouseout = function() {

		// 		window_modal.style.display = "none";
		// 	}
		// };

		//по клику открываем закрываем окно Войти

		let openPopUp = document.getElementById('open_pop_up');
		let closePopUp = document.getElementById('pop_up_close');
		let popUp = document.getElementById('pop_up')
		openPopUp.addEventListener('click', function(e) {
			e.preventDefault();
			popUp.classList.add('active');
		})
		closePopUp.addEventListener('click', () => {
			popUp.classList.remove('active')
		});
		//по клику превращаем инпут

		let showInput = document.getElementById('search');
		let closeInput = document.getElementById('search-overlay');
		showInput.addEventListener('click', function() {

			closeInput.classList.add('show');
			showInput.classList.add('i-show');
		})
		closeInput.addEventListener('click', () => {
			closeInput.classList.remove('show');
			showInput.classList.remove('i-show');
		});

		//фиксированное меню
		window.onscroll = function showNav() {
			let nav = document.querySelector('.nav');
			if (window.pageYOffset > 64) {
				nav.classList.add('nav_fixed');
			} else {
				nav.classList.remove('nav_fixed');
			}
		};
	</script>
</body>

</html>