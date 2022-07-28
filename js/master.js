 window.onload=function(){
  //тут пишем код, который будет ожидать загрузки DOM    
  
 }
 
         
// setInterval(()=>{
//             // $.ajax({
//             //    // type:"get",
//             //     url:"/sys/ajaxCart.php",
//             //   //  data:{

//             //  //   },
//             //  error:function(){
//             //     alert("Произошла ошибка добавления товара");
//             //  },
//             //     success:data=>{
//             //         cart.innerHTML=data;
//             //     }
//             // })

//             fetch("/sys/ajaxCart.php")
//             .then(response=>response.text())
//             .then(y=>console.log(y));
//         },1000);


    // -----------перезагрузка корзины-------------
    function ReloadCart(){
        let cart_v = $('#cart_count');
        $.ajax({
                           // type:"get",
                            url:"/sys/ajaxCart.php",
                          //  data:{
            
                         //   },
                         error:function(){
                            alert("Что-то пошло не так");
                         },
                            success:data=>{
                                cart.innerHTML=data;
                            }
        // fetch("/sys/ajaxCart.php")
        //             .then(response=>response.text())
        //          .then(text=>{document.getElementById('cart').innerHTML = text;
                });
    }

    // ---------------добавление в корзину---------------
    $(function() {
        let links_with_id = $('.product_links_with_id');
        let cart_value = $('#cart_count');

        $.each(links_with_id, function() {
            $(this).bind('click', function() {
                $(this).addClass('hv');
                $(this).html('В корзине');
                let current_id = $(this).attr('data-catid');
                let current_val = 1;
                $.post("/sys/addToCart.php", {
                        "product_id": current_id,
                        "product_col": current_val
                    })
                    .done(function(data) {
                        cart_value.html(data);
                        
                    });
            });
        });

    });
// ----------------добавление в корзину со страницы продукта------------
	$(function() {
        let btn_with_id = $('.btn_cart_add');
        let cart_val = $('#cart_count');

        $.each(btn_with_id, function() {
            $(this).bind('click', function() {
                //$(this).addClass('hv');
                $(this).html('В корзине');
                let current_id = $(this).attr('data-goodid');
                let current_val = $("#myInput").val();
                
                $.post("/sys/addToCartSelf.php", {
                        "product_id": current_id,
                        "product_col": current_val

                    })
                    .done(function(data) {
                        cart_val.html(data);
                    });
            });
        });

    });

//--------------удаление товара по id из корзины, но не работает если подгружаются данные через ajax--------

    // $(function() {
    //     let del = $('.del');
    //     let cart_value = $('#cart_count');
    //    console.log(del);
    //     $.each(del, function() {
    //         $(this).bind('click', function() {
    //             console.log(this);
    //             //$(this).addClass('hv');
    //             //$(this).html('В корзине');
    //             let current_id = $(this).attr('data-del');
                  
    //             $.post("/sys/removeFromCart.php", {
    //                     "product_id": current_id
    //                 })
    //                 .done(function(data) {
    //                     cart_value.html(data);
    //                     ReloadCart();
    //                 });
    //         });
    //     });
    // });

// ------------удаление товара-----------------

    $(document).on('click', '#del', function() {
        let cart_value = $('#cart_count');
        //$(this).addClass('hv');
        //$(this).html('В корзине');
        let current_id = $(this).attr('data-del');
        console.log(current_id);
          
        $.post("/sys/removeFromCart.php", {
                "product_id": current_id
            })
            .done(function(data) {
                cart_value.html(data);
                ReloadCart();
            });
    });

// ----------------изменение количества товара------------------

$(document).on('change', '.count-product', function() {
    let col = $(this).val();
    let current_price = $(this).attr('data-price');
    console.log(col);
    let id = $(this).attr('id'); 
    console.log(id);
    $.ajax({
        url: '/sys/changeProductQuantity.php',
        type: 'post',
        data: {
            col_tov: col,
            id_tov: id
        },
        success: function() { //получаем результат
           
            ReloadCart();
        }
    });
});

// ----------------изменение количества товара, но не работает если подгружаются данные через ajax------------------
    //  $('.count-product').change(function() {
    //     let col = $(this).val();
    //     let current_price = $(this).attr('data-price');
    //   // let price = $('td').siblings('.realP');
    //    // let price = $(this).find('#realP');
    //    // let newprice = (col * current_price);
    //     console.log(col);
    //     // if (col < 1) {
    //     //     col = 1;
    //     //     $(this).val(1);
    //     // } //если ввели меньше 1 установим 1
    //     let id = $(this).attr('id'); //получаем id товара
    //     console.log(id);
    //     $.ajax({
    //         url: '/sys/changeProductQuantity.php',
    //         type: 'post',
    //         data: {
    //             col_tov: col,
    //             id_tov: id
    //         },
    //         success: function() { //получаем результат
    //             //тут можно пересчитать сумму
    //             //price.html(newprice);
    //             ReloadCart();
    //         }
    //     });
    // });

    // -------------------------добавление в избранное------------------

    $(function() {
        let link_like = $('.product-like_link');

        $.each(link_like, function() {
            $(this).bind('click', function() {
                let curr_id = $(this).attr('data-like');
              
                if (!$(this).hasClass("like")) {
                    $(this).addClass('like');
                      console.log(this);
                    $.post("/sys/addTofavorite.php", {
                            "Fproduct_id": curr_id
                        })
                        .done(function() {
                            //$(this).addClass('like');
                            
                        });
                } else { $(this).removeClass('like');
                    let curr_id = $(this).attr('data-like');
                    console.log(curr_id);
                    $.post("/sys/removeFromefavorite.php", {
                            "Fproduct_id": curr_id
                        })
                        .done(function() {
                            //$(this).removeClass('like');
                        });

                }

            });
        });



    });


//---------------------------Отправка формы обратной связи----------------------------
  
    $(document).on('submit', '.myformAboute', function(e) {
        e.preventDefault();
        let th = $(this);
        let mess = $('.message');
        let btn = th.find('.btn_send');

        $.ajax({
            url: '/sys/sendMessage.php',
            type: 'post',
            data: th.serialize(),
            success: function(data) {
                if (data == 3) {
                    mess.html('Введите корректный номер телефона');
                    return false;
                }
                if (data == 2) {
                    mess.html('Введите Ваше имя');
                    return false;
                }
                if (data == 1) {
                    mess.html('Введите Ваше сообщение');
                    return false;
                } else {
                    mess.html('Вашe сообщение отправлено. Мы свяжемся с Вами в ближайшее время.');
                    btn.html('Отправлено');
                    setTimeout(function() {
                        th.trigger('reset');
                        document.location.href = '/index.php';
                    }, 2000);

                }
            },
            error: function() {
                mess.html('Произошла ошибка. Ваше сообщение не было отправлено.');
            }

        })
    })
   

