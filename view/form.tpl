<?php
/**
 * Форма вывода калькулятора
 */
?>
<h1>КАЛЬКУЛЯТОР</h1>
<div id="calc_wrapper">
    <form id="delivery_calc" action="" method="post">
        <fieldset>
            <div class="left">
                <label class="calc_label" for="city_from">
                    Пункт отправления*
                </label>
                <br/>
                <input id="city_from" class="calc_input" />
                <input type="hidden" id="city_from_" name="take[town]" />
            </div>
            <div class="right" >
                <label class="calc_label" for="city_to">
                    Пункт назначения*
                </label>
                <br/>
                <input id="city_to" class="calc_input" />
                <input type="hidden" id="city_to_" name="deliver[town]" />
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Характеристика груза:
            </legend>
            <div id="features">
                <div>
                    <label class="calc_label" for="places">
                        Количество мест (шт.)*
                    </label>
                    <input id="places" class="calc_input" name="places_cnt" type="text" />
                    <div class='clear' ></div>
                </div>
                <div>
                    <label class="calc_label" for="weight">
                        Вес груза (кг)*
                    </label>
                    <input id="weight" class="calc_input" name="place[weight]" type="text" />
                    <div class='clear' ></div>
                </div>
                <div>
                    <label class="calc_label" for="volume">Объем груза (м<sup>3</sup>)*</label> 
                    <input id="volume" class="calc_input" name="place[volume]" type="text" />
                    <div class='clear' ></div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Дополнительные параметры
            </legend>
            <div id="calc_options">
                <input id="auto_delivery_from" name="auto_delivery_from" type="checkbox" value="1" />
                <label id="auto_delivery_from_label" for="auto_delivery_from">
                    Автодоставка в пункте отправления
                </label>
                <br/>
                <input id="auto_delivery_to" name="auto_delivery_to" type="checkbox" value="1" />
                <label id="auto_delivery_to_label" for="auto_delivery_to">
                    Автодоставка в пункте назначения
                </label>
                <br/>
                <!--
                <input id="calc_opt_temp" name="calc_opt_temp" type="checkbox" value="1" />
                <label for="calc_opt_temp">
                    Температурный режим
                </label>
                <br/> -->
                <input id="calc_opt_oversized" name="place[very_big]" type="checkbox" value="1" />
                <label for="calc_opt_oversized">
                    Негабаритный груз
                </label>
                <br/>
                <input id="calc_opt_grid" name="place[zu]" type="checkbox" value="1" />
                <label for="calc_opt_grid">
                    Жесткая упаковка (обрешетка)
                </label>
                <br/>
            </div>
        </fieldset>
        <input type="hidden" name="over_percent" value="<?=(int)$s_params['over_percent']?>" />
        <input id="calc_calculate" type="submit" value="РАССЧИТАТЬ ПЕРЕВОЗКУ" />
    </form>
    <div id="response" ></div>
</div>