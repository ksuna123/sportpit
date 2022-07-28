<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";


?>

<header>
	<div class="banner">
		<div class="header-banner">
			Каждому нашему покупателю мы дарим протеиновый батончик
		</div>
	</div>
	<div class="top-h-row">
		<div class="header-top">
			<div>Пермь</div>
			<div class="header-top-menu">
			<p class="header-top-menu-mobile">Меню</p>
			<ul class="header-top-menu-list">
					<li><a href="/public/delivery.php">Доставка и оплата</a> </li>
					<li>Контакты</li>
					<li>Тренерам</li>
				</ul>
        <ul class="header-top-menu-mobile-list">
					<li><a href="/public/delivery.php">Доставка и оплата</a> </li>
					<li>Контакты</li>
					<li>Тренерам</li>
          <li><a href="tel:+79068894449">8-906-88-94449</a></li>
				</ul>


</div>

			<div class="phone">
				<div><img src="/img/call_ic_icon.svg" alt="" /></div>
				<span><a href="tel:+79068894449">8-906-88-94449</a></span>
			</div>
			<div class="user_enter" id="auth">
				<? if (!empty($_SESSION['user'])) : ?>
					<a href="/public/profile.php"><? echo $_SESSION['user']['login']; ?></a>
					<? if ($_SESSION['user']['login'] && $_SESSION['user']['admin']) : ?>
						<a href="/public/admin.php">Админка</a>
					<? endif; ?>
					<a class="user_enter_panel" href="/public/logout.php">Выход</a>

				<? else : ?>
					<a href="#" id="open_pop_up">Войти</a>
				<? endif; ?>


				<!-- Войти на сайт -->
				<div class="modal" id="pop_up">
					<div class="modal_content">
						<div class="modal_body" id="pop_up_body">
							<div class="mbody_title">Войти на сайт</div>
							<div class="link-no-account"><a href="#" id="open_pop_upReg">У меня еще нет аккаунта</a> </div>
							<form class="sign_form" id="myform">
								<input type="text" name="login" placeholder="Ваш логин">
								<input type="password" name="passwordSignIn" placeholder="И пароль">
								<button type="submit" class="link-button" id="signIn">Войти</button>
							</form>
							<div class="msg"></div>
							<!-- <div class="link-forgot-account">Забыли пароль?</div> -->

							<div class="modal_close" id="pop_up_close">&#10006</div>
						</div>
					</div>
				</div>


				<!-- Регистрация -->
				<div class="modal" id="pop_up_reg">
					<div class="modal_content">
						<div class="modal_body" id="pop_up_body">
							<div class="mbody_title">Войти на сайт</div>
							<div class="link-no-account"><a href="#" id="open_pop_upL">У меня уже есть аккаунт</a></div>
							<form class="reg_form">
								<input type="email" name="email" placeholder="Ваша почта">
								<input type="text" name="loginReg" placeholder="Ваш логин">
								<input type="password" name="passwordReg" placeholder="Ваш пароль">
								<input type="password" name="passwordReg-confirm" placeholder="Ваш пароль">
								<button type="submit" class="link-buttonR">Войти</button>
							</form>
							<div class="msgR"></div>
							<!-- <div class="link-forgot-account">Забыли пароль?</div> -->

							<div class="modal_close" id="pop_up_closeR">&#10006</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<nav class="nav">
		<div class="header-inner">
			<div class="logo"><a href="/index.php" title="Интернет магазин спортивного питания"><img src="/img/logo.png" title="Интернет магазин спортивного питания" alt="Купить спортивное питание"></a></div>
			<div>
				<div class="search-overlay" id="search-overlay"></div>
				<form action="/public/search.php" method="get" class="search-field">
					<input id="search" type="text" name="searchAll" placeholder="Поиск в каталоге">
				</form>

			</div>
			<div class="header-inner-menu">

				<div class="header-inner-like">
					<a href="/catalog/favorites.php" title="Перейти в Избранное">
						<img src="/img/red_heart.png" title="Избранное" alt="Избранное" class="img-top" height="40px" width="40px">
						<img src="/img/heart.svg" title="Избранное" alt="Избранное" class="img-bottom" height="40px" width="40px">
					</a>
				</div>
				<div class="header-inner-basket">
					<a href="/public/cart.php" title="Перейти в Корзину">
						<div class="basket-img">
							<img src="/img/basket-white.svg" title="Корзина" alt="Корзина" class="basket-top" height="45px" width="50px">
							<img src="/img/basket.svg" title="Корзина" alt="Корзина" class="basket-bottom" height="45px" width="50px">
						</div>

						<div class="check-basket" id="cart_count"><? if (isset($_SESSION['cart'])) {
																		echo count($_SESSION['cart']);
																	} ?></div>
						<div class="header-basket">Корзина</div>
					</a>
				</div>

			</div>
		</div>
		<div class="header-category-menu">
			<div class="header-category">
				<ul class="header-category-list">
					<li class="header-category-item">
						<a href="/catalog/sportpitanie.php?page=1" title="Спортивное питание" class="header-category-item_link">Спортивное питание</a>
						<ul class="header-category-second" id="hcs">
							<? $query = $db->query("SELECT * FROM category WHERE `status`=1 ORDER BY `name` ASC");
							foreach ($query as $row) { ?>
								<li class="header-category-second_item">
									<a href="/catalog/category.php?name=<? echo $row['name']; ?>&id=<? echo $row['id']; ?>&page=1" data-cat="<? echo $row['id']; ?>" title="<? echo $row['name']; ?>" class="header-category-second_link" id="hcslink"><? echo $row['name']; ?></a>

									<div class="win">
										<ul class="header-category-third">

											<? $queryS = $db->query("SELECT * FROM subcategory WHERE subcategory.cat_id='$row[id]' ORDER BY `name` ASC");
											foreach ($queryS as $rowS) { ?>
												<li class="header-category-third-item">
													<a href="/catalog/subcategory.php?name=<? echo $rowS['name']; ?>&id=<? echo $rowS['id']; ?>&page=1" title="<? echo $rowS['name']; ?>" class="header-category-third_link"><? echo $rowS['name']; ?></a>
												</li>
											<?
											}
											?>

										</ul>
									</div>

								</li>
							<?
							}
							?>

						</ul>

					</li>
					<li class="header-category-item">
						<a href="/catalog/accessories.php?page=1" title="Экипировка и аксессуары" class="header-category-item_link">Экипировка и аксессуары</a>
						<ul class="header-category-second">
							<? $query = $db->query("SELECT * FROM category WHERE `status`=2 ORDER BY `name` ASC");
							foreach ($query as $row) { ?>
								<li class="header-category-second_item">
									<a href="/catalog/category.php?name=<? echo $row['name']; ?>&id=<? echo $row['id']; ?>&page=1" title="<? echo $row['name']; ?>" class="header-category-second_link"><? echo $row['name']; ?></a>
									<div class="win">
										<ul class="header-category-third">

											<? $queryS = $db->query("SELECT * FROM subcategory WHERE subcategory.cat_id='$row[id]' ORDER BY `name` ASC");
											foreach ($queryS as $rowS) { ?>
												<li class="header-category-third-item">
													<a href="/catalog/subcategory.php?name=<? echo $rowS['name']; ?>&id=<? echo $rowS['id']; ?>&page=1" title="<? echo $rowS['name']; ?>" class="header-category-third_link"><? echo $rowS['name']; ?></a>
												</li>
											<?
											}
											?>

										</ul>
									</div>
								</li>
							<?
							}
							?>

						</ul>

					</li>
					<li class="header-category-item">
						<a href="/public/abouteUs.php" title="О нас" class="header-category-item_link">О нас</a>
					</li>
				</ul>

			</div>
		</div>
	</nav>


	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script>
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

		//по клику открываем закрываем окно Войти, окно Регистрации

		let openPopUp = document.getElementById('open_pop_up');
		let closePopUp = document.getElementById('pop_up_close');
		let popUp = document.getElementById('pop_up');

		openPopUp.addEventListener('click', function(e) {
			e.preventDefault(); //переход по ссылке не произойдёт, но событие продолжит всплытие
			popUp.classList.add('active');
		});
		closePopUp.addEventListener('click', () => {
			popUp.classList.remove('active');

		});

		let openPopUpR = document.getElementById('open_pop_upReg');
		let closePopUpR = document.getElementById('pop_up_closeR');
		let openPopUpL = document.getElementById('open_pop_upL');
		let popUpR = document.getElementById('pop_up_reg')

		openPopUpR.addEventListener('click', function(e) {
			e.preventDefault(); //переход по ссылке не произойдёт, но событие продолжит всплытие
			popUp.classList.remove('active');
			popUpR.classList.add('active');
		});
		openPopUpL.addEventListener('click', function(e) {
			e.preventDefault(); //переход по ссылке не произойдёт, но событие продолжит всплытие
			popUpR.classList.remove('active');
			popUp.classList.add('active');
		});
		closePopUpR.addEventListener('click', () => {
			popUpR.classList.remove('active');

		});






		// ---------------Выполняем вход на сайт
		$('.link-button').click(function(e) {
			e.preventDefault();
			$(`input`).removeAttr("error");


			let login = $('input[name="login"]').val();
			let password = $('input[name="passwordSignIn"]').val();


			$.ajax({
				url: '/public/signIn.php',
				type: 'POST',
				dataType: 'json',
				data: {
					login: login,
					password: password
				},
				success(data) {
					if (data.status) {
						document.location.href = '/public/profile.php';
					} else {
						if (data.type === 1) {
							data.fields.forEach(function(field) {
								$(`input[name="${field}"]`).attr('id', 'error');
							});
						}

						$('.msg').text(data.message);
					}

				}

			});



		})

		// ---------------Выполняем вход на сайт-регистрация

		$('.link-buttonR').click(function(e) {
			e.preventDefault();
			$(`input`).removeAttr("error");
			$("#myform").find("input").removeAttr("error");

			let email = $('input[name="email"]').val();
			let login = $('input[name="loginReg"]').val();
			let password = $('input[name="passwordReg"]').val();
			let password_confirm = $('input[name="passwordReg-confirm"]').val();

			$.ajax({
				url: '/public/signUp.php',
				type: 'POST',
				dataType: 'json',
				data: {
					email: email,
					login: login,
					password: password,
					password_confirm: password_confirm

				},
				success(data) {
					if (data.status) {
						document.location.href = '/public/profile.php';
						$('.msgR').text(data.message);
					} else {
						if (data.type === 1) {
							data.fields.forEach(function(field) {
								$(`input[name="${field}"]`).attr('id', 'error');
							});
						}

						$('.msgR').text(data.message);
					}

				}

			});



		})




		// hcs.onclick = event => {
		// 	if (event.target.id == "hcslink") {

		// 		link = event.path[0].dataset.cat;
		// 		console.log(link)
		// 		fetch(`/sys/cat.php?cat_id=${link}`)
		// 			.then(response => {
		// 				return response.text();
		// 			})
		// 			.then(text => {
		// 				//console.log(text);
		// 				document.getElementById('catcont').innerHTML = text;
		// 			});
		// 	}
		// }
		// hcs.onclick = event => {
		// 	if (event.target.id == "hcslink") {

		// 		link = event.path[0].dataset.cat;
		// 		console.log(link)
		// 		fetch(`/sys/cat.php?cat_id=${link}`)
		// 	}
		// }
	</script>

</header>