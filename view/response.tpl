<?php
/**
 * Отрисовка результатов поиска
 */
?>
<div id="calc_response" >
    <h2>Результаты расчета</h2>
    <?if($data['auto']):?>
        <div class="res-section" >
            <h3>Автотранспортом</h3>
            <span class="price" ><?=$data['auto'][0]?> <?=$data['auto'][1]?> - <span class="roubles" ><?=(round($data['auto'][2]+($data['auto'][2]*(int)$_POST['over_percent']/100)))?> р.</span></span>
            <!-- <span><b><i>Сроки:</i></b> <?=($data['periods'])?></span> -->
        </div>
    <?endif?>
    <?if($data['avia']):?>
        <div class="res-section" >
            <h3>Авиа</h3>
            <span class="price" ><?=$data['avia'][0]?> <?=$data['avia'][1]?> - <span class="roubles" ><?=(round($data['avia'][2]+($data['avia'][2]*(int)$_POST['over_percent']/100)))?> р.</span></span>
            <!-- <span><b><i>Сроки:</i></b> <?=($data['aperiods'])?></span> -->
        </div>
    <?endif?>
    <?if($_POST['auto_delivery_from'] && $data['take']):?>
        <div class="res-section" >
            <h3><?=$data['take'][0]?></h3>
            <span class="price" ><?=$data['take'][1]?> - <span class="roubles" ><?=(round($data['take'][2]+($data['take'][2]*(int)$_POST['over_percent']/100)))?> р.</span></span>
        </div>
    <?endif?>
    <?if($_POST['auto_delivery_to'] && $data['deliver']):?>
        <div class="res-section" >
            <h3><?=$data['deliver'][0]?></h3>
            <span class="price" ><?=$data['deliver'][1]?> - <span class="roubles" ><?=(round($data['deliver'][2]+($data['deliver'][2]*(int)$_POST['over_percent']/100)))?> р.</span></span>
        </div>
    <?endif?>
    <?if($data['error'] && FALSE):?>
        <div class="error res-section" >
            <?foreach($data['error'] as $error):?>
                <span><?=$error?></span>
            <?endforeach?>
        </div>
    <?endif?>
    <?if(!$data['auto'] && !$data['avia']):?>
        Не введены обязательные параметры
    <?endif?>
</div>