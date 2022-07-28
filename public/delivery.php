<?
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<? include_once "$path/private/head.php"; ?>
</head>
<body>
	<div class="cont deliv">
		<? include_once "$path/private/header.php"; ?>

		<main>
			<div class="delivery-page">
				<div class="delivery-page_header">
				<ul>
					<li><a href="/index.php" class="red">Главная</a></li>
					<li><span class="gray">Доставка и оплата</span></li>
				</ul>
				</div>
				<h1 class="delivery-page_title">
					Доставка и оплата в магазине SPORTPIT Пермь
				</h1>
				<div class="delivery-page-cont">
					<ul class="delivery-text-list">
						<li>Товары в заказе могут быть доставлены со склада из Москвы, либо из магазина Вашего города</li>
						<li>Любая доставка бесплатная при сумме отправления от 2990 ₽.</li>
						<li>Бесплатная доставка считается отдельно для каждого отправления в вашем заказе.</li>
					</ul>
					<div class="delivery_cards">
						<div class="d_cards_col">
							<div class="d-card d-card_central">
								<div class="d-card_header">
									<h2 class="d-card_title">ТОВАРЫ СО СКЛАДА В МОСКВЕ</h2>
									<p class="d-card_description">Отправляем по России и Казахстану.</p>
								</div>

								<div class="d-card_delivery">
									<h3 class="d-card_subtitle">Способы доставки</h3>
									<ul class="d-card_row">
										<li class="d-card_row_col">
											<div class="d-tile">
												<div class="d-tile-title">СДЭК</div>
												<div class="d-tile-info"><a target="_blank" href="https://www.cdek.ru/ru/calculate">Рассчитать срок доставки</a></div>
												<div class="d-tile-price">от 300 ₽</div>
											</div>
	
										</li>
										<li class="d-card_row_col">
											<div class="d-tile">
											<div class="d-tile-title">Почта России</div>
											<div class="d-tile-info"><a target="_blank" href="https://russianpostcalc.ru/">Рассчитать срок доставки</a></div>
											<div class="d-tile-price">от 400 ₽</div>
											</div>
										</li>
									</ul>
									<div class="d-card_note">Оплата за перевозку при получении по тарифам ТК.</div>

								</div>
								<div class="d-card_payment">
								<h3 class="d-card_subtitle">Способы оплаты</h3>
                                    <table class="d-card-table">
                                        <tbody>
                                            <tr>
                                                <td>Картой на сайте</td>
                                                <td>
                                                    <figure class="payment-icon-cards"></figure>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Apple Pay</td>
                                                <td> <figure class="payment-icon-apple-pay"></figure></td>
                                            </tr>
                                            <tr>
                                                <td>Google Pay</td>
                                                <td>  <figure class="payment-icon-google-pay"></figure></td>
                                            </tr>
                                        </tbody>
                                    </table>
								</div>
								<div class="d-card_footer">
                                    <div class="d-card-tel">
                                        <p>Телефон центрального склада</p>
                                        <a href="tel:+749599999999">+7-495-99999999 (МОСКВА)</a>
                                    </div>
                                    <div class="d-card-alert">
                                        Только при 100% предоплате
                                    </div>
                                </div>
							</div>
						</div>

                        <div class="d_cards_col">
							<div class="d-card d-card_local">
								<div class="d-card_header">
									<h2 class="d-card_title">ТОВАРЫ ИЗ МАГАЗИНА <br> В ПЕРМИ</h2>
									
								</div>

								<div class="d-card_delivery">
									<h3 class="d-card_subtitle">Способы доставки</h3>
									<ul class="d-card_row">
										<li class="d-card_row_col">
											<div class="d-tile">
												<div class="d-tile-title">Курьер</div>
												<div class="d-tile-info">1-2 дня</div>
												<div class="d-tile-price">Бесплатно от 2990 ₽</div>
											</div>
	
										</li>
										<li class="d-card_row_col">
											<div class="d-tile">
											<div class="d-tile-title">Самовывоз из магазина</div>
											<div class="d-tile-info">1 час</div>
											<div class="d-tile-price">Бесплатно</div>
											</div>
										</li>
									</ul>
									

								</div>
								<div class="d-card_payment">
								<h3 class="d-card_subtitle">Способы оплаты</h3>
                                    <table class="d-card-table">
                                        <tbody>
                                            <tr>
                                                <td>Наличными или картой при самовывозе</td>
                                                <td>
                                                    <figure class="payment-icon-cards"></figure>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Наличными курьеру</td>
                                                <td> </td>
                                            </tr>

                                        </tbody>
                                    </table>
								</div>
								<div class="d-card_footer">
                                    <div class="d-card-tel">
                                        <p>Телефон магазина в Перми:</p>
                                        <a href="tel:+79068894449">8-906-88-94449</a>
                                    </div>
                                </div>
							</div>
						</div>	
					</div>
					<div class="delivery-info">Если у вас остались вопросы по доставке, вы можете позвонить в магазин. Мы вам поможем.</div>
					<div class="delivery-store">
						<a href="tel:+79068894449" class="delivery-tel">8-906-88-9-444-9</a> 
						<div class="delivery-address">ул. Краснофлотская, 37</div>
					
					</div>
				</div>
			</div>
		</main>

		
		<? include_once "$path/private/footer.php"; ?>
	</div>
	
	<script>
		
	</script>
</body>
</html>

