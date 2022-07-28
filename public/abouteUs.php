<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/sys/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<? include_once "$path/private/head.php"; ?>

<body>
    <div class="cont profile-wrapper abouteWR">
        <? include_once "$path/private/header.php"; ?>
        <div class="profile_cont_main">
            <div class="profile_cont">


                <div class="cart-page_header hleb">
                    <ul>
                        <li><a href="/index.php" class="red">Главная</a></li>
                        <li><span class="gray">О нас</span></li>
                    </ul>
                </div>

                <h1 class="cart-h1">О нас</h1>
                <div class="aboute">
                    <div class="abouteUs">
                        <div class="abouteUsImg"><img src="/img/magazin.jpg" alt="Наш магазин" height="400px" width="500px"></div>
                        <div class="aboteUsTitle">
                            <p>SPORTPIT ПЕРМЬ</p>
                            <div class="aboteUsText">Мы существуем с 2022г. В наших магазинах представлен огромный ассортимент, где вы сможете купить все необходимые атлетические продукты, а также одежду и аксессуары для тренировок. Мы всегда рады помочь Вам с подбором необходимых добавок.</div>
                            <button id="open-modal_aboute" class="btn-send-us">Написать нам</button>
                            <div class="modal-container-aboute" id="aboute-form">

                                <div class="modal_content">
                                    <div class="modal_body" id="pop_up_body">
                                        <div class="mbody_title write">Написать Представителю</div>
                                        <div class="message"></div>
                                        <form class="sign_form myformAboute">
                                            <input type="text" name="name" placeholder="Как Вас зовут?" required>
                                            <input type="text" name="tel" placeholder="И номер телефона" required>
                                            <textarea name="message" placeholder="Сообщение" required></textarea>
                                            <div class="datatreatment">Оставляя заявку на сайте, Вы подтверждаете свое согласие на обработку персональных данных</div>
                                            <button type="submit" class="link-button btn_send">Отправить</button>
                                        </form>

                                        <div class="modal_close" id="close-modal_aboute">&#10006</div>
                                    </div>
                                </div>

                            </div>
                            <div class="aboute-info">
                                <div>В Перми работает магазин по адресу: ул. Краснофлотская, 37</div>
                                <div>Самовывоз c 10:00 до 20:00 (без выходных)</div>
                            </div>
                        </div>


                    </div>
                </div>





            </div>



        </div>
        <? include_once "$path/private/footer.php"; ?>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    let openMaboute = document.getElementById('open-modal_aboute');
    let closeMaboute = document.getElementById('close-modal_aboute');
    let aboute = document.getElementById('aboute-form');

    openMaboute.addEventListener('click', function(e) {
        e.preventDefault(); //переход по ссылке не произойдёт, но событие продолжит всплытие
        aboute.classList.add('activeM');
    });
    closeMaboute.addEventListener('click', () => {
        aboute.classList.remove('activeM');

    });
</script>

</html>