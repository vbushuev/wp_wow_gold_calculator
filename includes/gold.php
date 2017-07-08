<div class="wow-gold-calculator-container" >
    <form id="wow_gold_calculator_container">
        <span style="font-size: small; color: #ff0000;">Внимание!</span><br />
        <span style="color: #c0c0c0; font-size: small;">Гордунни(Орда)</span><br />
        <span style="color: #c0c0c0; font-size: small;"> Свежеватель душ(Альянс)</span><br />
        <span style="color: #c0c0c0; font-size: small;">Ревущий Фьорд(Альянс)</span><br />
        <span style="color: #c0c0c0; font-size: small;"> - На этих серверах доступна передача только через аукцион.</span><br />
        <span style="color: #c0c0c0; font-size: small;">Выбирайте способ доставки "Через аукцион" - название лота напишите в графе "Комментарий:"</span><br />
        <p style="float: right;">Для отображения цены выберите сервер</p>
        <h2>Оформить заказ</h2>
        <div class="row">
            <div class="col-md-4"><label>Выберите сервер</label></div>
            <div class="col-md-8">
                <select class="gold_game_selection" id="wow_gold_calculator_servers" name="server" required="required">
                    {{servers}}
                </select>
                <span id="wow_gold_calculator_servers_text"></span>
            </div>
        </div>
        <!-- <p class="leave_a_comment-p calculator"> -->

        <div class="row">
            <div class="col-md-4"><label>Укажите сторону</label></div>
			<div class="col-md-8">
            <select class="gold_game_selection" name="side">
                <option value="Орда">Орда</option>
                <option value="Альянс">Альянс</option>
            </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><label>Укажите имя персонажа:</label></div>
			<div class="col-md-8">
                <input class="gold_input_name" name="nickname" required="required" type="text" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><label>Выберите способ оплаты: </label></div>
			<div class="col-md-8">
                <select class="gold_game_selection" name="payment">
                    <option value="WebMoney WMR">WebMoney WMR</option>
                    <option value="WebMoney WMZ">Webmoney WMZ</option>
                    <option value="WebMoney WMU">Webmoney WMU</option>
                    <option value="WebMoney WME">Webmoney WME</option>
                    <option value="Qiwi">Qiwi(Без комиссии)</option>
                    <option value="Yandex">Yandex(без комиссии)</option>
                    <option value="Банковские карты (Россия и СНГ)">Банковские карты (Россия и СНГ)</option>
                    <option value="Банковские карты(EU)">Банковские карты(EU)</option>
                    <option value="Мегафон, МТС, Билайн, Теле 2">Мегафон, МТС, Билайн, Теле 2</option>
                    <option value="Евросеть, Связной">Евросеть, Связной</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"><label>Я покупаю</label></div>
			<div class="col-md-3"><input class="vsb-gold" name="calc1"  required="required" type="text" /></div>
            <div class="col-md-2"><label>Я оплачу:</label></div>
			<div class="col-md-3"><input class="vsb-rubble" name="calc2" type="text" /></div>
        </div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-8" style="color: #ffd940;">Минимальная сумма заказа <span id="min_order"></span> руб.</div>
        </div>
        <!-- <div class="row"> -->
            <h2>Способ доставки</h2>
        <!-- </div> -->
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-8">
                <input id="radio1" checked="checked" name="delivery_type" type="radio" value="На усмотрение оператора" />
                <label for="radio1">На усмотрение оператора</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-8">
            <input id="radio2" name="delivery_type" type="radio" value="Встреча в игре(Оргриммар, Штормград)" /><label for="radio2">Встреча в игре(Оргриммар, Штормград)</label>
        </div>
        </div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-8">
            <input id="radio3" name="delivery_type" type="radio" value="Почтой"/><label for="radio3">Почтой</label>
        </div>
        </div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-8">
            <input id="radio4" name="delivery_type" type="radio" value="Передача с помощью аукциона" /><label for="radio4">Передача с помощью аукциона</label>
        </div>
        </div>
        <h2>Контактная информация</h2>
        <div class="row">
            <div class="col-md-4"><label>Ваша эл. почта</label></div>
			<div class="col-md-8">
                <input class="gold_input_name" name="email" required="required" type="email" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><label>Укажите ICQ или Skype:</label></div>
				<div class="col-md-8">
            <input class="gold_input_name" name="skype" type="text" />
        </div>
        </div>
        <h2>Прочие данные</h2>
        <div class="row">
            <div class="col-md-12"><label>Оставьте комментарий о предпочитаемом времени доставки</label></div>
			<div class="col-md-12">
                <textarea class="input_information" name="comments" rows="3"></textarea>
            </div>
            <div class="vsb-clear"></div>
        </div>
        <div class="row">
            <div class="col-md-4"><label>Промокод</label></div>
			<div class="col-md-8">
                <input class="gold_input_name" name="promo_code" type="text" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <input id="ch1"  required="required" type="checkbox" />
                <label for="ch1">Я ознакомился с <a href="{{agreement}}" target="_blank" rel="noopener">условиями соглашения</a></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-3"><h3>Ваша скидка:</h3></div>
            <div class="col-md-5"><h3>0%</h3></div>
        </div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-3"><h3>Итого к оплате:</h3></div>
            <div class="col-md-5"><h3 id="total">200 р.</h3></div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <input type="hidden" name="form_submited" value="1" />
                <button class="btn btn-lg btn-primary" id="button-submit">Купить</button>
            </div>
        </div>
    </form>
</div>
