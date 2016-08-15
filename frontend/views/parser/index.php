<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;
?>
<h1><?php echo Yii::t('app', 'Parser');?></h1>

<p>Aliexpress и TaoBao не делал, ибо они подтягивают цены динамически, а ковыряться с phantomjs это уже слишком для тестового по php :) </p>
<p>Если указан диапазоны цен, в зависимости от характеристик товара, работать не будет.  </p>

<p>

    <?php echo Html::beginForm(Url::toRoute(['parser/result']));?>
    <?php echo Html::textInput('url','',['placeholder'=>'ebay.com, amazon.com item urls...','size'=>80]);?>
    <br><br>
    <?php echo Html::submitButton(Yii::t('app', 'Parse'));?>

    <?php echo Html::endForm();?>
</p>

<p>
    <br>
    Кросс-курсы с cbr.ru: <br>
    <?php print_r($data); ?>
</p>

<p>

</p>