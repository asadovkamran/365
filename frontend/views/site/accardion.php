
<?php
use imanilchaudhari\CurrencyConverter\CurrencyConverter;
 use yii\helpers\Html;
 use kartik\icons\Icon;
$converter = new CurrencyConverter();

?>

<div id="accordion"> 
    <?php 
//$rate =  $converter->convert('USD', 'AZN');
$sign = array('RUB' => '₽','USD' => '💲','EUR' => '€', 'TRY'=>'&#8378');
if(isset($_GET['currency'])){
        if($_GET['currency'] == 'RUB' or $_GET['currency'] == 'USD' or $_GET['currency'] == 'EUR' or $_GET['currency'] == 'TRY'){
        $s = $_GET['currency'];
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
        'name' => 'currency',
        'value' => $_GET['currency'],
    ]));
        $ratee =  $converter->convert('USD', $_GET['currency']);
        
        $rate = explode('.', $ratee);
        if($rate[0] == 0){
            $rate[0]= $ratee;
        }
        }
}else{
    $s = 'USD';
    $rate['0'] = 1;
}
?>
    <?php $name = 'name_'.Yii::$app->language; ?>

            <?php foreach($auto as $cats): ?>

 <?php  $say =  count($cats['autos']);?>
            <button class="col-xs-12 car-class-main" name="button" type="button">

            <div class="row">
                    <div class="col-sm-3 col-xs-6 col-md-2 car-button-image">
                        <?php if ($cats['name_en'] == 'Suv' || $cats['name_ru'] == 'Сув'): ?>
                            <img src="/uploads/prado.png" />
                        <?php else: ?>
                            <img alt="Transfer and chauffeur service in baku <?=$cats['autos'][$say-1]['name']?>" src="/uploads/<?=$cats['autos'][$say-1]['photo']?>" />
                        <?php endif; ?>

                        
                        
                            

                    </div>
                    <div class="col-sm-2 col-xs-6 col-md-2 car-button-classname">
                            <?= $cats[$name] ?><br>
                            <?=Yii::t('yii', 'MAX')?> <?=Html::encode($cats['autos'][$say-1]['maxpas'])?> <?=Icon::show('user',[],Icon::FA)?>
                    </div>
                    <div class="col-sm-2 col-md-2 car-button-features">
                        <img src="uploads/wifi.png"/>
                    </div>

                    <div data-price="<?= $cats['autos']['0']['priceT']*$rate['0']  ?>" 
                         data-pricechaffeur="<?= $cats['autos']['0']['priceC'] * $rate['0']?>"
                         data-coefficient="<?= $cats['autos']['0']['cent']*$rate['0']?>"
                         class="col-sm-5 col-xs-12 car-class-min-price">
                        <div class="prices-transfer">
                            <?php if (Yii::$app->language == 'az'): ?>
                            <?= $sign[$s]?> <span><?= intval($cats['autos']['0'][$_GET['request']]*$rate['0'])?></span> <?=Yii::t('yii', 'from')?>
                            <?php else: ?>
                                    <?=Yii::t('yii', 'from')?> <?= $sign[$s]?> <span><?= intval($cats['autos']['0'][$_GET['request']]*$rate['0'])?></span>
                            <?php endif ?>
                        </div>
                        <div class="prices-chauffeur">
                            <?php if (Yii::$app->language == 'az'): ?>
                                <span class="daily-rent"><span id="ch-full-main"><?=Yii::t('yii', 'Full day (8 hours)')?></span> </span><?= $sign[$s]?> <span class="pricefull"><?= intval($cats['autos']['0'][$_GET['request']]*$rate['0']) ?></span> <?=Yii::t('yii', 'from')?><br>
                                <span class="half-day"><span id="ch-half-main"><?=Yii::t('yii', 'Half day (4 hours)')?></span> </span> <?= $sign[$s]?> 
                                <span class="pricehalf"><?=intval($cats['autos']['0'][$_GET['request']]*$rate['0'] / 2 * 1.2)?></span> <?=Yii::t('yii', 'from')?><br>
                            <?php else: ?>
                                <span class="daily-rent"><span id="ch-full-main"><?=Yii::t('yii', 'Full day (8 hours)')?></span> </span><?=Yii::t('yii', 'from')?> <?= $sign[$s]?> <span class="pricefull"><?= intval($cats['autos']['0'][$_GET['request']]*$rate['0']) ?></span><br>
                                <span class="half-day"><span id="ch-half-main"><?=Yii::t('yii', 'Half day (4 hours)')?></span> </span><?=Yii::t('yii', 'from')?> <?= $sign[$s]?>
                                <span class="pricehalf"><?=intval($cats['autos']['0'][$_GET['request']]*$rate['0'] / 2 * 1.2)?></span><br>
                            <?php endif ?>
                            
                            
                        </div>
                        <?php 
                        $amount = urldecode($cats['autos']['0']['priceT']);
                        //$get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
                        //$get = explode("<span class=bld>",$get);
                        //$get = explode("</span>",$get[1]);
                        $converted_amount = 5;//preg_replace("/[^0-9\.]/", null, $get[0]);
                        ?>

            <?php 
             // $amount = urldecode($cats['price']);
              // $get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
              // $get = explode("<span class=bld>",$get);
              // $get = explode("</span>",$get[1]);
              $converted_amount = 5; //preg_replace("/[^0-9\.]/", null, $get[0]);
            ?>
                        <?=substr($converted_amount, 0 , -2) ?>
                </div>
            <div class="col-sm-3 col-md-2 arrow">

            </div>

        </div>
        </button>


            <ul>
                <?php foreach($cats['autos'] as $autos): ?>
                    <?php
                        $buttonContent = $this->context->renderPartial(
                                'carClassButtonContent', ['autos'=>$autos,
                                    'rate'=>$rate, 
                                    'sign'=>$sign,'s'=>$s,
                                    'ajaxr' => $_GET['request']]);
                    ?>
                    <?= Html::button($buttonContent,
                        ['name'=>'Transferorder[car]','value'=>['car' => $autos['id'],
                            'car-name' => $autos['name'],
                            'transfer-price' => $autos['priceT'],
                            'amount' => intval($autos[$_GET['request']] * $rate['0']),
                            'cent' => $autos['cent'] * $rate['0'], 'rate'=>$rate['0'],
                            'sign' => $sign[$s]],
                            'type' => 'submit','form' => $_GET['form'], 'class'=>'car-class' ]); ?>



                    <?php endforeach ?>
            </ul>

                <?php endforeach ?>

</div>
